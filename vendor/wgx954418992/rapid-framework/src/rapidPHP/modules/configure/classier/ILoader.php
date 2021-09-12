<?php

namespace rapidPHP\modules\configure\classier;


interface ILoader
{

    /**
     * is support
     * @param string $filename
     * @return bool
     */
    public function isSupport(string $filename): bool;

    /**
     * load
     * @param string $filename
     * @return array
     */
    public function load(string $filename): array;
}
