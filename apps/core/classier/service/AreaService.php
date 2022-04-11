<?php

namespace apps\core\classier\service;

use apps\core\classier\bean\AreaAddressBean;
use apps\core\classier\dao\master\AreaDao;
use apps\core\classier\enum\area\Level;
use apps\core\classier\model\AppAreaModel;
use Exception;
use rapidPHP\modules\common\classier\AR;
use rapidPHP\modules\common\classier\Http;
use rapidPHP\modules\common\classier\Instances;
use ReflectionException;
use function rapidPHP\AB;
use function rapidPHP\AR;
use function rapidPHP\B;

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
     * 获取经纬度
     * @param string $address
     * @return array
     * @throws Exception
     */
    public function getGeocodingByAddress(string $address): array
    {
        if (empty($address)) throw new Exception('address 错误!');

        $resp = Http::getInstance()
            ->getHttpResponse("https://apis.map.qq.com/ws/geocoder/v1/?address=" . urlencode($address) . "&key=DPZBZ-HCJWD-5HR4V-HYDN6-HV4B6-YUBDS");

        if (empty($resp)) throw new Exception('获取经纬度失败!');

        $data = AB(json_decode($resp, true));

        return $data->toArray('result');
    }

    /**
     * 获取地理位置
     * @param string $location
     * @return array
     * @throws Exception
     */
    public function getGeocodingByLocation(string $location): array
    {
        if (empty($location)) throw new Exception('location 错误!');

        $resp = Http::getInstance()
            ->getHttpResponse("https://apis.map.qq.com/ws/geocoder/v1/?location=" . urlencode($location) . "&key=DPZBZ-HCJWD-5HR4V-HYDN6-HV4B6-YUBDS");

        if (empty($resp)) throw new Exception('获取地理位置失败!');

        $data = AB(json_decode($resp, true));

        return $data->toArray('result');
    }

    /**
     * 通过定位获取地理位置并转成area地区
     * @param string $location
     * @return AppAreaModel[]
     * @throws ReflectionException
     * @throws Exception
     */
    public function getAreaByLocation(string $location)
    {
        $geocoding = $this->getGeocodingByLocation($location);

        if (empty($geocoding)) throw new Exception('获取地理位置失败!');

        $adCode = AR()->value($geocoding, 'ad_info.adcode');

        if (empty($adCode)) throw new Exception('解析地理位置失败!');

        $this->getAreaAddress($adCode, $areaModels);

        return $areaModels;
    }

    /**
     * 获取地区列表
     * @param null $areaId
     * @param array|null $level
     * @param int|null $size
     * @return array|null
     * @throws Exception
     */
    public function getAreaList($areaId = null, ?array $level = null, ?int $size = null): ?array
    {
        /** @var AreaDao $areaDao */
        $areaDao = AreaDao::getInstance();

        return $areaDao->getAreaList($areaId, $level, $size);
    }

    /**
     * 获取地区信息
     * @param $areaId
     * @return AppAreaModel
     * @throws Exception
     */
    public function getArea($areaId)
    {
        if (empty($areaId)) throw new Exception('地区id错误!');

        /** @var AreaDao $areaDao */
        $areaDao = AreaDao::getInstance();

        $areaModel = $areaDao->getArea($areaId);

        if ($areaModel == null) throw new Exception('地区不存在!');

        return $areaModel;
    }


    /**
     * 获取地区地址详细信息
     * @param $areaId
     * @param array|null $areaModels
     * @return AreaAddressBean
     * @throws Exception
     */
    public function getAreaAddress($areaId, ?array &$areaModels = [])
    {
        if (empty($areaId)) throw new Exception('城市id错误!');

        $loopAreaId = $areaId;

        while (!empty($loopAreaId)) {
            $areaModel = $this->getArea($loopAreaId);

            $loopAreaId = $areaModel->getPid();

            $areaModels[] = $areaModel;

            if ($areaModel->getLevel() == Level::PROVINCE) break;
        }

        usort($areaModels, function (AppAreaModel $a, AppAreaModel $b) {
            return $a->getLevel() - $b->getLevel();
        });

        /** @var AppAreaModel|null $lastModel */
        $lastModel = $areaModels[count($areaModels) - 1];

        /** @var AppAreaModel|null $provinceModel */
        $provinceModel = current(array_filter($areaModels, function (AppAreaModel $areaModel) {
            return $areaModel->getLevel() == Level::PROVINCE;
        }));

        /** @var AppAreaModel|null $cityModel */
        $cityModel = current(array_filter($areaModels, function (AppAreaModel $areaModel) {
            return $areaModel->getLevel() == Level::CITY;
        }));

        /** @var AppAreaModel|null $areaModel */
        $areaModel = current(array_filter($areaModels, function (AppAreaModel $areaModel) {
            return $areaModel->getLevel() == Level::AREA;
        }));

        $address = join('/', array_map(function (AppAreaModel $areaModel) {
            return $areaModel->getName();
        }, $areaModels));

        $areaAddressBean = new AreaAddressBean();

        return $areaAddressBean
            ->setAreaId($areaModel ? $areaModel->getId() : null)
            ->setAreaName($areaModel ? $areaModel->getName() : null)
            ->setCityId($cityModel ? $cityModel->getId() : null)
            ->setCityName($cityModel ? $cityModel->getName() : null)
            ->setProvinceId($provinceModel ? $provinceModel->getId() : null)
            ->setProvinceName($provinceModel ? $provinceModel->getName() : null)
            ->setLastId($lastModel ? $lastModel->getId() : null)
            ->setLastName($lastModel ? $lastModel->getName() : null)
            ->setAddress($address);
    }
}
