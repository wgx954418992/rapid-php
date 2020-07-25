<?php

namespace rapidPHP\library\core\server\request;

use rapidPHP\library\core\server\Request;
use ReflectionException;

class CGIRequest extends Request
{

    /**
     * @var Request
     */
    private static $instance;

    /**
     * CGIRequest constructor.
     */
    public function __construct()
    {
        $serverInfo = self::getRenameServerInfo($_SERVER);

        $header = self::getAllHeaders($serverInfo);

        unset($header['Cookie']);

        parent::__construct(null, $_GET, $_POST, $_FILES, $_COOKIE, session_id(), $header, $serverInfo, file_get_contents('php://input'));
    }

    /**
     * 快速获取实例对象
     * @return Request|CGIRequest
     */
    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }
}