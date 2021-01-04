<?php

namespace rapidPHP\modules\io\classier;

interface Input
{

    /**
     * 获取参数
     * @param null $name
     * @return mixed
     */
    public function get($name = null);

}