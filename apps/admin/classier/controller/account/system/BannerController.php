<?php

namespace apps\admin\classier\controller\account\system;

use apps\admin\classier\controller\account\ValidaAccountController;
use apps\core\classier\model\AppBannerModel;
use apps\core\classier\service\BannerService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;

/**
 * Class BannerController
 * @route /account/system/banner
 * @package apps\admin\classier\controller\account
 */
class BannerController extends ValidaAccountController
{

    /**
     * banner列表
     * @route /list
     * @method get
     * @typed auto
     * @access SYSTEM:BANNER:LIST
     * @template account/system/banner
     * @throws Exception
     */
    public function getBannerList()
    {
        /** @var BannerService $bannerService */
        $bannerService = BannerService::getInstance();

        $list = $bannerService->getBannerList();

        return ['list' => $list];
    }

    /**
     * 添加修改Banner信息
     * @route /added
     * @method post
     * @access SYSTEM:BANNER:ADDED
     * @param AppBannerModel $bannerModel
     * @return RESTFulApi
     * @throws Exception
     */
    public function addedBanner(AppBannerModel $bannerModel)
    {
        /** @var BannerService $bannerService */
        $bannerService = BannerService::getInstance();

        $bannerModel->setCreatedId(parent::getAccountId());

        $bannerModel->setUpdatedId(parent::getAccountId());

        $bannerService->addedBanner($bannerModel);

        return RESTFulApi::success(null, '提交成功!');
    }

    /**
     * 删除banner
     * @route /{bannerId}/del
     * @method post
     * @access SYSTEM:BANNER:DEL
     * @param $bannerId
     * @return RESTFulApi
     * @throws Exception
     */
    public function delBanner($bannerId)
    {
        /** @var BannerService $bannerService */
        $bannerService = BannerService::getInstance();

        $bannerModel = $bannerService->getBanner($bannerId);

        $bannerModel->setUpdatedId(parent::getAccountId());

        $bannerService->delBanner($bannerModel);

        return RESTFulApi::success(null, '删除成功!');
    }
}