<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppNotifyModel;
use apps\core\classier\wrapper\NotifyWrapper;
use Exception;
use rapidPHP\modules\reflection\classier\Utils;
use function rapidPHP\Cal;

class NotifyDao extends MasterDao
{


    /**
     * NotifyDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppNotifyModel::class);
    }

    /**
     * 添加通知
     * @param AppNotifyModel $notifyModel
     * @return bool
     * @throws Exception
     */
    public function addNotify(AppNotifyModel $notifyModel): bool
    {
        $data = [
            'title' => $notifyModel->getTitle(),
            'brief' => $notifyModel->getBrief(),
            'content' => $notifyModel->getContent(),
            'event' => $notifyModel->getEvent(),
            'from_id' => $notifyModel->getFromId(),
            'sender_type' => $notifyModel->getSenderType(),
            'sender_id' => $notifyModel->getSenderId(),
            'receiver_id' => $notifyModel->getReceiverId(),
            'options' => $notifyModel->getOptions(),
            'is_read' => false,
            'notify_time' => Cal()->getDate(),
        ];

        if (!empty($notifyModel->getOptions())) {
            if (is_object($notifyModel->getOptions())) {
                $data['options'] = json_encode(Utils::getInstance()->toArray($notifyModel->getOptions()));
            } else if (is_array($notifyModel->getOptions())) {
                $data['options'] = json_encode($notifyModel->getOptions());
            }
        }

        $result = parent::add($data, $insertId);

        if ($result) {
            $notifyModel->setId($insertId);

            $this->delCache($notifyModel->getReceiverId());
        }

        return $result;
    }

    /**
     * 修改通知
     * @param AppNotifyModel $notifyModel
     * @return bool
     * @throws Exception
     */
    public function setNotify(AppNotifyModel $notifyModel): bool
    {
        $data = [
            'title' => $notifyModel->getTitle(),
            'brief' => $notifyModel->getBrief(),
            'content' => $notifyModel->getContent(),
            'event' => $notifyModel->getEvent(),
            'from_id' => $notifyModel->getFromId(),
            'sender_type' => $notifyModel->getSenderType(),
            'sender_id' => $notifyModel->getSenderId(),
            'receiver_id' => $notifyModel->getReceiverId(),
            'options' => $notifyModel->getOptions(),
        ];

        if (!empty($notifyModel->getOptions())) {
            if (is_object($notifyModel->getOptions())) {
                $data['options'] = json_encode(Utils::getInstance()->toArray($notifyModel->getOptions()));
            } else if (is_array($notifyModel->getOptions())) {
                $data['options'] = json_encode($notifyModel->getOptions());
            }
        }

        $result = parent::set($data)
            ->where('id', $notifyModel->getId())
            ->execute();

        if ($result) {
            $this->delCache($notifyModel->getReceiverId());
        }

        return $result;
    }


    /**
     * 获取通知
     * @param $id
     * @return NotifyWrapper
     * @throws Exception
     */
    public function getNotify($id)
    {
        return parent::get()
            ->where('id', $id)
            ->forUpdate()
            ->getStatement()
            ->fetch(NotifyWrapper::class);
    }

    /**
     * 获取未读通知
     * @param $receiverId
     * @return NotifyWrapper[]
     * @throws Exception
     */
    public function getNotReadNotify($receiverId): array
    {
        return (array)parent::get()
            ->where('is_read', false)
            ->where('receiver_id', $receiverId)
            ->order('notify_time', 'DESC')
            ->forUpdate()
            ->getStatement()
            ->fetchAll(NotifyWrapper::class);
    }

    /**
     * 设置通知已读
     * @param $ids
     * @return bool
     * @throws Exception
     */
    public function setNotifyRead($ids)
    {
        return parent::set([
            'is_read' => true,
            'last_rtime' => Cal()->getDate(),
        ])->in('id', $ids)->execute();
    }

    /**
     * 删除通知
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function delNotify($id)
    {
        return parent::del()->where('id', $id)->execute();
    }
}
