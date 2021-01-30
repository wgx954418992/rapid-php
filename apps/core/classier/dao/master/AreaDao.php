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
     * @return AppAreaModel[]
     * @throws Exception
     */
    public function getAreaList($areaId = null): array
    {
        $select = parent::get()->order('level');

        if ($areaId != null) {
            $select->where('pid', $areaId);
        } else {
            $select->where('level', 2);
        }

        return (array)$select->getStatement()
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

        if (!empty($cache) && $cache instanceof AppAreaModel) return $cache;

        $select = parent::get()->where('id', $areaId);

        if ($level != null) $select->where('level', $level);

        /** @var AppAreaModel $model */
        $model = $select->getStatement()->fetch(AppAreaModel::class);

        if ($model) RedisCacheService::getInstance()->add($RId, $model);

        return $model;
    }

    /**
     * 获取三级联动数据
     * @return array
     * @throws Exception
     */
    public function getAllAreaList(): array
    {
        return (array)parent::get('id,name,pid')
            ->in('level', [1, 2, 3, 4])
            ->order('level ASC,id ASC', '')
            ->getStatement()
            ->fetchAll();
    }
}