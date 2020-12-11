<?php

namespace rapidPHP\modules\server\config;

use rapidPHP\modules\common\classier\StrCharacter;

class HttpConfig
{

    /**
     * http请求方法 get
     */
    const METHOD_GET = 'GET';

    /**
     * http请求方法 post
     */
    const METHOD_POST = 'POST';

    /**
     * http请求方法 delete
     */
    const METHOD_DELETE = 'DELETE';

    /**
     * http请求方法 put
     */
    const METHOD_PUT = 'PUT';

    /**
     * http请求方法 head
     */
    const METHOD_HEAD = 'HEAD';

    /**
     * get 参数
     */
    const PARAM_GET = 'GET';

    /**
     * post 参数
     */
    const PARAM_POST = 'POST';

    /**
     * put 参数
     */
    const PARAM_PUT = 'PUT';

    /**
     * cookie 参数
     */
    const PARAM_COOKIE = 'COOKIE';

    /**
     * session 参数
     */
    const PARAM_SESSION = 'SESSION';

    /**
     * file 参数
     */
    const PARAM_FILE = 'FILE';

    /**
     * 请求参数类型可以获取的通道
     * @var array
     */
    public static $PARAM_TYPE = [
        self::PARAM_GET,
        self::PARAM_POST,
        self::PARAM_PUT,
        self::PARAM_COOKIE,
        self::PARAM_SESSION,
        self::PARAM_FILE,
    ];

    /**
     * 获取重命名的header,key 首字母全部转大写
     * @param $header
     * @return array
     */
    public static function getRenameHeader($header): array
    {
        $headers = [];

        foreach ($header as $item => $value) {
            $headers[StrCharacter::getInstance()->toFirstUppercase($item, '-', '-')] = $value;
        }

        return $headers;
    }

    /**
     * 生成sessionId
     * @return mixed|string|null
     */
    public static function getSessionId(): ?string
    {
        return md5(uniqid(mt_rand(), true));
    }
}