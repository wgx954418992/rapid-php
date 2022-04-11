<?php

namespace apps\core\classier\service;

use apps\core\classier\dao\master\SettingDao;
use apps\core\classier\enum\setting\attribute\File;
use apps\core\classier\enum\setting\attribute\Media;
use apps\core\classier\enum\setting\attribute\OSS;
use apps\core\classier\enum\setting\attribute\point\IntegralRule;
use apps\core\classier\enum\setting\attribute\Report;
use apps\core\classier\enum\setting\IAttribute;
use apps\core\classier\enum\setting\Type;
use apps\core\classier\helper\CommonHelper;
use apps\core\classier\model\AppSettingModel;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use ReflectionException;
use function rapidPHP\B;

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
        return $this->settingList;
    }

    /**
     * 获取设置类型列表
     * @param Type $type
     * @return AppSettingModel[]|null
     */
    public function getTypeList(Type $type): ?array
    {
        $setting = $this->getList();

        if (empty($setting)) return null;

        $typeList = B()->getData($setting, $type->getRawValue());

        return (array)$typeList;
    }

    /**
     * 获取设置类型attr 信息
     * @param Type $type
     * @param IAttribute $attribute
     * @return AppSettingModel|null
     */
    public function getTypeAttrInfo(Type $type, IAttribute $attribute)
    {
        $typeList = $this->getTypeList($type);

        if (empty($typeList)) return null;

        return B()->getData($typeList, $attribute->getRawValue());
    }


    /**
     * 获取设置里面的值
     * @param Type $type
     * @param IAttribute $attribute
     * @return string
     */
    public function getTypeAttrValue(Type $type, IAttribute $attribute): ?string
    {
        $attributeInfo = $this->getTypeAttrInfo($type, $attribute);

        if (empty($attributeInfo)) return null;

        return $attributeInfo->getContent();
    }

    /**
     * 添加编辑设置
     * @param AppSettingModel $model
     * @throws Exception
     */
    public function addedSetting(AppSettingModel $model)
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
    }

    /**
     * 删除设置
     * @param $settingId
     * @param $actionId
     * @throws Exception
     */
    public function delSetting($settingId, $actionId)
    {
        if (empty($settingId)) throw new Exception('设置Id错误!');

        /** @var SettingDao $settingDao */
        $settingDao = SettingDao::getInstance();

        if (!$settingDao->delSetting($settingId, $actionId))
            throw new Exception('删除失败!');
    }

    /**
     * 获取文件存储path
     * @return string
     * @throws Exception
     */
    public static function getStoragePath(): string
    {
        $path = self::getInstance()
            ->getTypeAttrValue(Type::i(Type::FILE), File::i(File::STORAGE_PATH));

        CommonHelper::parseVariable($path, [], ...func_get_args());

        return $path;
    }

    /**
     * 获取oss 文件存储path
     * @return string
     * @throws ReflectionException
     */
    public static function getOssStoragePath(): string
    {
        $path = self::getInstance()
            ->getTypeAttrValue(Type::i(Type::OSS), OSS::i(OSS::STORAGE_PATH));

        CommonHelper::parseVariable($path, [], ...func_get_args());

        return $path;
    }


    /***
     * 获取视频限制时间
     * @return int|null
     * @throws ReflectionException
     */
    public static function getVideoLD(): ?int
    {
        return self::getInstance()
            ->getTypeAttrValue(Type::i(Type::MEDIA), Media::i(Media::VIDEO_LD));
    }

    /***
     * 获取积分点
     * @param IntegralRule $integral
     * @return float|null
     * @throws ReflectionException
     */
    public static function getIntegralPoint(IntegralRule $integral): ?float
    {
        return (float)self::getInstance()
            ->getTypeAttrValue(Type::i(Type::INTEGRAL_RULE), $integral);
    }


    /**
     * 每个用户每天举报多少次
     * @return int|null
     * @throws ReflectionException
     */
    public static function getUserEveryDayReportCount(): ?int
    {
        return (int)SettingService::getInstance()
            ->getTypeAttrValue(Type::i(Type::REPORT), Report::i(Report::TODAY_COUNT));
    }
}
