<?php


namespace apps\queue\classier\process;


use apps\core\classier\model\AppQueueModel;
use apps\core\classier\service\BaseService;
use Exception;
use apps\queue\classier\config\QueueConfig;
use apps\queue\classier\process\order\CreatedProcess;
use apps\queue\classier\service\QueueService;
use rapidPHP\modules\process\classier\swoole\PipeProcess;
use rapidPHP\modules\reflection\classier\Classify;
use Swoole\Process;

class UnifiedDispatchProcess extends PipeProcess
{

    /**
     * 防止里面kill 导致数据错乱
     * @var bool
     */
    private $isRun = true;

    /**
     * @var PipeProcess[]
     */
    private $handlerProcess = [
        QueueConfig::TYPE_ORDER_CREATED => CreatedProcess::class,
    ];

    /**
     * UnifiedDispatchProcess constructor.
     * @param $sleep
     * @throws Exception
     */
    public function __construct($sleep = 3)
    {
        parent::__construct($sleep);

        foreach ($this->handlerProcess as $type => $process) {
            /** @var PipeProcess $process */
            $process = Classify::getInstance($process)->newInstance($this->getSleep(), $this);

            $this->handlerProcess[$type] = $process;

            $process->start();
        }

        $this->start();
    }

    /**
     * 获取处理任务进程
     * @param $type
     * @return object|null
     */
    private function getHandlerProcess($type)
    {
        /** @var PipeProcess $class */
        $class = isset($this->handlerProcess[$type]) ? $this->handlerProcess[$type] : null;

        return $class;
    }

    /**
     * 获取所有进程
     * @param bool $isSelf
     * @return PipeProcess[]
     */
    public function getAllHandlerProcess($isSelf = true)
    {
        $p = [];

        /**
         * @var string $type
         * @var PipeProcess $process
         */
        foreach ($this->handlerProcess as $type => $process) {
            if ($process instanceof PipeProcess) {
                $p[$type] = $process;
            }
        }

        if ($isSelf) $p[self::class] = $this;

        return $p;
    }

    /**
     * @param Process $process
     */
    public function run(Process $process)
    {
        parent::run($process);

        while ($this->isRun) {
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

                        BaseService::getInstance()->addLog($e->getMessage());
                    }
                }
            } catch (Exception $e) {
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