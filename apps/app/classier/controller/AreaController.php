<?php

namespace apps\app\classier\controller;

use apps\core\classier\service\AreaService;
use Exception;
use rapidPHP\modules\common\classier\Http;
use rapidPHP\modules\common\classier\RESTFulApi;
use function rapidPHP\AB;

/**
 * Class AreaController
 * @route /area
 * @package apps\app\classier\controller
 */
class AreaController extends BaseController
{

    /**
     * 获取地区列表
     * @route /list
     * @method get
     * @typed api
     * @param null $areaId
     * @param array|null $level get json
     * @param int|null $size
     * @return RESTFulApi
     * @throws Exception
     */
    public function getAreaList($areaId = null, ?array $level = null, ?int $size = null)
    {
        $list = AreaService::getInstance()->getAreaList($areaId, $level, $size);

        return RESTFulApi::success($list);
    }

    /**
     * 获取地区信息
     * @route /{areaId}/address
     * @method get
     * @typed api
     * @param $areaId
     * @return RESTFulApi
     * @throws Exception
     */
    public function getAreaAddress($areaId)
    {
        $data = AreaService::getInstance()->getAreaAddress($areaId, true);

        return RESTFulApi::success($data);
    }

    /**
     * 获取经纬度
     * @route /geocoding/address
     * @method get
     * @typed api
     * @param string $address
     * @return RESTFulApi
     * @throws Exception
     */
    public function getGeocoding(string $address)
    {
        $data = AreaService::getInstance()->getGeocodingByAddress($address);

        return RESTFulApi::success($data);
    }

    /**
     * 获取地理位置
     * @route /geocoding/location
     * @method get
     * @typed api
     * @param string $location
     * @return RESTFulApi
     * @throws Exception
     */
    public function getGeocodingByLocation(string $location)
    {
        $data = AreaService::getInstance()->getGeocodingByLocation($location);

        return RESTFulApi::success($data);
    }

    /**
     * 通过定位获取地理位置并转成area地区
     * @route /geocoding/area
     * @method get
     * @typed api
     * @param string $location
     * @return RESTFulApi
     * @throws Exception
     */
    public function getAreaByLocation(string $location)
    {
        $data = AreaService::getInstance()->getAreaByLocation($location);

        return RESTFulApi::success($data);
    }
}
