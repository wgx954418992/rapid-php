<?php

namespace script\model\classier;


abstract class HandlerInterface
{

    /**
     * @return mixed
     */
    abstract public static function getInstance();

    /**
     * 获取文件后缀
     * @return string
     */
    abstract public function getExt(): string;

    /**
     * onReceive
     * @param Table $table
     * @param $columns
     * @param null $namespace
     * @param array|null $options
     * @return mixed
     */
    abstract public function onReceive(Table $table, $columns, $namespace = null, ?array $options = []);

}