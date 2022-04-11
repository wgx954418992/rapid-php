<?php

namespace apps\admin\classier\controller\account\system;

use apps\admin\classier\controller\account\ValidaAccountController;
use apps\core\classier\model\AppNoticeModel;
use apps\core\classier\service\NoticeService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use function rapidPHP\B;

/**
 * Class NoticeController
 * @route /account/system/notice
 * @package apps\admin\classier\controller\account
 */
class NoticeController extends ValidaAccountController
{

    /**
     * 通知列表
     * @route /list
     * @method get
     * @typed auto
     * @access SYSTEM:NOTICE:LIST
     * @template account/system/notice
     * @throws Exception
     */
    public function getNoticeList()
    {
        /** @var NoticeService $noticeService */
        $noticeService = NoticeService::getInstance();

        return ['list' => $noticeService->getNoticeList()];
    }

    /**
     * 添加修改通知信息
     * @route /added
     * @method post
     * @access SYSTEM:NOTICE:ADDED
     * @param AppNoticeModel $noticeModel
     * @return RESTFulApi
     * @throws Exception
     */
    public function addedNotice(AppNoticeModel $noticeModel)
    {
        $content = B()->getData($this->getRequest()->post, 'content');

        $noticeModel->setContent($content);

        /** @var NoticeService $noticeService */
        $noticeService = NoticeService::getInstance();

        $noticeModel->setCreatedId(parent::getAccountId());

        $noticeModel->setUpdatedId(parent::getAccountId());

        $noticeService->addedNotice($noticeModel);

        return RESTFulApi::success(null, '提交成功!');
    }

    /**
     * 删除通知
     * @route /{noticeId}/del
     * @method post
     * @access SYSTEM:NOTICE:DEL
     * @param $noticeId
     * @return RESTFulApi
     * @throws Exception
     */
    public function delNotice($noticeId)
    {
        /** @var NoticeService $noticeService */
        $noticeService = NoticeService::getInstance();

        $noticeModel = $noticeService->getNotice($noticeId);

        $noticeModel->setUpdatedId(parent::getAccountId());

        $noticeService->delNotice($noticeModel);

        return RESTFulApi::success(null, '删除成功!');
    }
}
