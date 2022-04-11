<?php

namespace apps\admin\classier\controller\account\system;

use apps\admin\classier\controller\account\ValidaAccountController;
use apps\core\classier\model\AppSettingModel;
use apps\core\classier\service\SettingService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;

/**
 * Class SettingController
 * @route /account/system/setting
 * @package apps\admin\classier\controller\account
 */
class SettingController extends ValidaAccountController
{

    /**
     * 系统设置
     * @route /list
     * @method get
     * @typed auto
     * @access SYSTEM:SETTING:LIST
     * @template account/system/setting
     * @throws Exception
     */
    public function getSettingList()
    {
        /** @var SettingService $settingService */
        $settingService = SettingService::getInstance();

        return ['list' => $settingService->getList()];
    }

    /**
     * 添加修改设置信息
     * @route /added
     * @method post
     * @access SYSTEM:SETTING:ADDED
     * @param AppSettingModel $settingModel
     * @return RESTFulApi
     * @throws Exception
     */
    public function addedSetting(AppSettingModel $settingModel)
    {
        /** @var SettingService $settingService */
        $settingService = SettingService::getInstance();

        $settingModel->setCreatedId(parent::getAccountId());

        $settingModel->setUpdatedId(parent::getAccountId());

        $settingService->addedSetting($settingModel);

        return RESTFulApi::success(null, '提交成功!');
    }

    /**
     * 删除设置
     * @route /{settingId}/del
     * @method post
     * @access SYSTEM:SETTING:DEL
     * @param $settingId
     * @return RESTFulApi
     * @throws Exception
     */
    public function delSetting($settingId)
    {
        /** @var SettingService $settingService */
        $settingService = SettingService::getInstance();

        $settingService->delSetting($settingId, parent::getAccountId());

        return RESTFulApi::success(null, '删除成功!');
    }
}