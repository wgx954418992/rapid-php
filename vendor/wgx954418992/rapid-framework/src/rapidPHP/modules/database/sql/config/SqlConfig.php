<?php

namespace rapidPHP\modules\database\sql\config;

class SqlConfig
{
    /**
     * 模块名称
     */
    const MODULE_NAME = 'database/sql';

    /**
     * 配置文件 url参数 key database名称
     */
    const CONFIG_KEY_DATABASE = 'database';

    /**
     * 配置文件 url参数 key unionCode 数据表编码
     */
    const CONFIG_KEY_CHARACTER_CODE = 'characterCode';

    /**
     * sql
     */
    const SQL_LIST = [
        'select' => '',
        'update' => '',
        'delete' => '',
        'insert' => '',
        'query' => '',
        'join' => '',
        'on' => '',
        'where' => '',
        'group' => '',
        'order' => '',
        'limit' => '',
        'having' => '',
        'func' => '',
        'sql' => ''
    ];
}
