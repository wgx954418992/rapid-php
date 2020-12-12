<?php

namespace apps\app\classier\dao\master;

use apps\app\classier\dao\MasterDao;
use apps\app\classier\model\AppSettingModel;
use Exception;
use function rapidPHP\B;
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
        return parent::get()->where('is_delete', 0)
            ->getStatement()
            ->fetchAll(AppSettingModel::class);
    }

    /**
     * 添加设置
     * @param $adminId
     * @param $type
     * @param $attribute
     * @param $content
     * @param $remarks
     * @return bool
     * @throws Exception
     */
    public function addSetting($adminId, $type, $attribute, $content, $remarks): bool
    {
        return parent::add([
            'id' => B()->onlyIdToInt(),
            'type' => $type,
            'attribute' => $attribute,
            'content' => $content,
            'remarks' => $remarks,
            'is_delete' => 0,
            'created_id' => $adminId,
            'created_time' => Cal()->getDate(),
        ]);
    }

    /**
     * 修改设置
     * @param $adminId
     * @param $settingId
     * @param $type
     * @param $attribute
     * @param $content
     * @param $remarks
     * @return bool
     * @throws Exception
     */
    public function setSetting($adminId, $settingId, $type, $attribute, $content, $remarks): bool
    {
        return parent::set([
            'type' => $type,
            'attribute' => $attribute,
            'content' => $content,
            'remarks' => $remarks,
            'updated_id' => $adminId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $settingId)->execute();
    }

    /**
     * 删除设置
     * @param $adminId
     * @param $settingId
     * @return bool
     * @throws Exception
     */
    public function delSetting($adminId, $settingId): bool
    {
        return parent::set([
            'is_delete' => 1,
            'updated_id' => $adminId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $settingId)->execute();
    }

}