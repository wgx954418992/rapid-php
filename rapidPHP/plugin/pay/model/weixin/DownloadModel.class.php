<?php

namespace rapidPHP\plugin\pay\model\weixin;

class DownloadModel extends BaseModel
{

    /**
     * 设置微信分配的公众账号ID
     * @var mixed
     **/
    public $appid;


    /**
     * 设置微信支付分配的商户号
     * @var mixed
     **/
    public $mch_id;


    /**
     * 设置微信支付分配的终端设备号，填写此字段，只下载该设备号的对账单
     * @var mixed
     **/
    public $device_info;


    /**
     * 设置随机字符串，不长于32位。推荐随机数生成算法
     * @var mixed
     **/
    public $nonce_str;

    /**
     * 设置下载对账单的日期，格式：20140603
     * @var mixed
     **/
    public $bill_date;


    /**
     * 设置ALL，返回当日所有订单信息，默认值SUCCESS，返回当日成功支付的订单REFUND，返回当日退款订单REVOKED，已撤销的订单
     * @var mixed
     **/
    public $bill_type;

    /**
     * @return mixed
     */
    public function getAppid()
    {
        return $this->appid;
    }

    /**
     * @param mixed $appid
     */
    public function setAppid($appid): void
    {
        $this->appid = $appid;
    }

    /**
     * @return mixed
     */
    public function getMchId()
    {
        return $this->mch_id;
    }

    /**
     * @param mixed $mch_id
     */
    public function setMchId($mch_id): void
    {
        $this->mch_id = $mch_id;
    }

    /**
     * @return mixed
     */
    public function getDeviceInfo()
    {
        return $this->device_info;
    }

    /**
     * @param mixed $device_info
     */
    public function setDeviceInfo($device_info): void
    {
        $this->device_info = $device_info;
    }

    /**
     * @return mixed
     */
    public function getNonceStr()
    {
        return $this->nonce_str;
    }

    /**
     * @param mixed $nonce_str
     */
    public function setNonceStr($nonce_str): void
    {
        $this->nonce_str = $nonce_str;
    }

    /**
     * @return mixed
     */
    public function getBillDate()
    {
        return $this->bill_date;
    }

    /**
     * @param mixed $bill_date
     */
    public function setBillDate($bill_date): void
    {
        $this->bill_date = $bill_date;
    }

    /**
     * @return mixed
     */
    public function getBillType()
    {
        return $this->bill_type;
    }

    /**
     * @param mixed $bill_type
     */
    public function setBillType($bill_type): void
    {
        $this->bill_type = $bill_type;
    }
}


