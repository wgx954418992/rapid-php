<?php


namespace rapidPHP\modules\database\sql\config;


use rapidPHP\modules\database\sql\classier\annotation\Table;

class AnnotationConfig
{

    /**
     * table
     */
    const AT_TABLE = 'table';

    /**
     * at list
     */
    const ATS = [
        self::AT_TABLE=> Table::class,
    ];
}