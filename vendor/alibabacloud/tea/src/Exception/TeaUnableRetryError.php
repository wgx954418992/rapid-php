<?php

namespace AlibabaCloud\Tea\Exception;

use AlibabaCloud\Tea\Request;

/**
 * Class TeaUnableRetryError.
 */
class TeaUnableRetryError extends TeaError
{
    private $lastRequest;
    private $lastException;

    /**
     * TeaUnableRetryError constructor.
     *
     * @param Request    $lastRequest
     * @param \Exception $lastException
     */
    public function __construct($lastRequest, $lastException = null)
    {
        parent::__construct([], 'TeaUnableRetryError', 0, null);
        $this->lastRequest   = $lastRequest;
        $this->lastException = $lastException;
    }

    public function getLastRequest()
    {
        return $this->lastRequest;
    }

    public function getLastException()
    {
        return $this->lastException;
    }
}
