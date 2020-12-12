<?php

namespace apps\app\classier\dao;

use Exception;
use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\database\sql\classier\SQLDao;
use rapidPHP\modules\database\sql\classier\SQLDB;
use rapidPHP\modules\database\sql\classier\SQLSource;

abstract class MasterDao extends SQLDao
{

    /**
     * 使用单例模式
     */
    use Instances;

    /**
     * 当前只支持子类，如果是当前类当前不存在直接new
     * @return static
     * @throws Exception
     */
    public static function onNotInstance()
    {
        if (static::class === self::class) {
            throw new Exception('不能实例化当前类');
        }

        return new static(...func_get_args());
    }

    /**
     * MasterDao constructor.
     * @param $modelOrClass
     * @throws Exception
     */
    public function __construct($modelOrClass)
    {
        parent::__construct(self::getSQLDB(), $modelOrClass);
    }

    /**
     * @return SQLDB
     * @throws Exception
     */
    public static function getSQLDB()
    {
        return SQLSource::getInstance()->getMasterDB();
    }
}