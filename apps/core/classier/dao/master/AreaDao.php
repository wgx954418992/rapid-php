<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppAreaModel;
use apps\core\classier\service\RedisCacheService;
use Exception;

class AreaDao extends MasterDao
{

    /**
     * AreaDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppAreaModel::class);
    }

    /**
     * 获取中国地区列表
     * @param int|null $areaId
     * @return array|null
     * @throws Exception
     */
    public function getAreaList(int $areaId = null): ?array
    {
        $select = parent::get()->order('level');

        if ($areaId != null) {
            $select->where('pid', $areaId);
        } else {
            $select->where('level', 2);
        }

        return $select->getStatement()
            ->fetchAll($this->getModelOrClass());
    }


    /**
     * 获取地址信息
     * @param $areaId
     * @param null $level
     * @return AppAreaModel|null
     * @throws Exception
     */
    public function getArea($areaId, $level = null): ?AppAreaModel
    {
        $RId = parent::getRId($areaId);

        $cache = RedisCacheService::getInstance()->get($RId);

        if ($cache instanceof AppAreaModel) return $cache;

        $select = parent::get()->where('id', $areaId);

        if ($level != null) $select->where('level', $level);

        /** @var AppAreaModel $model */
        $model = $select->getStatement()->fetch(AppAreaModel::class);

        RedisCacheService::getInstance()->add($RId, $model);

        return $model;
    }
}