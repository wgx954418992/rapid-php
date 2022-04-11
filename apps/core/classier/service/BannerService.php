<?php

namespace apps\core\classier\service;

use apps\core\classier\dao\master\BannerDao;
use apps\core\classier\model\AppBannerModel;
use apps\core\classier\wrapper\BannerWrapper;
use apps\file\classier\config\FileConfig;
use Exception;
use rapidPHP\modules\common\classier\Instances;

class BannerService
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
     * 添加banner
     * @param AppBannerModel $bannerModel
     * @return void
     * @throws Exception
     */
    public function addedBanner(AppBannerModel $bannerModel)
    {
        if (empty($bannerModel->getTitle())) throw new Exception('标题错误!');

        if (empty($bannerModel->getType())) throw new Exception('类型错误!');

        if (empty($bannerModel->getFileId())) throw new Exception('文件id错误!');

        /** @var BannerDao $bannerDao */
        $bannerDao = BannerDao::getInstance();

        if (empty($bannerModel->getId())) {

            if (!$bannerDao->addBanner($bannerModel))
                throw new Exception('添加失败!');
        } else {
            if (!$bannerDao->setBanner($bannerModel))
                throw new Exception('更新失败!');
        }
    }

    /**
     * 删除banner
     * @param AppBannerModel $bannerModel
     * @return bool
     * @throws Exception
     */
    public function delBanner(AppBannerModel $bannerModel)
    {
        if (empty($bannerModel->getId())) throw new Exception('bannerId错误!');

        /** @var BannerDao $bannerDao */
        $bannerDao = BannerDao::getInstance();

        if (!$bannerDao->delBanner($bannerModel))
            throw new Exception('删除失败!');

        return true;
    }


    /**
     * 获取banner 列表
     * @return BannerWrapper[]
     * @throws Exception
     */
    public function getBannerList($type = null, $bindId = null): array
    {
        /** @var BannerDao $bannerDao */
        $bannerDao = BannerDao::getInstance();

        $list = $bannerDao->getBannerList($type, $bindId);

        foreach ($list as $item) {
            $item->setPicUrl(FileConfig::getFileUrl($item->getFileId()));
        }

        return $list;
    }

    /**
     * 获取banner 信息
     * @param $bannerId
     * @return AppBannerModel
     * @throws Exception
     */
    public function getBanner($bannerId)
    {
        if (empty($bannerId)) throw new Exception('banner id错误!');

        /** @var BannerDao $bannerDao */
        $bannerDao = BannerDao::getInstance();

        $bannerModel = $bannerDao->getBanner($bannerId);

        if ($bannerModel == null) throw new Exception('banner 不存在!');

        return $bannerModel;
    }

}
