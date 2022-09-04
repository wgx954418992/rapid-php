<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\area\Level;
use apps\core\classier\model\AppAreaModel;
use Exception;

class AreaDao extends MasterDao
{

    /**
     * cache prefix
     */
    public const CACHE_PREFIX = 'app_area';

    /**
     * AreaDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppAreaModel::class);
    }

    /**
     * 获取全部分类信息
     * @return AppAreaModel[]
     * @throws Exception
     */
    public function getAreaList($areaId = null, ?array $level = null, ?int $size = null): array
    {
        $cacheId = $this->getCacheId('list', $areaId, md5(json_encode($level)), $size);

        return (array)parent::getCacheWithCallback($cacheId, function () use ($areaId, $level, $size) {
            $select = $this->get();

            if ($areaId != null) {
                $select->where('pid', $areaId);
            }

            if (!empty($level)) $select->in('level', $level);

            if (is_int($size) && $size > 0) $select->limit($size);

            return $select
                ->getStatement()
                ->fetchAll($this->getModelOrClass());
        });
    }

    /**
     * 获取地址信息
     * @param $areaId
     * @return AppAreaModel|null
     * @throws Exception
     */
    public function getArea($areaId)
    {
        $cacheId = $this->getCacheId('id', $areaId);

        return $this->getCacheWithCallback($cacheId, function () use ($areaId) {
            return $this->get()
                ->where('id', $areaId)
                ->getStatement()
                ->fetch($this->getModelOrClass());
        });
    }
}
