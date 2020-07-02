<?php

namespace rapidPHP\library\core\server\request;

use rapidPHP\library\core\server\Request;

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
        $server = self::getRenameServer($_SERVER);

        $header = self::getAllHeaders($server);

        unset($header['Cookie']);

        parent::__construct($_GET, $_POST, $_FILES, $_COOKIE, $header, $server, file_get_contents('php://input'));
    }

    /**
     * 快速获取实例对象
     * @return Request
     */
    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }
}