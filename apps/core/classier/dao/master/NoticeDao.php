<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppNoticeModel;
use Exception;
use function rapidPHP\Cal;

class NoticeDao extends MasterDao
{

    /**
     * cache prefix
     */
    public const CACHE_PREFIX = 'app_notice';

    /**
     * NoticeDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppNoticeModel::class);
    }

    /**
     * 添加Notice
     * @param AppNoticeModel $noticeModel
     * @return bool
     * @throws Exception
     */
    public function addNotice(AppNoticeModel $noticeModel): bool
    {
        $data = [
            'bind_id' => $noticeModel->getBindId(),
            'title' => $noticeModel->getTitle(),
            'content' => $noticeModel->getContent(),
            'type' => $noticeModel->getType(),
            'rank' => $noticeModel->getRank(),
            'is_delete' => false,
            'created_id' => $noticeModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        if ($noticeModel->getOptions()) $data['options'] = $noticeModel->getOptions();

        $result = $this->add($data, $insertId);

        if ($result) {
            $noticeModel->setId($insertId);

            $this->delCache($this->getCacheIdList('/list.*/i'));
        }

        return $result;
    }

    /**
     * 设置Notice
     * @param AppNoticeModel $noticeModel
     * @return bool
     * @throws Exception
     */
    public function setNotice(AppNoticeModel $noticeModel): bool
    {
        $data = [
            'bind_id' => $noticeModel->getBindId(),
            'title' => $noticeModel->getTitle(),
            'content' => $noticeModel->getContent(),
            'type' => $noticeModel->getType(),
            'rank' => $noticeModel->getRank(),
            'updated_id' => $noticeModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ];

        if ($noticeModel->getOptions()) $data['options'] = $noticeModel->getOptions();

        $result = $this->set($data)
            ->where('id', $noticeModel->getId())
            ->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $noticeModel->getId()));

            $this->delCache($this->getCacheIdList('/list.*/i'));
        }

        return $result;
    }

    /**
     * 删除通知
     * @param AppNoticeModel $bannerModel
     * @return bool
     * @throws Exception
     */
    public function delNotice(AppNoticeModel $bannerModel): bool
    {
        $result = $this->set([
            'is_delete' => true,
            'updated_id' => $bannerModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $bannerModel->getId())->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $bannerModel->getId()));

            $this->delCache($this->getCacheIdList('/list.*/i'));
        }

        return $result;
    }


    /**
     * 获取notice
     * @return AppNoticeModel[]
     * @throws Exception
     */
    public function getNoticeList($type = null, $bindId = null): array
    {
        $cacheId = $this->getCacheId('list', $type, $bindId);

        return (array)$this->getCacheWithCallback($cacheId, function () use ($bindId, $type) {
            $select = $this->get()
                ->where('is_delete', false);

            if ($type) $select->where('type', $type);

            if ($bindId) $select->where('bind_id', $bindId);

            return (array)$select
                ->order('rank', 'DESC')
                ->getStatement()
                ->fetchAll(AppNoticeModel::class);
        });
    }

    /**
     * 获取notice信息
     * @param $id
     * @return AppNoticeModel|null
     * @throws Exception
     */
    public function getNotice($id)
    {
        $cacheId = $this->getCacheId('id', $id);

        return $this->getCacheWithCallback($cacheId, function () use ($id) {
            return $this->get()
                ->where('is_delete', false)
                ->where('id', $id)
                ->getStatement()
                ->fetch(AppNoticeModel::class);
        });
    }
}
