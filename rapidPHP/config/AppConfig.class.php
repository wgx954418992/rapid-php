<?php

namespace rapidPHP\config;

class AppConfig
{

    //http请求方法 get
    const HTTP_METHOD_GET = 'GET';

    //http请求方法 post
    const HTTP_METHOD_POST = 'POST';

    //http请求方法 delete
    const HTTP_METHOD_DELETE = 'DELETE';

    //http请求方法 put
    const HTTP_METHOD_PUT = 'PUT';

    //http请求方法 head
    const HTTP_METHOD_HEAD = 'HEAD';

    //get 参数
    const REQUEST_PARAM_GET = 'GET';

    //post 参数
    const REQUEST_PARAM_POST = 'POST';

    //put 参数
    const REQUEST_PARAM_PUT = 'PUT';

    //cookie 参数
    const REQUEST_PARAM_COOKIE = 'COOKIE';

    //session 参数
    const REQUEST_PARAM_SESSION = 'SESSION';

    //file 参数
    const REQUEST_PARAM_FILE = 'FILE';

    //变量类型 integer
    const VAR_TYPE_INTEGER = 'integer';

    //变量类型 int
    const VAR_TYPE_INT = 'int';

    //变量类型 double
    const VAR_TYPE_DOUBLE = 'double';

    //变量类型 string
    const VAR_TYPE_STRING = 'string';

    //变量类型 array
    const VAR_TYPE_ARRAY = 'array';

    //变量类型 object
    const VAR_TYPE_OBJECT = 'object';

    //变量类型 boolean
    const VAR_TYPE_BOOLEAN = 'boolean';

    //变量类型 bool
    const VAR_TYPE_BOOL = 'bool';

    //变量类型 float
    const VAR_TYPE_FLOAT = 'float';

    //变量类型 null
    const VAR_TYPE_NULL = 'null';

    //变量类型 json
    const VAR_TYPE_JSON = 'JSON';

    //变量类型 xml
    const VAR_TYPE_XML = 'XML';

    /**
     * 设置var默认可选类型
     * @var array
     */
    public static $SET_VAR_DEFAULT_TYPE = [
        self::VAR_TYPE_INTEGER => 1,
        self::VAR_TYPE_INT => 1,
        self::VAR_TYPE_FLOAT => 1,
        self::VAR_TYPE_DOUBLE => 1,
        self::VAR_TYPE_STRING => 1,
        self::VAR_TYPE_ARRAY => 1,
        self::VAR_TYPE_OBJECT => 1,
        self::VAR_TYPE_BOOLEAN => 1,
        self::VAR_TYPE_BOOL => 1,
        self::VAR_TYPE_NULL => 1,
    ];

    /**
     * 请求参数类型可以获取的通道
     * @var array
     */
    public static $REQUEST_PARAM_TYPE = [
        self::REQUEST_PARAM_GET => 1,
        self::REQUEST_PARAM_POST => 1,
        self::REQUEST_PARAM_PUT => 1,
        self::REQUEST_PARAM_COOKIE => 1,
        self::REQUEST_PARAM_SESSION => 1,
        self::REQUEST_PARAM_FILE => 1,
    ];
}