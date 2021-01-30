<?php

namespace apps\admin\classier\controller\admin;

use apps\core\classier\model\AppSettingModel;
use apps\core\classier\service\SettingService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;

/**
 * Class SettingController
 * @route /admin/system/setting
 * @package apps\admin\classier\controller\admin
 */
class SettingController extends ValidaAdminController
{
    /**
     * 系统设置
     * @route /list
     * @template admin/system/setting/list
     * @throws Exception
     */
    public function setting()
    {
        /** @var SettingService $settingService */
        $settingService = SettingService::getInstance();

        return [
            'list' => $settingService->getList()
        ];
    }

    /**
     * 添加修改设置信息
     * @route /added
     * @method post
     * @param AppSettingModel $settingModel
     * @return RESTFulApi
     * @throws Exception
     */
    public function added(AppSettingModel $settingModel)
    {
        /** @var SettingService $settingService */
        $settingService = SettingService::getInstance();

        $settingModel->setCreatedId(parent::getAdminId());

        $settingModel->setUpdatedId(parent::getAdminId());

        $settingService->added($settingModel);

        return RESTFulApi::success(null, '提交成功!');
    }

    /**
     * 删除设置
     * @route /{settingId}/del
     * @method post
     * @param $settingId
     * @return RESTFulApi
     * @throws Exception
     */
    public function delSetting($settingId)
    {
        /** @var SettingService $settingService */
        $settingService = SettingService::getInstance();

        $settingService->del($settingId, parent::getAdminId());

        return RESTFulApi::success(null, '删除成功!');
    }
}