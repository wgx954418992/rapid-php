<?php

namespace apps\queue\classier\process\order;

use apps\core\classier\config\AddressConfig;
use apps\core\classier\config\MiniConfig;
use apps\core\classier\config\OrderConfig;
use apps\core\classier\config\SMSConfig;
use apps\core\classier\dao\master\AddressDao;
use apps\core\classier\dao\master\user\WeixinDao;
use apps\core\classier\model\AppOrderModel;
use apps\core\classier\model\AppQueueModel;
use apps\core\classier\service\BaseService;
use apps\queue\classier\config\QueueConfig;
use apps\queue\classier\service\QueueService;
use Exception;

class StatusChangeProcess extends OrderParentProcess
{

    /**
     * 发送短信通知
     * @param AppOrderModel $orderModel
     */
    private function sendSMSNotify(AppOrderModel $orderModel)
    {
        try {
            /** @var AddressDao $addressDao */
            $addressDao = AddressDao::getInstance();

            $euroStores = $addressDao->getFirstAddressByBT($orderModel->getUserId(), AddressConfig::TYPE_EUROPEAN_STORES);

            if ($euroStores == null) throw new Exception('欧洲店铺错误！' . $orderModel->getId());

            if (empty($euroStores->getTelephone())) throw new Exception('欧洲店铺手机号码错误！');

            if ($orderModel->getStatus() == OrderConfig::ORDER_STATUS_WAIT_TAKE) {
                $templateId = SMSConfig::TEMPLATE_TYPE_ORDER_WAITING_TAKE;

                $templateData = [
                    'order_id' => $orderModel->getId(),
                    'order_status' => OrderConfig::getOrderStatusText($orderModel->getStatus()),
                    'pickup_code' => $orderModel->getPickupCode(),
                ];
            } else {
                $templateId = SMSConfig::TEMPLATE_TYPE_ORDER_STATUS_CHANGE;

                $templateData = [
                    'order_id' => $orderModel->getId(),
                    'order_status' => OrderConfig::getOrderStatusText($orderModel->getStatus()),
                ];
            }

            QueueService::getInstance()->addSMSNotifyQueue($euroStores->getTelephone(), $templateId, microtime(true) * 1000, [
                QueueConfig::PARAM_KEY_SMS_PARAM => $templateData
            ]);
        } catch (Exception $e) {
            BaseService::getInstance()->addLog('sendSMSNotify fail', $e);
        }
    }

    /**
     * 发送小程序通知
     * @param AppOrderModel $orderModel
     */
    private function sendMiniNotify(AppOrderModel $orderModel)
    {
        try {
            /** @var WeixinDao $weixinDao */
            $weixinDao = WeixinDao::getInstance();

            $wxUserModel = $weixinDao->getWXUserByUserId($orderModel->getUserId());

            if ($wxUserModel == null) throw new Exception('没有找到该用户绑定的微信账户!');

            $openId = $wxUserModel->getOpenId();

            if ($orderModel->getStatus() == OrderConfig::ORDER_STATUS_WAIT_TAKE) {
                $templateId = MiniConfig::TEMPLATE_ID_ORDER_WAITING_TAKE;

                $templateData = MiniConfig::getWaitingTakeTemplateData($orderModel->getId(), $orderModel->getPickupCode());
            } else {
                $templateId = MiniConfig::TEMPLATE_ID_ORDER_STATUS_CHANGE;

                $templateData = MiniConfig::getOrderStatusChangeTemplateData($orderModel->getId(),
                    OrderConfig::getOrderStatusText($orderModel->getStatus()));
            }

            QueueService::getInstance()->addMiniNotifyQueue($openId, $templateId, microtime(true) * 1000, [
                QueueConfig::PARAM_KEY_MINI_PAGE => '/pages/order/info/info?id=' . $orderModel->getId(),
                QueueConfig::PARAM_KEY_MINI_DATA => $templateData,
            ]);
        } catch (Exception $e) {
            BaseService::getInstance()->addLog('sendMiniNotify fail', $e);
        }
    }

    /**
     * 处理订单创建成功
     * @param $orderId
     * @param AppOrderModel $orderModel
     * @param AppQueueModel $queueModel
     * @throws Exception
     */
    public function onProcess($orderId, AppOrderModel $orderModel, AppQueueModel $queueModel)
    {
        switch ($orderModel->getStatus()) {
            case OrderConfig::ORDER_STATUS_CONFIRMING:
            case OrderConfig::ORDER_STATUS_COMPLETE:
            case OrderConfig::ORDER_STATUS_CANCEL:
                break;
            case OrderConfig::ORDER_STATUS_CLEARANCE:
            case OrderConfig::ORDER_STATUS_WAIT_TAKE:
                $this->sendSMSNotify($orderModel);

                $this->sendMiniNotify($orderModel);
                break;
            default:
                $this->sendSMSNotify($orderModel);
                break;
        }
    }
}