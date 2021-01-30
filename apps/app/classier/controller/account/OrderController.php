<?php

namespace apps\app\classier\controller\account;


use apps\app\classier\service\account\AccountService;
use apps\core\classier\bean\OrderListCondition;
use apps\core\classier\config\CompanyConfig;
use apps\core\classier\config\ErrorConfig;
use apps\core\classier\config\OrderConfig;
use apps\core\classier\model\AppOrderModel;
use apps\core\classier\service\OrderService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;

/**
 * Class OrderController
 * @route /account/order
 * @package apps\app\classier\controller\account
 */
class OrderController extends ValidaAccountController
{

    /**
     * 创建订单
     * @route /create
     * @method post
     * @typed api
     * @param AppOrderModel $orderModel
     * @param $factoryId
     * @param $warehouseId
     * @return RESTFulApi
     * @throws Exception
     */
    public function createOrder(AppOrderModel $orderModel, $factoryId, $warehouseId)
    {
        $accountService = new AccountService(parent::getCurrentUser());

        $companyModel = $accountService->getCurrentCompany();

        if ($companyModel == null) throw new Exception('请先完善用户信息，并且通过审核!', ErrorConfig::USER_INFO_NOT_PERFECT);

        switch ($companyModel->getStatus()) {
            case CompanyConfig::STATUS_WAITING:
                throw new Exception('您的信息还未通过审核，请先审核后在下单!');
        }

        $orderModel->setUserId(parent::getUserId());

        $orderModel->setCreatedId(parent::getUserId());

        $model = OrderService::getInstance()->createOrder($orderModel, $factoryId, $warehouseId);

        return RESTFulApi::success($model, '创建成功');
    }

    /**
     * 获取订单列表
     * @route /list
     * @method get
     * @typed api
     * @param OrderListCondition $condition
     * @return RESTFulApi
     * @throws Exception
     */
    public function getOrderList(OrderListCondition $condition)
    {
        $condition->setUserId(parent::getUserId());

        $data = OrderService::getInstance()->getList($condition);

        return RESTFulApi::success($data);
    }


    /**
     * 获取订单详情
     * @route /{id}/detail
     * @method get
     * @typed api
     * @param $id
     * @return RESTFulApi
     * @throws Exception
     */
    public function getOrderDetail($id)
    {
        $data = OrderService::getInstance()->getDetail($id);

        return RESTFulApi::success($data);
    }

    /**
     * 取货
     * @route /{id}/take
     * @method post
     * @typed api
     * @param $id
     * @return RESTFulApi
     * @throws Exception
     */
    public function takeOrder($id)
    {
        $orderModel = OrderService::getInstance()->getOrder($id);

        if ($orderModel->getPayStatus() != OrderConfig::PAY_STATUS_PAYED) {
            throw new Exception('请先支付后进行取货!');
        }

        $orderModel->setStatus(OrderConfig::ORDER_STATUS_COMPLETE);

        $orderModel->setUpdatedId(parent::getUserId());

        OrderService::getInstance()->setOrder($orderModel);

        return RESTFulApi::success(null, '取货完成');
    }

    /**
     * 取消订单
     * @route /{id}/cancel
     * @method post
     * @typed api
     * @param $id
     * @return RESTFulApi
     * @throws Exception
     */
    public function cancelOrder($id)
    {
        $orderModel = OrderService::getInstance()->getOrder($id);

        if ($orderModel->getStatus() != OrderConfig::ORDER_STATUS_CONFIRMING) {
            throw new Exception('无法取消订单!');
        }

        $orderModel->setStatus(OrderConfig::ORDER_STATUS_CANCEL);

        $orderModel->setUpdatedId(parent::getUserId());

        OrderService::getInstance()->setOrder($orderModel);

        return RESTFulApi::success(null, '取消成功');
    }

}