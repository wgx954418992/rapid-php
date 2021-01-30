<?php

namespace apps\admin\classier\controller\admin\user;

use apps\admin\classier\controller\admin\ValidaAdminController;
use apps\core\classier\bean\AddressListCondition;
use apps\core\classier\model\AppAddressModel;
use apps\core\classier\service\AddressService;
use apps\core\classier\service\AreaService;
use apps\core\classier\wrapper\AddressWrapper;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use rapidPHP\modules\reflection\classier\Utils;

/**
 * Class AddressController
 * @route /admin/user/address
 * @package apps\admin\classier\controller\admin\user
 */
class AddressController extends ValidaAdminController
{


    /**
     * 地址列表
     * @route /list
     * @template admin/user/address/list
     * @param AddressListCondition $condition
     * @return array
     * @throws Exception
     */
    public function list(AddressListCondition $condition)
    {
        if (empty($condition->getBindId())) throw new Exception('bind id 错误!');

        $list = AddressService::getInstance()->getAddressList($condition);

        return [
            'condition' => $condition,
            'list' => $list,
        ];
    }

    /**
     * 添加或者编辑地址详情
     * @route /added
     * @template admin/user/address/added
     * @param $submit
     * @param AppAddressModel $model
     * @return array
     * @throws Exception
     */
    public function added($submit, AppAddressModel $model)
    {
        $countryList = [];

        $provinceList = [];

        if (!empty($submit)) {
            AddressService::getInstance()->addedAddress($model);
        } else {
            $countryList = AreaService::getInstance()->getAreaList();

            if (!empty($model->getId())) {
                $model = AddressService::getInstance()->getAddress($model->getId());

                $provinceList = AreaService::getInstance()->getAreaList($model->getAddressDetail()->getCountryId());
            } else {
                $model = new AddressWrapper(Utils::getInstance()->toArray($model));
            }
        }

        return [
            'address' => $model,
            'countryList' => $countryList,
            'provinceList' => $provinceList
        ];
    }

    /**
     * 删除地址
     * @route /{addressId}/del
     * @method post
     * @typed api
     * @param $addressId
     * @return RESTFulApi
     * @throws Exception
     */
    public function del($addressId)
    {
        AddressService::getInstance()->delAddress($addressId, parent::getAdminId());

        return RESTFulApi::success(null, '删除成功');
    }
}