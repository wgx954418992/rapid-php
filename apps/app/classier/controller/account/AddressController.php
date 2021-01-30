<?php

namespace apps\app\classier\controller\account;

use apps\core\classier\bean\AddressListCondition;
use apps\core\classier\model\AppAddressModel;
use apps\core\classier\service\AddressService as CoreAddressService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;

/**
 * Class AddressController
 * @route /account/address
 * @package apps\app\classier\controller\account
 *
 */
class AddressController extends ValidaAccountController
{

    /**
     * 获取地址信息
     * @route /{addressId}/info
     * @method get
     * @typed api
     * @param $addressId
     * @return RESTFulApi
     * @throws Exception
     */
    public function getAddress($addressId)
    {
        $data = CoreAddressService::getInstance()->getAddress($addressId);

        return RESTFulApi::success($data);
    }

    /**
     * 获取地址列表
     * @route /list
     * @method get
     * @typed api
     * @param AddressListCondition $condition
     * @return RESTFulApi
     * @throws Exception
     */
    public function getAddressList(AddressListCondition $condition)
    {
        $condition->setBindId(parent::getUserId());

        $data = CoreAddressService::getInstance()->getAddressList($condition);

        return RESTFulApi::success($data);
    }

    /**
     * 添加或者修改地址
     * @route /added
     * @method post
     * @typed api
     * @param AppAddressModel $model
     * @return RESTFulApi
     * @throws Exception
     */
    public function addedAddress(AppAddressModel $model)
    {
        $model->setBindId(parent::getUserId());

        $model->setCreatedId(parent::getUserId());

        $model->setUpdatedId(parent::getUserId());

        CoreAddressService::getInstance()->addedAddress($model);

        return RESTFulApi::success(null, '提交成功');
    }

    /**
     * 删除地址
     * @route /{id}/del
     * @method post
     * @typed api
     * @param $id
     * @return RESTFulApi
     * @throws Exception
     */
    public function delAddress($id)
    {
        CoreAddressService::getInstance()->delAddress($id, parent::getUserId());

        return RESTFulApi::success(null, '删除成功');
    }

}