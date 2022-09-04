<?php

namespace apps\core\classier\service;

use apps\core\classier\dao\master\NotifyDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\notify\Event;
use apps\core\classier\model\AppNotifyModel;
use apps\core\classier\options\UserOptions;
use apps\core\classier\wrapper\NotifyWrapper;
use Exception;
use rapidPHP\modules\common\classier\Instances;

class NotifyService
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
     * 添加编辑通知
     * @param AppNotifyModel $notifyModel
     * @throws Exception
     */
    public function addedNotify(AppNotifyModel $notifyModel)
    {
        if (empty($notifyModel->getEvent())) throw new Exception('事件错误!');

        if (empty($notifyModel->getSenderType())) throw new Exception('sender type 错误!');

        if (empty($notifyModel->getReceiverId())) throw new Exception('receiver id 错误!');

        /** @var NotifyDao $notifyDao */
        $notifyDao = NotifyDao::getInstance();

        $isThing = MasterDao::getSQLDB()->isInThing();

        if (!$isThing) MasterDao::getSQLDB()->beginTransaction();

        try {

            if ($notifyModel->getId()) {
                $notifyDao->setNotify($notifyModel);
            } else {
                $notifyDao->addNotify($notifyModel);
            }

            if (!$isThing && !MasterDao::getSQLDB()->commit()) throw new Exception('提交失败!');

        } catch (Exception $e) {
            if (!$isThing) MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }


    /**
     * 删除通知
     * @param $id
     * @throws Exception
     */
    public function delNotify($id)
    {
        if (empty($id)) throw new Exception('id错误!');

        /** @var NotifyDao $notifyDao */
        $notifyDao = NotifyDao::getInstance();

        if (!$notifyDao->delNotify($id)) throw new Exception('删除失败!');
    }


    /**
     * set notify options
     * @param NotifyWrapper $notifyModel
     * @throws Exception
     */
    public function setNotifyOptions(NotifyWrapper $notifyModel)
    {
        /** @var UserService $userService */
        $userService = UserService::getInstance();

        $options = $notifyModel->optionsToArray();

        switch ($notifyModel->getEvent()) {
            case Event::FOLLOW:

                $userModel = $userService->getUser(
                    $notifyModel->getSenderId(),
                    $notifyModel->getReceiverId(),
                    UserOptions::i(UserOptions::FOLLOW)
                );

                $notifyModel->setSender($userModel);

                $titleArgs = [
                    'display_name' => $userModel->getDisplayName()
                ];

                $notifyModel->setTitle(Event::getTitle($notifyModel->getEvent(), $titleArgs));
                break;
        }

        $notifyModel->setOptions($options);
    }

    /**
     * 获取通知信息
     * @param $id
     * @return NotifyWrapper
     * @throws Exception
     */
    public function getNotify($id)
    {
        if (empty($id)) throw new Exception('id 错误!');

        /** @var NotifyDao $notifyDao */
        $notifyDao = NotifyDao::getInstance();

        $notifyModel = $notifyDao->getNotify($id);

        if ($notifyModel == null) throw new Exception('通知不存在!');

        $this->setNotifyOptions($notifyModel);

        return $notifyModel;
    }


    /**
     * 获取未读通知
     * @param $receiverId
     * @return NotifyWrapper[]
     * @throws Exception
     */
    public function getNotReadNotify($receiverId): array
    {
        if (empty($receiverId)) throw new Exception('接收id 错误!');

        /** @var NotifyDao $notifyDao */
        $notifyDao = NotifyDao::getInstance();

        MasterDao::getSQLDB()->beginTransaction();

        try {
            $notifyList = $notifyDao->getNotReadNotify($receiverId);

            $ids = array_map(function ($notify) {
                return $notify->getId();
            }, $notifyList);

            if (!empty($ids)) {
                $notifyDao->setNotifyRead($ids);
            }

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('获取未读通知错误!');

        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }

        $result = [];

        foreach ($notifyList as $notifyModel) {

            try {
                $this->setNotifyOptions($notifyModel);

                $result[] = $notifyModel;
            } catch (Exception $e) {
                BaseService::getInstance()->addLog('not notify list', $e);
            }
        }

        return $result;
    }
}
