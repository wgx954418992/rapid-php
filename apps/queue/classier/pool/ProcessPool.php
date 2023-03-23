<?php

namespace apps\queue\classier\pool;

use apps\queue\classier\process\PipeProcess;
use Exception;
use rapidPHP\modules\console\classier\Output;
use rapidPHP\modules\process\classier\swoole\PipeProcess as BasePipeProcess;
use rapidPHP\modules\reflection\classier\Classify;
use ReflectionException;
use Swoole\Table;

class ProcessPool extends PipeProcess
{

    /**
     * @var string|null
     */
    protected $workerClass;

    /**
     * @var BasePipeProcess[]
     */
    protected $workers = [];

    /**
     * @var Table
     */
    protected $usedWorkers = [];

    /**
     * @param Output|null $output
     * @param $parentProcess
     */
    public function __construct(Output $output = null, $parentProcess = null)
    {
        parent::__construct($output, $parentProcess);

        $this->usedWorkers = new Table(1024);

        $this->usedWorkers->column('time', Table::TYPE_INT);

        $this->usedWorkers->create();
    }

    /**
     * @return BasePipeProcess[]
     */
    public function getWorkers(): array
    {
        return $this->workers;
    }

    /**
     * @return array|Table
     */
    public function getUsedWorkers()
    {
        return $this->usedWorkers;
    }

    /**
     * @param string $workerClass
     * @param int $workerCount
     * @return void
     * @throws ReflectionException
     * @throws Exception
     */
    public function init(string $workerClass, int $workerCount)
    {
        $this->workerClass = $workerClass;

        for ($i = 0; $i < $workerCount; $i++) {
            /** @var PipeProcess $process */
            $process = Classify::getInstance($workerClass)
                ->newInstance(parent::getOutput(), $this);

            $process->start();

            $this->workers[$process->pid] = $process;
        }
    }

    /**
     * 获取可用的worker
     * @param int $timeout
     * @return BasePipeProcess|null
     */
    public function getWorker(int $timeout = 0)
    {
        $startTime = intval(microtime(true) * 1000);

        while (true) {
            $currentTime = intval(microtime(true) * 1000);

            if ($timeout > 0 && $currentTime - $timeout >= $startTime) {
                return null;
            }

            foreach ($this->workers as $pid => $worker) {
                if ($this->usedWorkers->get($pid)) continue;

                $this->usedWorkers->set($pid, ['time' => microtime(true) * 1000]);

                return $worker;
            }

            usleep(10);
        }
    }

    /**
     * @param $pid
     * @param $data
     * @return void
     */
    public function onHandler($pid, $data)
    {
        $worker = $this->getWorker();

        $worker->write($data);
    }

    /**
     * on complete
     * @param $pid
     * @param $data
     * @return void
     */
    public function onComplete($pid, $data)
    {
        if ($this->usedWorkers->get($pid)) $this->usedWorkers->del($pid);

        parent::onComplete($pid, $data);
    }

    /**
     * @param $pid
     * @param Exception $e
     * @param $data
     * @return void
     */
    public function onException($pid, Exception $e, $data)
    {
        if ($this->usedWorkers->get($pid)) $this->usedWorkers->del($pid);

        parent::onException($pid, $e, $data);
    }
}
