<?php

namespace rapidPHP\modules\server\classier\http\cgi;

use rapidPHP\modules\server\config\SessionConfig;
use rapidPHP\modules\server\classier\interfaces\Request as RequestInterface;

class Request extends RequestInterface
{

    /**
     * 通过$_SERVER获取全部header
     * @param $serverInfo
     * @return array
     */
    public static function getAllHeaderByServerInfo(&$serverInfo): array
    {
        $headers = [];

        foreach ($serverInfo as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;

                unset($serverInfo[$name]);
            }
        }

        return $headers;
    }

    /**
     * Request constructor.
     * @param $cookie
     * @param SessionConfig|null $sessionConfig
     * @param string|null $sessionId
     */
    public function __construct($cookie, ?SessionConfig $sessionConfig, ?string $sessionId)
    {
        $serverInfo = parent::getRenameServerInfo($_SERVER);

        $header = self::getAllHeaderByServerInfo($serverInfo);

        unset($header['Cookie']);

        parent::__construct(
            $_GET,
            $_POST,
            $_FILES,
            $cookie,
            $header,
            $serverInfo,
            $sessionConfig,
            $sessionId
        );
    }

    /**
     * raw content
     * @return string
     */
    public function rawContent(): string
    {
        return file_get_contents('php://input');
    }
}
