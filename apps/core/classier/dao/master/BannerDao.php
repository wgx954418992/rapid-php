<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppBannerModel;
use apps\core\classier\wrapper\BannerWrapper;
use Exception;
use function rapidPHP\Cal;

class BannerDao extends MasterDao
{

    /**
     * cache prefix
     */
    public const CACHE_PREFIX = 'app_banner';

    /**
     * BannerDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppBannerModel::class);
    }

    /**
     * 添加Banner
     * @param AppBannerModel $bannerModel
     * @return bool
     * @throws Exception
     */
    public function addBanner(AppBannerModel $bannerModel): bool
    {
        $data = [
            'file_id' => $bannerModel->getFileId(),
            'bind_id' => $bannerModel->getBindId(),
            'title' => $bannerModel->getTitle(),
            'type' => $bannerModel->getType(),
            'rank' => $bannerModel->getRank(),
            'is_delete' => false,
            'created_id' => $bannerModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        if ($bannerModel->getOptions()) $data['options'] = $bannerModel->getOptions();

        $result = $this->add($data, $insertId);

        if ($result) {
            $bannerModel->setId($insertId);

            $this->delCache($this->getCacheIdList('/list.*/i'));
        }

        return $result;
    }

    /**
     * 设置Banner
     * @param AppBannerModel $bannerModel
     * @return bool
     * @throws Exception
     */
    public function setBanner(AppBannerModel $bannerModel): bool
    {
        $data = [
            'file_id' => $bannerModel->getFileId(),
            'bind_id' => $bannerModel->getBindId(),
            'title' => $bannerModel->getTitle(),
            'type' => $bannerModel->getType(),
            'rank' => $bannerModel->getRank(),
            'updated_id' => $bannerModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ];

        if ($bannerModel->getOptions()) $data['options'] = $bannerModel->getOptions();

        $result = $this->set($data)
            ->where('id', $bannerModel->getId())
            ->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $bannerModel->getId()));

            $this->delCache($this->getCacheIdList('/list.*/i'));
        }

        return $result;
    }

    /**
     * 删除Banner
     * @param AppBannerModel $bannerModel
     * @return bool
     * @throws Exception
     */
    public function delBanner(AppBannerModel $bannerModel): bool
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
     * 获取banner
     * @return BannerWrapper[]
     * @throws Exception
     */
    public function getBannerList($type = null, $bindId = null): array
    {
        $cacheId = $this->getCacheId('list', $type, $bindId);

        return $this->getCacheWithCallback($cacheId, function () use ($bindId, $type) {
            $select = $this->get()
                ->where('is_delete', false);

            if ($type) $select->where('type', $type);

            if ($bindId) $select->where('bind_id', $bindId);

            return (array)$select
                ->order('rank', 'DESC')
                ->getStatement()
                ->fetchAll(BannerWrapper::class);
        });
    }

    /**
     * 获取banner信息
     * @param $id
     * @return BannerWrapper|null
     * @throws Exception
     */
    public function getBanner($id)
    {
        $cacheId = $this->getCacheId('id', $id);

        return $this->getCacheWithCallback($cacheId, function () use ($id) {
            return $this->get()
                ->where('is_delete', false)
                ->where('id', $id)
                ->getStatement()
                ->fetch(BannerWrapper::class);
        });
    }
}
