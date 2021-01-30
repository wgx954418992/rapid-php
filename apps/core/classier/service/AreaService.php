<?php

namespace apps\core\classier\service;

use apps\core\classier\bean\AreaAddressBean;
use apps\core\classier\config\BaseConfig;
use apps\core\classier\dao\master\AreaDao;
use apps\core\classier\dao\master\LogDao;
use apps\core\classier\dao\master\UserDao;
use apps\core\classier\model\AppAreaModel;
use apps\core\classier\model\AppUserModel;
use apps\core\classier\wrapper\UserWrapper;
use Exception;
use rapidPHP\modules\common\classier\AR;
use rapidPHP\modules\common\classier\Instances;
use ReflectionException;
use function rapidPHP\AR;
use function rapidPHP\formatException;

class AreaService
{

    /**
     * 单例模式
     */
    use Instances;

    /**
     * 初始化当前
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }


    /**
     * 获取地区列表
     * @param int $areaId
     * @return array|null
     * @throws Exception
     */
    public function getAreaList($areaId = null): ?array
    {
        /** @var AreaDao $areaDao */
        $areaDao = AreaDao::getInstance();

        return $areaDao->getAreaList($areaId);
    }

    /**
     * 获取地区信息
     * @param $areaId
     * @param null $level
     * @return AppAreaModel
     * @throws Exception
     */
    public function getArea($areaId, $level = null)
    {
        if (empty($areaId)) throw new Exception('地区id错误!');

        /** @var AreaDao $areaDao */
        $areaDao = AreaDao::getInstance();

        $areaModel = $areaDao->getArea($areaId, $level);

        if ($areaModel == null) throw new Exception('地区不存在!');

        return $areaModel;
    }


    /**
     * 获取地区地址详细信息
     * @param $areaId
     * @param bool $isDetail
     * @return AreaAddressBean|string
     * @throws Exception
     */
    public function getAreaAddress($areaId, $isDetail = false)
    {
        if (empty($areaId)) throw new Exception('城市id错误!');

        $provinceModel = $this->getArea($areaId, BaseConfig::AREA_LEVEL_PROVINCE);

        $countryModel = $this->getArea($provinceModel->getPid(), BaseConfig::AREA_LEVEL_COUNTRY);

        $stateModel = $this->getArea($countryModel->getPid(), BaseConfig::AREA_LEVEL_STATE);

        $provinceName = $provinceModel->getName();

        $countryName = $countryModel->getName();

        $stateName = $stateModel->getName();

        $address = "{$stateName}/{$countryName}/{$provinceName}";

        if ($isDetail == false) return $address;

        $areaAddressBean = new AreaAddressBean();

        return $areaAddressBean
            ->setProvinceId($provinceModel->getId())
            ->setProvinceName($provinceName)
            ->setProvinceEn($provinceModel->getNameEn())
            ->setProvinceCode($provinceModel->getCode())
            ->setCountryId($countryModel->getId())
            ->setCountryName($countryName)
            ->setCountryEn($countryModel->getNameEn())
            ->setCountryCode($countryModel->getCode())
            ->setStateId($stateModel->getId())
            ->setStateName($stateName)
            ->setStateEn($stateModel->getNameEn())
            ->setStateCode($stateModel->getCode())
            ->setAddress($address);
    }

    /**
     * 生成三级联动数据
     * @return array
     * @throws Exception
     */
    public function getThreeLevelAreaList(): array
    {
        $key = 'area_three_list';

        $list = RedisCacheService::getInstance()->get($key);

        if (!empty($list)) return $list;

        /** @var AreaDao $areaDao */
        $areaDao = AreaDao::getInstance();

        $list = AR::getInstance()->getTree($areaDao->getAllAreaList(), 'pid', 'id', 'children', 0);

        if (!empty($list)) RedisCacheService::getInstance()->add($key, $list);

        return $list;
    }
}