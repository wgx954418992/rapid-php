<?php


namespace rapidPHP\modules\exception\classier;

use Exception;
use rapidPHP\modules\router\classier\Action;
use Throwable;

class ActionException extends Exception
{

    /**
     * @var Action
     */
    protected $action;

    /**
     * @var string|int
     */
    protected $code;

    /**
     * ActionException constructor.
     * @param string $message
     * @param int $code
     * @param Action|null $action
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, ?Action $action = null, Throwable $previous = null)
    {
        parent::__construct($message, (int)$code, $previous);

        $this->code = $code;

        $this->action = $action;
    }

    /**
     * @param Exception $e
     * @param Action|null $action
     * @return ActionException
     */
    public static function getInstance(Exception $e, ?Action $action = null): ActionException
    {
        if ($e instanceof ActionException) {
            if ($action) $e->action = $action;

            return $e;
        }

        return new ActionException($e->getMessage(), $e->getCode(), $action, $e);
    }

    /**
     * @return Action
     */
    public function getAction(): ?Action
    {
        return $this->action;
    }

}