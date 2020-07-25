<?php

namespace rapidPHP\config;


use rapidPHP\library\db\driver\Mysql;

class DatabaseConfig
{

    /**
     * 连接数据库配置(pod)
     * @var array
     */
    public static $default = [
        'string' => '',//连接字符串(为空则按照下面配置连接)(mysql:host=127.0.0.1;dbname=test)
        'username' => 'root',//用户名
        'password' => 'Wgx954418992',//密码
        'header' => 'host',//连接头 (host|Server)
        'host' => 'rm-bp1un7cx4r5c28jj9yo.mysql.rds.aliyuncs.com',//地址
        'driver' => Mysql::class,//驱动
        'database' => 'iot-core',//数据库
        'databaseType' => 'mysql',//数据库类型(sqlsrv|mysql|...)
        'databaseConnectName' => 'dbname',//数据库连接名称(sqlsrv:database,mysql:dbname,...)
        'databaseCode' => 'utf8mb4',//数据库编码
        'modelPath' => APP_PATH . 'model/',//生成model的路径
        'modelNamespace' => 'application\model',//model的命名空间
        'modelFirst' => '',//生成model名称的前缀
    ];
}