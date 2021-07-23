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
     * @param null $parentProcess
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
                $this->onHandler($data);

            } catch (Exception $e) {
                $this->onException($e, $data);
            }
        });
    }

    /**
     * 捕捉当前进程的异常，然后抛给父进程，子类可以重写
     * @param Exception $e
     * @param $data
     */
    public function onException(Exception $e, $data)
    {
        $parentProcess = $this->getParentProcess();

        if ($parentProcess instanceof PipeProcess) {

            $parentProcess->onException($e, $data);
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    abstract public function onHandler($data);
}
