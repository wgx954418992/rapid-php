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
     * @return AppSettingModel[]
     * @throws Exception
     */
    public function getSettingList(): array
    {
        return (array)$this->get()
            ->where('is_delete', false)
            ->getStatement()
            ->fetchAll($this->getModelOrClass());
    }

    /**
     * 添加设置
     * @param AppSettingModel $settingModel
     * @return bool
     * @throws Exception
     */
    public function addSetting(AppSettingModel $settingModel): bool
    {
        $result = $this->add([
            'type' => $settingModel->getType(),
            'attribute' => $settingModel->getAttribute(),
            'content' => $settingModel->getContent(),
            'remarks' => $settingModel->getRemarks(),
            'is_delete' => false,
            'created_id' => $settingModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ], $inserId);

        if ($result) $settingModel->setId($inserId);

        return $result;
    }

    /**
     * 修改设置
     * @param AppSettingModel $settingModel
     * @return bool
     * @throws Exception
     */
    public function setSetting(AppSettingModel $settingModel): bool
    {
        return $this->set([
            'type' => $settingModel->getType(),
            'attribute' => $settingModel->getAttribute(),
            'content' => $settingModel->getContent(),
            'remarks' => $settingModel->getRemarks(),
            'updated_id' => $settingModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $settingModel->getId())->execute();
    }

    /**
     * 删除设置
     * @param $actionId
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function delSetting($id, $actionId): bool
    {
        return $this->set([
            'is_delete' => true,
            'updated_id' => $actionId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)->execute();
    }

}
