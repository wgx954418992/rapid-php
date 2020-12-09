<?php

namespace script\model\classier;


abstract class HandlerInterface
{

    /**
     * 获取文件后缀
     * @return string
     */
    abstract public function getExt();

    /**
     * onReceive
     * @param $namespace
     * @param Table $table
     * @param $columns
     * @return mixed
     */
    abstract public function onReceive($namespace, Table $table, $columns);
}