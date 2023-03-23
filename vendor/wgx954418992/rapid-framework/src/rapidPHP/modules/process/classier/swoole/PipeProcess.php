<?php

namespace rapidPHP\modules\process\classier\swoole;

use Exception;
use Swoole\Event;
use Swoole\Process;

abstract class PipeProcess extends Process
{

    /**
     * 最大读取的长度
     * @var int
     */
    protected $bufferLen = 8192;

    /**
     * 父进程 如果有的话
     * @var PipeProcess
     */
    protected $parentProcess;

    /**
     * MQProcess constructor.
     * @param $parentProcess
     */
    public function __construct($parentProcess = null)
    {
        $this->parentProcess = $parentProcess;

        parent::__construct([$this, 'run'], false, 2);
    }

    /**
     * @return int
     */
    public function getBufferLen(): int
    {
        return $this->bufferLen;
    }

    /**
     * @param int $bufferLen
     */
    public function setBufferLen(int $bufferLen): void
    {
        $this->bufferLen = $bufferLen;
    }

    /**
     * @return PipeProcess
     */
    public function getParentProcess()
    {
        return $this->parentProcess;
    }

    /**
     * @param PipeProcess $parentProcess
     */
    public function setParentProcess(PipeProcess $parentProcess): void
    {
        $this->parentProcess = $parentProcess;
    }

    /**
     * @param Process $process
     */
    public function run(Process $process)
    {
        Event::add($process->pipe, function () use ($process) {
            $data = $process->read($this->bufferLen);
            
            try {
                $this->onHandler($process->pid, $data);
            } catch (Exception $e) {
                $this->onException($process->pid, $e, $data);
            }
        });
    }

    /**
     * @param $pid
     * @param $data
     * @return void
     */
    abstract public function onHandler($pid, $data);

    /**
     * 完成处理
     * @param $pid
     * @param $data
     * @return void
     */
    public function onComplete($pid, $data)
    {
        try {
            $parentProcess = $this->getParentProcess();

            if ($parentProcess instanceof PipeProcess) {
                $parentProcess->onComplete($pid, $data);
            }
        } catch (Exception $e) {
            $this->onException($pid, $e, $data);
        }
    }

    /**
     * 捕捉当前进程的异常，然后抛给父进程，子类可以重写
     * @param $pid
     * @param Exception $e
     * @param $data
     */
    public function onException($pid, Exception $e, $data)
    {
        $parentProcess = $this->getParentProcess();

        if ($parentProcess instanceof PipeProcess) {
            $parentProcess->onException($pid, $e, $data);
        }
    }
}
