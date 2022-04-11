<?php

namespace apps\app\classier\controller\account;

use apps\core\classier\service\FollowService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;

/**
 * Class FollowController
 * @route /account/follow
 * @package apps\app\classier\controller\account
 */
class FollowController extends ValidaAccountController
{

    /**
     * 添加关注
     * @route /add
     * @method post
     * @param $userId
     * @return RESTFulApi
     * @throws Exception
     */
    public function addFollow($userId)
    {
        $followModel = FollowService::getInstance()->addFollow(parent::getUserId(), $userId);

        return RESTFulApi::success($followModel);
    }

    /**
     * 通过FromId 跟 ToId 删除关注
     * @route /del
     * @method post
     * @param $fromId
     * @param $toId
     * @return RESTFulApi
     * @throws Exception
     */
    public function delFollowBYFT($fromId, $toId)
    {
        if (empty($fromId)) throw new Exception('fromId 错误');

        if (empty($toId)) throw new Exception('toId 错误');

        if ($fromId != parent::getUserId() && $toId != parent::getUserId())
            throw new Exception('无权操作!');

        try {
            FollowService::getInstance()->delFollow($fromId, $toId);
        } catch (Exception $e) {

        }

        try {
            $followModel = FollowService::getInstance()->getFollowByFT($toId, $fromId);
        } catch (Exception $e) {
            $followModel = null;
        }

        return RESTFulApi::success($followModel);
    }
}
