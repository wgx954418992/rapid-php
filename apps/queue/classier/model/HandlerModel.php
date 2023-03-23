<?php

namespace apps\queue\classier\model;

use apps\queue\classier\pool\ProcessPool;
use apps\queue\classier\process\PipeProcess;
use Exception;
use rapidPHP\modules\console\classier\Output;
use rapidPHP\modules\reflection\classier\Classify;
use ReflectionException;

class HandlerModel
{

    /**
     * 进程池class or object
     * @var string|null
     */
    protected $pool;

    /**
     * worker class or object
     * @var string|null
     */
    protected $worker;

    /**
     * worker count
     * @var int
     */
    protected $worker_count = 1;

    /**
     * get worker process timeout
     * @var int
     */
    protected $timeout = 0;

    /**
     * @return string|null
     */
    public function getPool(): ?string
    {
        return $this->pool;
    }

    /**
     * @param string|null $pool
     */
    public function setPool(?string $pool): void
    {
        $this->pool = $pool;
    }

    /**
     * @return string|null
     */
    public function getWorker(): ?string
    {
        return $this->worker;
    }

    /**
     * @param string|null $worker
     */
    public function setWorker(?string $worker): void
    {
        $this->worker = $worker;
    }

    /**
     * @return int
     */
    public function getWorkerCount(): int
    {
        return $this->worker_count;
    }

    /**
     * @param int $worker_count
     */
    public function setWorkerCount(int $worker_count): void
    {
        $this->worker_count = $worker_count;
    }

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * @param int $timeout
     */
    public function setTimeout(int $timeout): void
    {
        $this->timeout = $timeout;
    }

    /**
     * @param Output $output
     * @param $parentProcess
     * @return PipeProcess|ProcessPool
     * @throws ReflectionException
     * @throws Exception
     */
    public function create(Output $output, $parentProcess = null)
    {
        if (empty($this->getPool())) {
            /** @var PipeProcess $process */
            $process = Classify::getInstance($this->getWorker())
                ->newInstance($output, $parentProcess);
        } else {
            /** @var ProcessPool $process */
            $process = Classify::getInstance($this->getPool())
                ->newInstance($output, $parentProcess);

            $process->init($this->getWorker(), $this->getWorkerCount());
        }

        return $process;
    }
}