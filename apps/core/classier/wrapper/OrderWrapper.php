<?php


namespace apps\core\classier\wrapper;

use apps\core\classier\config\OrderConfig;
use apps\core\classier\model\AppOrderModel;
use apps\core\classier\wrapper\user\AddressWrapper;

class OrderWrapper extends AppOrderModel
{

    /**
     * 订单状态文本
     * @var string|null
     */
    public $status_text;

    /**
     * 订单支付状态文本
     * @var string|null
     */
    public $pay_status_text;

    /**
     * @var AddressWrapper|null
     */
    public $factory_detail;

    /**
     * @var AddressWrapper|null
     */
    public $warehouse_detail;

    /**
     * @param int|null $status
     */
    public function setStatus(?int $status)
    {
        $this->status_text = OrderConfig::getOrderStatusText($status);

        parent::setStatus($status);
    }

    /**
     * @param int|null $pay_status
     */
    public function setPayStatus(?int $pay_status)
    {
        $this->pay_status_text = OrderConfig::getOrderPayStatusText($pay_status);

        parent::setPayStatus($pay_status);
    }


    /**
     * @return string|null
     */
    public function getStatusText(): ?string
    {
        return $this->status_text;
    }

    /**
     * @return string|null
     */
    public function getPayStatusText(): ?string
    {
        return $this->pay_status_text;
    }

    /**
     * @param AddressWrapper|null $factory_detail
     */
    public function setFactoryDetail(?AddressWrapper $factory_detail): void
    {
        $this->factory_detail = $factory_detail;
    }


    /**
     * @return AddressWrapper|null
     */
    public function getFactoryDetail(): ?AddressWrapper
    {
        return $this->factory_detail;
    }

    /**
     * @param AddressWrapper|null $warehouse_detail
     */
    public function setWarehouseDetail(?AddressWrapper $warehouse_detail): void
    {
        $this->warehouse_detail = $warehouse_detail;
    }

    /**
     * @return AddressWrapper|null
     */
    public function getWarehouseDetail(): ?AddressWrapper
    {
        return $this->warehouse_detail;
    }
}