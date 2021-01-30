<?php

namespace apps\core\classier\service;

use apps\core\classier\bean\AddressListCondition;
use apps\core\classier\config\AddressConfig;
use apps\core\classier\dao\master\AddressDao;
use apps\core\classier\helper\CommonHelper;
use apps\core\classier\model\AppAddressModel;
use apps\core\classier\wrapper\AddressWrapper;
use Exception;
use libphonenumber\PhoneNumber;
use rapidPHP\modules\common\classier\Instances;
use function rapidPHP\M;

class AddressService
{

    /**
     * 单列模式
     */
    use Instances;

    /**
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }


    /**
     * 获取地址信息
     * @param $addressId
     * @return AddressWrapper
     * @throws Exception
     */
    public function getAddress($addressId)
    {
        if (empty($addressId)) throw new Exception('地址id 错误!');

        /** @var AddressDao $factoryDao */
        $factoryDao = M(AddressDao::class);

        $addressModel = $factoryDao->getAddress($addressId);

        if ($addressModel == null) throw new Exception('地址不存在!');

        /** @var PhoneNumber $phoneNumber */
        CommonHelper::validTelephone($addressModel->getTelephone(), $phoneNumber);

        $addressModel->setTcode($phoneNumber->getCountryCode());

        $addressModel->setTelephone($phoneNumber->getNationalNumber());

        /** @var AreaService $areaService */
        $areaService = AreaService::getInstance();

        $areaAddress = $areaService->getAreaAddress($addressModel->getAreaId(), true);

        $addressModel->setAddressDetail($areaAddress);

        return $addressModel;
    }

    /**
     * 获取地址列表
     * @param AddressListCondition $condition
     * @return array|null
     * @throws Exception
     */
    public function getAddressList(AddressListCondition $condition): ?array
    {
        /** @var AddressDao $addressDao */
        $addressDao = AddressDao::getInstance();

        $list = $addressDao->getAddressList($condition);

        /** @var AreaService $areaService */
        $areaService = AreaService::getInstance();

        foreach ($list as $value) {
            $areaAddress = $areaService->getAreaAddress($value->getAreaId(), true);

            $value->setAddressDetail($areaAddress);
        }

        return $list;
    }

    /**
     * 添加或者修改地址
     * @param AppAddressModel $model
     * @return bool
     * @throws Exception
     */
    public function addedAddress(AppAddressModel $model):bool
    {
        if (!AddressConfig::validType($model->getType())) throw new Exception('类型错误!');

        $model->validContactName('联系人错误!');

        $model->validTelephone('请填写手机号码!');

        $model->validAreaId('城市id错误!');

        $model->validAddress('请填写详细地址!');

        $model->validPostcode('请填写邮编!');

        $model->setTelephone(CommonHelper::validTelephone($model->getTelephone()));

        /** @var AddressDao $addressDao */
        $addressDao = AddressDao::getInstance();

        if ($model->getId()) {
            if (!$addressDao->setAddress($model))
                throw new Exception('修改失败!');
        } else {
            $model->validBindId('bind id错误!');

            if (!$addressDao->addAddress($model))
                throw new Exception('添加失败!');
        }

        return true;
    }

    /**
     * 删除地址
     * @param $addressId
     * @param $updatedId
     * @return bool
     * @throws Exception
     */
    public function delAddress($addressId, $updatedId): bool
    {
        if (empty($addressId)) throw new Exception('地址id 错误!');

        /** @var AddressDao $factoryDao */
        $factoryDao = M(AddressDao::class);

        if (!$factoryDao->delAddress($addressId, $updatedId))
            throw new Exception('删除失败!');

        return true;
    }

}