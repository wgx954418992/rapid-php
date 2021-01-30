<?php

namespace apps\core\classier\service;

use apps\core\classier\config\SetConfig;
use apps\core\classier\dao\master\SettingDao;
use apps\core\classier\model\AppSettingModel;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\common\classier\Variable;
use function rapidPHP\B;
use function rapidPHP\Cal;

class SettingService
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
     * @var array
     */
    protected $settingList = [];

    /**
     * SettingService constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * 初始化设置
     * @throws Exception
     */
    private function init()
    {
        $settingList = SettingDao::getInstance()->getSettingList();

        foreach ($settingList as $value) {

            $type = $value->getType();

            $attribute = $value->getAttribute();

            if (empty(trim($attribute))) {
                $this->settingList[$type][] = $value;
            } else {
                $this->settingList[$type][$attribute] = $value;
            }
        }
    }

    /**
     * 获取设置列表
     * @return array
     */
    public function getList(): array
    {
        return (array)$this->settingList;
    }

    /**
     * 获取设置类型列表
     * @param $type
     * @return array|null
     */
    public function getTypeList($type): ?array
    {
        $setting = $this->getList();

        if (empty($setting)) return null;

        $typeList = B()->getData($setting, $type);

        return (array)$typeList;
    }

    /**
     * 获取设置类型attr 信息
     * @param $type
     * @param $attribute
     * @return AppSettingModel|null
     */
    public function getTypeAttrInfo($type, $attribute)
    {
        $typeList = $this->getTypeList($type);

        if (empty($typeList)) return null;

        /** @var AppSettingModel $attributeInfo */
        $attributeInfo = B()->getData($typeList, $attribute);

        return $attributeInfo;
    }


    /**
     * 获取设置里面的值
     * @param $type
     * @param $attribute
     * @return string
     */
    public function getTypeAttrValue($type, $attribute): ?string
    {
        $attributeInfo = $this->getTypeAttrInfo($type, $attribute);

        if (empty($attributeInfo)) return null;

        return $attributeInfo->getContent();
    }

    /**
     * 添加设置
     * @param AppSettingModel $model
     * @return bool
     * @throws Exception
     */
    public function added(AppSettingModel $model): bool
    {
        $model->validType('类型错误!');

        $model->validType('属性错误!');

        $model->validType('值错误!');

        /** @var SettingDao $settingDao */
        $settingDao = SettingDao::getInstance();

        if ($model->getId()) {
            if (!$settingDao->setSetting($model)) throw new Exception('修改失败!');
        } else {
            if (!$settingDao->addSetting($model)) throw new Exception('添加失败!');
        }

        return true;
    }

    /**
     * 删除设置
     * @param $settingId
     * @param $updatedId
     * @return bool
     * @throws Exception
     */
    public function del($settingId, $updatedId): bool
    {
        if (empty($settingId)) throw new Exception('设置Id错误!');

        /** @var SettingDao $settingDao */
        $settingDao = SettingDao::getInstance();

        if (!$settingDao->delSetting($updatedId, $settingId))
            throw new Exception('删除失败!');

        return true;
    }

    /***
     * 获取文件存储path
     * @param string $end
     * @return string
     * @throws Exception
     */
    public static function getStoragePath($end = ''): string
    {
        $path = self::getInstance()
            ->getTypeAttrValue(SetConfig::TYPE_FILE_STORAGE,
                SetConfig::ATTRIBUTE_FILE_STORAGE_PATH);

        Variable::parseVarByString($path);

        $year = Cal()->getDate(time(), 'Y');

        $month = Cal()->getDate(time(), 'm');

        $day = Cal()->getDate(time(), 'd');

        $path = str_replace(['{year}', '{month}', '{day}'], [$year, $month, $day], $path);

        if (!is_dir($path) && !mkdir($path, 0777, true)) throw new Exception('创建目录失败!');

        $path = rtrim($path, '/*');

        return empty($end) ? $path : $path . '/' . $end;
    }
}