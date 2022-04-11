<?php

namespace apps\app\classier\controller\account;


use apps\core\classier\service\NotifyService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;

/**
 * Class NotifyController
 * @route /account/notify
 * @package apps\app\classier\controller\account
 */
class NotifyController extends ValidaAccountController
{

    /**
     * 消息详情页面
     * @route /{id}/content
     * @method get
     * @template /account/notify/content
     * @throws Exception
     */
    public function content($id)
    {
        $data = NotifyService::getInstance()->getNotify($id);

        return ['title' => $data->getTitle(), 'content' => $data->getContent()];
    }

    /**
     * 获取未读消息
     * @route /list
     * @method get
     * @throws Exception
     */
    public function getNotReadNotify()
    {
        $list = NotifyService::getInstance()->getNotReadNotify(parent::getUserId());

        return RESTFulApi::success($list);
    }
}