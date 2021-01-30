<?php

namespace apps\app\classier\controller;

use apps\core\classier\service\AreaService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;

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
     * @param $areaId
     * @return RESTFulApi
     * @throws Exception
     */
    public function getAreaList($areaId)
    {
        $list = AreaService::getInstance()->getAreaList($areaId);

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
     * 生成三级联动数据
     * @route /three
     * @method get
     * @typed raw
     * @encode json
     * @throws Exception
     */
    public function getThreeLevelAreaList()
    {
        return AreaService::getInstance()->getThreeLevelAreaList();
    }
}