<?php


namespace apps\queue\classier\config;


use apps\core\classier\config\Configure;
use apps\queue\classier\model\HandlerModel;
use Exception;
use rapidPHP\modules\reflection\classier\Utils;

class QueueConfig
{

    /**
     * Configure
     */
    use Configure;

    /**
     * 执行超时时间 （毫秒） 10分钟
     * @var int|null
     * @config queue.execution_timeout
     */
    protected $execution_timeout;

    /**
     * handlers
     * @var HandlerModel[]|null
     * @config queue.handlers
     */
    protected $handlers;

    /**
     * @return int
     */
    public function getExecutionTimeout(): int
    {
        return $this->execution_timeout ?? 0;
    }

    /**
     * @return HandlerModel[]
     */
    public function getHandlers(): array
    {
        return !is_array($this->handlers) ? [] : $this->handlers;
    }
}
