<?php

namespace apps\queue\classier\process;

use apps\core\classier\service\BaseService;
use Exception;
use rapidPHP\modules\console\classier\Output;
use rapidPHP\modules\process\classier\swoole\PipeProcess as BasePipeProcess;
use function rapidPHP\formatException;

abstract class PipeProcess extends BasePipeProcess
{

    /**
     * @var Output
     */
    protected $output;

    /**
     * PipeProcess constructor.
     * @param Output|null $output
     * @param null $parentProcess
     */
    public function __construct(Output $output = null, $parentProcess = null)
    {
        parent::__construct($parentProcess);

        $this->output = $output;
    }

    /**
     * @return Output
     */
    public function getOutput(): ?Output
    {
        return $this->output;
    }

    /**
     * @param Output|null $output
     */
    public function setOutput(?Output $output): void
    {
        $this->output = $output;
    }

    /**
     * 日志
     * @param Exception|string|array|null $e
     */
    public function log($e = null)
    {
        if ($e instanceof Exception) {
            $this->output->perror(formatException($e));

            BaseService::getInstance()->addLog($e->getMessage(), $e);
        } else {
            $this->output->perror($e);

            BaseService::getInstance()->addLog($e);
        }
    }
}
