<?php

namespace apps\app\classier\controller;


use apps\core\classier\service\MemberService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;

/**
 * Class MemberController
 * @route /member
 * @package apps\app\classier\controller
 */
class MemberController extends BaseController
{

    /**
     * 通过专业id获取会员列表
     * @route /{majorId}/list
     * @method get
     * @param $majorId
     * @return RESTFulApi
     * @throws Exception
     */
    public function getMemberListByMajorId($majorId)
    {
        $list = MemberService::getInstance()->getMemberListByMajorId($majorId);

        return RESTFulApi::success($list);
    }
}
