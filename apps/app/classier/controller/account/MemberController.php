<?php

namespace apps\app\classier\controller\account;


use apps\core\classier\service\user\MemberService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;

/**
 * Class MemberController
 * @route /account/member
 * @package apps\app\classier\controller\account
 */
class MemberController extends ValidaAccountController
{

    /**
     * 创建开通会员订单
     * @route /order/create
     * @method post
     * @param $memberId
     * @return RESTFulApi
     * @throws Exception
     */
    public function createOrder($memberId)
    {
        $data = MemberService::getInstance()->createOrder($memberId, $this->getUserId());

        return RESTFulApi::success($data);
    }

    /**
     * 用过专业id获取当前用户会员信息
     * @route /major/{majorId}/get
     * @method get
     * @param $majorId
     * @return RESTFulApi
     * @throws Exception
     */
    public function getMemberByMajorId($majorId)
    {
        $data = MemberService::getInstance()
            ->getMemberByUM(parent::getUserId(), $majorId);

        return RESTFulApi::success($data);
    }

}
