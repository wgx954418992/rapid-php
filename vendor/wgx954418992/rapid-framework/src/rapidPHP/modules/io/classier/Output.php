<?php

namespace rapidPHP\modules\io\classier;

interface Output
{

    /**
     * 写出数据
     * @param string|null $data
     * @param array $options
     * @return bool
     */
    public function write(?string $data, array $options = []): bool;
}
