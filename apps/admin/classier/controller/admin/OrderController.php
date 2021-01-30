<?php

namespace apps\admin\classier\controller\admin;

use apps\admin\classier\context\WebContext;
use apps\admin\classier\service\admin\UserService;
use apps\core\classier\bean\AddressListCondition;
use apps\core\classier\bean\OrderListCondition;
use apps\core\classier\config\BaseConfig;
use apps\core\classier\model\AppOrderModel;
use apps\core\classier\service\AddressService;
use apps\core\classier\service\OrderService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use function rapidPHP\B;

/**
 * Class OrderController
 * @route /admin/order
 * @package apps\admin\classier\controller\admin
 */
class OrderController extends ValidaAdminController
{

    /**
     * 订单列表
     * @route /list
     * @template admin/order/list
     * @param OrderListCondition $condition
     * @return array
     * @throws Exception
     */
    public function list(OrderListCondition $condition)
    {
        $list = OrderService::getInstance()->getList($condition);

        $count = OrderService::getInstance()->getListCount($condition);

        $pager = BaseConfig::pager($count, $condition->getPage(), BaseConfig::PAGE_SIZE_DEFAULT);

        return [
            'condition' => $condition,
            'count' => $count,
            'pager' => $pager,
            'list' => $list,
        ];
    }

    /**
     * 订单列表
     * @route /set
     * @method post
     * @template admin/order/list
     * @param AppOrderModel $orderModel
     * @return RESTFulApi
     * @throws Exception
     */
    public function setOrderInfo(AppOrderModel $orderModel)
    {
        $orderModel->setUpdatedId(parent::getAdminId());

        OrderService::getInstance()->setOrder($orderModel);

        return RESTFulApi::success(null, '修改成功');
    }
}