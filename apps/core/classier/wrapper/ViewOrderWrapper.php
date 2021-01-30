<?php


namespace apps\core\classier\wrapper;

use apps\core\classier\bean\AreaAddressBean;
use apps\core\classier\config\OrderConfig;
use apps\core\classier\helper\CommonHelper;
use apps\core\classier\model\ViewOrderModel;
use Exception;

class ViewOrderWrapper extends ViewOrderModel
{

    /**
     * 订单状态文本
     * @var string|null
     */
    private $status_text;

    /**
     * 订单支付状态文本
     * @var string|null
     */
    private $pay_status_text;

    /**
     * 工厂地址详情
     * @var AreaAddressBean|null
     */
    private $factory_adetail;

    /**
     * 仓库地址详情
     * @var AreaAddressBean|null
     */
    private $warehouse_adetail;

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
     * @return AreaAddressBean|null
     */
    public function getFactoryAdetail(): ?AreaAddressBean
    {
        return $this->factory_adetail;
    }

    /**
     * @param AreaAddressBean|null $factory_adetail
     */
    public function setFactoryAdetail(?AreaAddressBean $factory_adetail): void
    {
        $this->factory_adetail = $factory_adetail;
    }

    /**
     * @return AreaAddressBean|null
     */
    public function getWarehouseAdetail(): ?AreaAddressBean
    {
        return $this->warehouse_adetail;
    }

    /**
     * @param AreaAddressBean|null $warehouse_adetail
     */
    public function setWarehouseAdetail(?AreaAddressBean $warehouse_adetail): void
    {
        $this->warehouse_adetail = $warehouse_adetail;
    }
}