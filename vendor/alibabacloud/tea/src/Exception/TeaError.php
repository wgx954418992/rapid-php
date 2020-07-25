<?php

namespace AlibabaCloud\Tea\Exception;

use RuntimeException;

/**
 * Class TeaError.
 */
class TeaError extends RuntimeException
{
    private $errorInfo;
    public  $message = '';
    public  $code    = 0;
    public  $data    = null;
    public  $name    = '';

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
        if (isset($this->errorInfo['name'])) {
            $this->name = $this->errorInfo['name'];
        }
        if (isset($this->errorInfo['message'])) {
            $this->message = $this->errorInfo['message'];
        }
        if (isset($this->errorInfo['code'])) {
            $this->code = $this->errorInfo['code'];
        }
        if (isset($this->errorInfo['data'])) {
            $this->data = $this->errorInfo['data'];
        }
    }

    /**
     * @return array
     */
    public function getErrorInfo()
    {
        return $this->errorInfo;
    }
}
