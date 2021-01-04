<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppSettingModel;
use Exception;
use function rapidPHP\Cal;

class SettingDao extends MasterDao
{

    /**
     * SettingDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppSettingModel::class);
    }

    /**
     * 获取设置列表
     * @return AppSettingModel[]|null
     * @throws Exception
     */
    public function getSettingList(): array
    {
        return parent::get()
            ->where('is_delete', false)
            ->getStatement()
            ->fetchAll(AppSettingModel::class);
    }

    /**
     * 添加设置
     * @param $adminId
     * @param AppSettingModel $settingModel
     * @return bool
     * @throws Exception
     */
    public function addSetting($adminId, AppSettingModel $settingModel): bool
    {
        $result = parent::add([
            'type' => $settingModel->getType(),
            'attribute' => $settingModel->getAttribute(),
            'content' => $settingModel->getContent(),
            'remarks' => $settingModel->getRemarks(),
            'is_delete' => false,
            'created_id' => $adminId,
            'created_time' => Cal()->getDate(),
        ], $inserId);

        if ($result) $settingModel->setId($inserId);

        return $result;
    }

    /**
     * 修改设置
     * @param $adminId
     * @param AppSettingModel $settingModel
     * @return bool
     * @throws Exception
     */
    public function setSetting($adminId, AppSettingModel $settingModel): bool
    {
        return parent::set([
            'type' => $settingModel->getType(),
            'attribute' => $settingModel->getAttribute(),
            'content' => $settingModel->getContent(),
            'remarks' => $settingModel->getRemarks(),
            'updated_id' => $adminId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $settingModel->getId())->execute();
    }

    /**
     * 删除设置
     * @param $adminId
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function delSetting($adminId, $id): bool
    {
        return parent::set([
            'is_delete' => true,
            'updated_id' => $adminId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)->execute();
    }

}