<?php

namespace apps\core\classier\exception;

use Exception;
use Throwable;

class CacheException extends Exception
{

    /**
     * @var string|int
     */
    protected $code;

    /**
     * @var string|null
     */
    protected $cacheId;

    /**
     * ActionException constructor.
     * @param string $message
     * @param int $code
     * @param null $cacheId
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, $cacheId = null, Throwable $previous = null)
    {
        parent::__construct($message, (int)$code, $previous);

        $this->code = $code;

        $this->cacheId = $cacheId;
    }

    /**
     * @return string|null
     */
    public function getCacheId(): ?string
    {
        return $this->cacheId;
    }

}