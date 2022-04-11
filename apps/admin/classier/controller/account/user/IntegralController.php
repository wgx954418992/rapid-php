<?php

namespace apps\admin\classier\controller\account\user;

use apps\admin\classier\controller\account\ValidaAccountController;
use apps\core\classier\model\AppPointModel;
use apps\core\classier\model\PointDetailModel;
use apps\core\classier\service\IntegralService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use ReflectionException;

/**
 * Class IntegralController
 * @route /account/user/integral
 * @package apps\admin\classier\controller\account
 */
class IntegralController extends ValidaAccountController
{

    /**
     * 积分详情
     * @route /{userId}/details
     * @typed auto
     * @access USER:INTEGRAL:DETAILS
     * @template account/user/integral
     * @return array
     * @throws Exception
     */
    public function details($userId)
    {
        $integralService = new IntegralService($userId);

        return [
            'point' => $integralService->getPoint(),
            'list' => $integralService->getDetailsList(1)
        ];
    }

    /**
     * 设置积分
     * @route /set
     * @typed api
     * @access USER:INTEGRAL:SET
     * @param $bindId
     * @param int $number
     * @param string $describe
     * @return RESTFulApi
     * @throws ReflectionException
     * @throws Exception
     */
    public function setIntegral($bindId, int $number, string $describe)
    {
        if (empty($bindId)) throw new Exception('id 错误');

        if ($number == 0) throw new Exception('积分点数错误');

        if (empty($describe)) throw new Exception('更改详情错误');

        $integralService = new IntegralService($bindId);

        $integralService->addPoint($number, $describe);

        return RESTFulApi::success();
    }
}
