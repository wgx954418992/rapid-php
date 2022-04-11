<?php

namespace apps\core\classier\service;

use apps\core\classier\dao\master\NoticeDao;
use apps\core\classier\model\AppNoticeModel;
use Exception;
use rapidPHP\modules\common\classier\Instances;

class NoticeService
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
     * 添加notice
     * @param AppNoticeModel $noticeModel
     * @return void
     * @throws Exception
     */
    public function addedNotice(AppNoticeModel $noticeModel)
    {
        if (empty($noticeModel->getTitle())) throw new Exception('标题错误!');

        if (empty($noticeModel->getType())) throw new Exception('类型错误!');

        /** @var NoticeDao $noticeDao */
        $noticeDao = NoticeDao::getInstance();

        if (empty($noticeModel->getId())) {

            if (!$noticeDao->addNotice($noticeModel))
                throw new Exception('添加失败!');
        } else {
            if (!$noticeDao->setNotice($noticeModel))
                throw new Exception('更新失败!');
        }
    }

    /**
     * 删除通知
     * @param AppNoticeModel $noticeModel
     * @return bool
     * @throws Exception
     */
    public function delNotice(AppNoticeModel $noticeModel)
    {
        if (empty($noticeModel->getId())) throw new Exception('noticeId错误!');

        /** @var NoticeDao $noticeDao */
        $noticeDao = NoticeDao::getInstance();

        if (!$noticeDao->delNotice($noticeModel))
            throw new Exception('删除失败!');

        return true;
    }

    /**
     * 获取notice 列表
     * @return AppNoticeModel[]
     * @throws Exception
     */
    public function getNoticeList($type = null, $bindId = null): array
    {
        /** @var NoticeDao $noticeDao */
        $noticeDao = NoticeDao::getInstance();

        return $noticeDao->getNoticeList($type, $bindId);
    }

    /**
     * 获取notice 信息
     * @param $noticeId
     * @return AppNoticeModel
     * @throws Exception
     */
    public function getNotice($noticeId)
    {
        if (empty($noticeId)) throw new Exception('notice id错误!');

        /** @var NoticeDao $noticeDao */
        $noticeDao = NoticeDao::getInstance();

        $noticeModel = $noticeDao->getNotice($noticeId);

        if ($noticeModel == null) throw new Exception('notice 不存在!');

        return $noticeModel;
    }
}
