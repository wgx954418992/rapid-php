<?php

namespace rapidPHP\config;


class RedisConfig
{
    /**
     * redis 地址
     * @var string
     */
    public static $host = '47.97.75.148';

    /**
     * redis 端口
     * @var int
     */
    public static $port = 6379;

    /**
     * redis 密码
     * @var string|null
     */
    public static $auth = 'Wgx954418992';

    /**
     * 数据库 默认0
     * @var int
     */
    public static $select = 0;
}