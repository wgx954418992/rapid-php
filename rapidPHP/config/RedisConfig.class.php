<?php

namespace rapidPHP\config;


class RedisConfig
{
    /**
     * redis 地址
     * @var string
     */
    public static $host = '127.0.0.1';

    /**
     * redis 端口
     * @var int
     */
    public static $port = 6379;

    /**
     * redis 密码
     * @var string|null
     */
    public static $auth = '';

    /**
     * 数据库 默认0
     * @var int
     */
    public static $select = 0;
}