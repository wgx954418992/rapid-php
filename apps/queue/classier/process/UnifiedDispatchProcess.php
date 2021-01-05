<?php


namespace apps\queue\classier\process;


use apps\core\classier\model\AppQueueModel;
use apps\core\classier\service\BaseService;
use Exception;
use apps\queue\classier\config\QueueConfig;
use apps\queue\classier\process\order\CreatedProcess;
use apps\queue\classier\service\QueueService;
use rapidPHP\modules\console\classier\Output;
use rapidPHP\modules\process\classier\swoole\PipeProcess;
use rapidPHP\modules\reflection\classier\Classify;
use ReflectionException;
use Swoole\Process;

class UnifiedDispatchProcess extends PipeProcess
{

    /**
     * @var Output
     */
    private $output;

    /**
     * @var PipeProcess[]
     */
    private $handlerProcess = [
        QueueConfig::TYPE_ORDER_CREATED => CreatedProcess::class,
    ];

    /**
     * UnifiedDispatchProcess constructor.
     * @param int $sleep
     * @param Output|null $output
     * @throws ReflectionException
     */
    public function __construct($sleep = 3,Output $output = null)
    {
        parent::__construct($sleep);

        $this->output = $output;

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
     */
    public function newProcess($processClass): PipeProcess
    {
        if ($processClass instanceof PipeProcess) $processClass = get_class($processClass);

        /** @var PipeProcess $process */
        $process = Classify::getInstance($processClass)->newInstance($this->getSleep(), $this);

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
    private function getHandlerProcess($type)
    {
        /** @var PipeProcess $class */
        $class = isset($this->handlerProcess[$type]) ? $this->handlerProcess[$type] : null;

        return $class;
    }

    /**
     * 获取所有进程 pids
     * @param bool $isSelf
     * @return array
     */
    public function getHandlerPIDs($isSelf = false): array
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

                    if (!$childProcess) continue;

                    $data = serialize($model);

                    try {
                        if (strlen($data) > $childProcess->getBufferLen())
                            throw new Exception("参数长度超过 {$childProcess->getBufferLen()} 最大限制");

                        $childProcess->write($data);
                    } catch (Exception $e) {

                        $this->onHandler($data);

                        $this->output->perror($e->getMessage());

                        BaseService::getInstance()->addLog($e->getMessage());
                    }
                }
            } catch (Exception $e) {
                $this->output->perror($e->getMessage());

                BaseService::getInstance()->addLog($e->getMessage());
            }

            sleep($this->getSleep());
        }
    }

    /**
     * 调度任务完成或者出现异常，结束消息队列
     * @param $data
     * @return mixed|void
     */
    public function onHandler($data)
    {
        $queueModel = unserialize($data);

        if ($queueModel instanceof AppQueueModel) {
            try {
                QueueService::getInstance()->setQueueStatus($queueModel->getId(),
                    QueueConfig::STATUS_COMPLETE);

            } catch (Exception $e) {
                BaseService::getInstance()->addLog($e->getMessage(), $e);
            }
        }
    }


}