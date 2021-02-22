<?php

namespace pay\wx\classier\request;

use rapidPHP\modules\server\config\HttpConfig;

/**
 * 下载对账单，WxPayDownloadBill中bill_date为必填参数
 * Class DownloadBillRequest
 * @package pay\wx\classier\request
 */
class DownloadBillRequest extends BaseRequest
{

    /**
     * son extends
     */
    const URL = 'https://api.mch.weixin.qq.com/pay/downloadbill';

    /**
     * method son extends
     */
    const METHOD = HttpConfig::METHOD_POST;

    /**
     * 设置微信支付分配的终端设备号，填写此字段，只下载该设备号的对账单
     * @var string|null
     */
    private $device_info;

    /**
     * 设置下载对账单的日期，格式：20140603
     * @var string|null
     */
    private $bill_date;

    /**
     * 设置ALL，返回当日所有订单信息，默认值SUCCESS，返回当日成功支付的订单REFUND，返回当日退款订单REVOKED，已撤销的订单
     * @var string|null
     */
    private $bill_type;

    /**
     * @return string|null
     */
    public function getDeviceInfo(): ?string
    {
        return $this->device_info;
    }

    /**
     * @param string|null $device_info
     */
    public function setDeviceInfo(?string $device_info): void
    {
        $this->device_info = $device_info;
    }

    /**
     * @return string|null
     */
    public function getBillDate(): ?string
    {
        return $this->bill_date;
    }

    /**
     * @param string|null $bill_date
     */
    public function setBillDate(?string $bill_date): void
    {
        $this->bill_date = $bill_date;
    }

    /**
     * @return string|null
     */
    public function getBillType(): ?string
    {
        return $this->bill_type;
    }

    /**
     * @param string|null $bill_type
     */
    public function setBillType(?string $bill_type): void
    {
        $this->bill_type = $bill_type;
    }
}