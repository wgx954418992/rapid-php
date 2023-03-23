<?php


namespace apps\queue\classier\process;


use apps\core\classier\model\AppQueueModel;
use apps\queue\classier\enum\Status;
use apps\queue\classier\event\expressorder\PayedEvent;
use apps\queue\classier\model\HandlerModel;
use apps\queue\classier\pool\ProcessPool;
use apps\queue\classier\service\QueueService;
use Exception;
use rapidPHP\modules\console\classier\Output;
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
     * handler
     * @var HandlerModel[]
     */
    protected $handlers = [];

    /**
     * workers
     * @var PipeProcess[]|null
     */
    protected $workers = [];

    /**
     * UnifiedDispatchProcess constructor.
     * @param int $sleep
     * @param Output|null $output
     * @param HandlerModel[] $handlers
     * @throws ReflectionException
     */
    public function __construct(int $sleep, Output $output = null, array $handlers = [])
    {
        parent::__construct($output);

        $this->sleep = $sleep;

        $this->handlers = $handlers;

        foreach ($this->handlers as $type => $pool) {
            $this->workers[$type] = $pool = $pool->create($this->getOutput(), $this);

            $pool->start();
        }

        $this->start();
    }

    /**
     * 杀死进程
     * @param $type
     * @return HandlerModel
     * @throws Exception
     */
    public function pkill($type)
    {
        if (empty($type)) throw new Exception('type 错误');

        $handler = $this->handlers[$type] ?? null;

        if (empty($handler)) throw new Exception('type handler 不存在');

        $worker = $this->workers[$type] ?? null;

        if (empty($worker)) throw new Exception('type worker 不存在');

        if ($worker instanceof PipeProcess) {
            if ($worker instanceof ProcessPool) {
                foreach ($worker->getWorkers() as $v) {
                    Process::kill($v->pid);
                }
            }

            Process::kill($worker->pid);

            unset($this->workers[$type]);
        }

        return $handler;
    }

    /**
     * 重启进程
     * @param $type
     * @throws ReflectionException
     * @throws Exception
     */
    public function restart($type)
    {
        $handler = $this->pkill($type);

        if (empty($handler)) throw new Exception('进程错误');

        $this->workers[$type] = $handler = $handler->create($this->getOutput(), $this);

        $handler->start();
    }

    /**
     * 获取处理任务进程
     * @param $type
     * @return object|PipeProcess|null
     */
    public function getWorker($type)
    {
        return $this->workers[$type] ?? null;
    }

    /**
     * 获取所有进程 pids
     * @param bool $isSelf
     * @return array
     */
    public function getWorkerPIDs(bool $isSelf = false): array
    {
        $p = [];

        if ($isSelf) $p[$this->pid] = self::class;

        /**
         * @var string $type
         * @var PipeProcess $process
         */
        foreach ($this->workers as $type => $process) {
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

        $types = [];

        while (true) {
            try {
                if (empty($types)) $types = array_keys($this->workers);

                $type = array_shift($types);

                $list = QueueService::getInstance()
                    ->getNotExecQueue(10, $type);

                if (empty($list)) continue;

                foreach ($list as $model) {
                    $data = serialize($model);

                    try {
                        if (strlen($data) > $this->getBufferLen()) {
                            throw new Exception("参数长度超过 {$this->getBufferLen()} 最大限制");
                        }

                        $queueModel = unserialize($data);

                        if (!($queueModel instanceof AppQueueModel)) {
                            throw new Exception('数据错误');
                        }

                        /** @var PipeProcess $worker */
                        $worker = $this->getWorker($queueModel->getType());

                        if (!$worker) throw new Exception("{$queueModel->getType()} 对应的进程不存在!");

                        if (strlen($data) > $worker->getBufferLen()) {
                            throw new Exception("参数长度超过 {$worker->getBufferLen()} 最大限制");
                        }

                        $worker->write($data);
                    } catch (Exception $e) {
                        $this->onException($this->pid, $e, $data);
                    }
                }
            } catch (Exception $e) {
                $this->log('UnifiedDispatchProcess run error ', $e);
            }

            sleep($this->sleep);
        }
    }

    /**
     * on handler
     * @param $pid
     * @param $data
     * @return void
     * @throws Exception
     */
    public function onHandler($pid, $data)
    {
        throw new Exception('统一调度进程不接收消息处理!');
    }

    /**
     * complete
     * @param $pid
     * @param $data
     * @return void
     * @throws Exception
     */
    public function onComplete($pid, $data)
    {
        $queueModel = unserialize($data);

        if (!($queueModel instanceof AppQueueModel)) {
            throw new Exception('数据错误');
        }

        QueueService::getInstance()
            ->setQueueStatus($queueModel->getId(), Status::COMPLETE);
    }

    /**
     * 子进程异常
     * @param $pid
     * @param Exception $e
     * @param $data
     */
    public function onException($pid, Exception $e, $data)
    {
        $this->log('pid:' . $pid . ' - error ', $e);

        $queueModel = unserialize($data);

        try {
            if (!($queueModel instanceof AppQueueModel)) {
                throw new Exception('数据错误');
            }

            QueueService::getInstance()->setQueueStatus(
                $queueModel->getId(),
                Status::EXCEPTION,
                formatException($e)
            );
        } catch (Exception $e) {
            $this->log('onException pid:' . $pid . ' - error ', $e);
        }
    }
}
