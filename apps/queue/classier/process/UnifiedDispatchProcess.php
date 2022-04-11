<?php


namespace apps\queue\classier\process;


use apps\core\classier\model\AppQueueModel;
use apps\queue\classier\enum\Status;
use apps\queue\classier\event\FollowEvent;
use apps\queue\classier\event\integral\ChangeEvent;
use apps\queue\classier\event\SMSNotifyEvent;
use apps\queue\classier\process\integral\ChangeProcess;
use apps\queue\classier\process\notify\SMSProcess;
use Exception;
use apps\queue\classier\service\QueueService;
use rapidPHP\modules\console\classier\Output;
use rapidPHP\modules\reflection\classier\Classify;
use ReflectionException;
use Swoole\Process;
use function rapidPHP\formatException;

class UnifiedDispatchProcess extends PipeProcess
{

    /**
     * @var int
     */
    protected $sleep;

    /**
     * @var PipeProcess[]
     */
    protected $handlerProcess = [
        SMSNotifyEvent::NAME => SMSProcess::class,
        FollowEvent::NAME => FollowProcess::class,
        ChangeEvent::NAME => ChangeProcess::class,
    ];


    /**
     * UnifiedDispatchProcess constructor.
     * @param int $sleep
     * @param Output|null $output
     * @throws ReflectionException
     */
    public function __construct(int $sleep, Output $output = null)
    {
        parent::__construct($output);

        $this->sleep = $sleep;

        foreach ($this->handlerProcess as $type => $processClass) {
            $this->handlerProcess[$type] = $process = $this->newProcess($processClass);

            $process->start();
        }

        $this->start();
    }

    /**
     * 创建进程
     * @param $processClass
     * @return PipeProcess
     * @throws ReflectionException
     * @throws Exception
     */
    public function newProcess($processClass): PipeProcess
    {
        if ($processClass instanceof PipeProcess) {
            $processClass = get_class($processClass);
        }

        /** @var PipeProcess $process */
        $process = Classify::getInstance($processClass)
            ->newInstance(parent::getOutput(), $this);

        return $process;
    }

    /**
     * 杀死进程
     * @param $type
     * @return object|PipeProcess|string
     * @throws Exception
     */
    public function pkill($type)
    {
        if (empty($type)) throw new Exception('type 错误');

        $process = $this->getHandlerProcess($type);

        if (empty($process)) throw new Exception('进程错误');

        if ($process instanceof PipeProcess) {
            Process::kill($process->pid);

            return $this->handlerProcess[$type] = get_class($process);
        }

        return $process;
    }

    /**
     * 重启进程
     * @param $type
     * @throws ReflectionException
     * @throws Exception
     */
    public function restart($type)
    {
        $process = $this->pkill($type);

        if (empty($process)) throw new Exception('进程错误');

        $this->handlerProcess[$type] = $process = $this->newProcess($process);

        $process->start();
    }

    /**
     * 获取处理任务进程
     * @param $type
     * @return object|PipeProcess|null
     */
    public function getHandlerProcess($type)
    {
        return $this->handlerProcess[$type] ?? null;
    }

    /**
     * 获取所有进程 pids
     * @param bool $isSelf
     * @return array
     */
    public function getHandlerPIDs(bool $isSelf = false): array
    {
        $p = [];

        if ($isSelf) $p[$this->pid] = self::class;

        /**
         * @var string $type
         * @var PipeProcess $process
         */
        foreach ($this->handlerProcess as $type => $process) {
            if ($process instanceof PipeProcess) {
                $p[$process->pid] = $type;
            }
        }

        return $p;
    }

    /**
     * @param Process $process
     */
    public function run(Process $process)
    {
        parent::run($process);

        while (true) {
            try {
                $list = QueueService::getInstance()->getNotExecQueue(10);

                if (empty($list)) continue;

                foreach ($list as $model) {
                    /** @var PipeProcess $childProcess */
                    $childProcess = $this->getHandlerProcess($model->getType());

                    if (!$childProcess) {
                        throw new Exception("{$model->getType()} 对应的进程不存在!");
                    }

                    $data = serialize($model);

                    try {
                        if (strlen($data) > $childProcess->getBufferLen())
                            throw new Exception("参数长度超过 {$childProcess->getBufferLen()} 最大限制");

                        $childProcess->write($data);
                    } catch (Exception $e) {

                        $this->onHandler($data);

                        parent::log($e);
                    }
                }
            } catch (Exception $e) {
                parent::log($e);
            }

            sleep($this->sleep);
        }
    }


    /**
     * 调度任务完 结束消息队列
     * @param $data
     * @return void
     */
    public function onHandler($data)
    {
        $queueModel = unserialize($data);

        try {
            if (!($queueModel instanceof AppQueueModel))
                throw new Exception('数据错误');

            QueueService::getInstance()->setQueueStatus($queueModel->getId(),
                Status::COMPLETE);
        } catch (Exception $e) {
            parent::log($e);
        }
    }

    /**
     * 子进程异常
     * @param Exception $e
     * @param $data
     */
    public function onException(Exception $e, $data)
    {
        parent::log($e);

        $queueModel = unserialize($data);

        try {
            if (!($queueModel instanceof AppQueueModel))
                throw new Exception('数据错误');

            QueueService::getInstance()->setQueueStatus(
                $queueModel->getId(),
                Status::EXCEPTION,
                formatException($e)
            );
        } catch (Exception $e) {
            parent::log($e);
        }
    }
}
