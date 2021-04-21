<?php

namespace rapidPHP\modules\process\classier\swoole;

use Exception;
use Swoole\Event;
use Swoole\Process;

abstract class PipeProcess extends Process
{

    /**
     * 睡眠多少秒
     * @var
     */
    protected $sleep;

    /**
     * 最大读取的长度
     * @var int
     */
    protected $bufferLen = 8192;

    /**
     * 主进程 如果有的话
     * @var PipeProcess
     */
    protected $parentProcess;

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
     * @return mixed
     */
    public function getSleep()
    {
        return $this->sleep;
    }

    /**
     * @param mixed $sleep
     */
    public function setSleep($sleep): void
    {
        $this->sleep = $sleep;
    }

    /**
     * @return PipeProcess
     */
    public function getParentProcess(): PipeProcess
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
     * MQProcess constructor.
     * @param $sleep
     * @param null $mainProcess
     */
    public function __construct($sleep, $mainProcess = null)
    {
        $this->sleep = $sleep;

        $this->parentProcess = $mainProcess;

        parent::__construct([$this, 'run'], false, 2);
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
