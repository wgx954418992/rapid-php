<?php

namespace script\model\classier\handler;

use script\model\classier\HandlerInterface;
use script\model\classier\Table;


class JavaHandler extends HandlerInterface
{

    /**
     * 获取后缀
     * @return string
     */
    public function getExt()
    {
        return '.php';
    }


    /**
     * receive
     * @param $namespace
     * @param Table $table
     * @param $columns
     * @return mixed|void
     */
    public function onReceive($namespace, Table $table, $columns)
    {
        // TODO: Implement onReceive() method.
    }
}