<?php

namespace AlibabaCloud\Tea\Exception;

use RuntimeException;

/**
 * Class TeaError.
 */
class TeaError extends RuntimeException
{
    private $errorInfo;

    /**
     * TeaError constructor.
     *
     * @param array           $errorInfo
     * @param string          $message
     * @param int             $code
     * @param null|\Throwable $previous
     */
    public function __construct($errorInfo = [], $message = '', $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errorInfo = $errorInfo;
    }

    /**
     * @return array
     */
    public function getErrorInfo()
    {
        return $this->errorInfo;
    }
}
