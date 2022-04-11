<?php

namespace apps\admin\classier\controller\account\user;

use apps\admin\classier\controller\account\ValidaAccountController;
use apps\core\classier\model\AppPointModel;
use apps\core\classier\model\PointDetailModel;
use apps\core\classier\service\WalletService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use ReflectionException;

/**
 * Class WalletController
 * @route /account/user/wallet
 * @package apps\admin\classier\controller\account
 */
class WalletController extends ValidaAccountController
{

    /**
     * 钱包详情
     * @route /{userId}/details
     * @typed auto
     * @access USER:INTEGRAL:DETAILS
     * @template account/user/wallet
     * @return array
     * @throws Exception
     */
    public function details($userId)
    {
        $contributionService = new WalletService($userId);

        return [
            'point' => $contributionService->getPoint(),
            'list' => $contributionService->getDetailsList(1)
        ];
    }

    /**
     * 设置钱包
     * @route /set
     * @typed api
     * @access USER:INTEGRAL:SET
     * @param $bindId
     * @param float $number
     * @param string $describe
     * @return RESTFulApi
     * @throws ReflectionException
     * @throws Exception
     */
    public function setWallet($bindId, float $number, string $describe)
    {
        if (empty($bindId)) throw new Exception('id 错误');

        if ($number == 0) throw new Exception('钱包点数错误');

        if (empty($describe)) throw new Exception('更改详情错误');

        $contributionService = new WalletService($bindId);

        $contributionService->addPoint($number, $describe);

        return RESTFulApi::success();
    }
}
