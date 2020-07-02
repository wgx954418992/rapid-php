<?php

namespace rapidPHP\plugin\pay\model\weixin;

class JsApiPayModel extends BaseModel
{
    /**
     * 设置微信分配的公众账号ID
     * @var mixed
     **/
    public $appId;

    /**
     * 设置支付时间戳
     * @var mixed
     **/
    public $timeStamp;

    /**
     * 随机字符串
     * @var mixed
     **/
    public $nonceStr;


    /**
     * 设置订单详情扩展字符串
     * @var mixed
     **/
    public $package;

    /**
     * 设置签名方式
     * @var mixed
     **/
    public $signType;

    /**
     * 设置签名方式
     * @var mixed
     **/
    public $paySign;

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @param mixed $appId
     */
    public function setAppId($appId): void
    {
        $this->appId = $appId;
    }

    /**
     * @return mixed
     */
    public function getTimeStamp()
    {
        return $this->timeStamp;
    }

    /**
     * @param mixed $timeStamp
     */
    public function setTimeStamp($timeStamp): void
    {
        $this->timeStamp = $timeStamp;
    }

    /**
     * @return mixed
     */
    public function getNonceStr()
    {
        return $this->nonceStr;
    }

    /**
     * @param mixed $nonceStr
     */
    public function setNonceStr($nonceStr): void
    {
        $this->nonceStr = $nonceStr;
    }

    /**
     * @return mixed
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * @param mixed $package
     */
    public function setPackage($package): void
    {
        $this->package = $package;
    }

    /**
     * @return mixed
     */
    public function getSignType()
    {
        return $this->signType;
    }

    /**
     * @param mixed $signType
     */
    public function setSignType($signType): void
    {
        $this->signType = $signType;
    }

    /**
     * @return mixed
     */
    public function getPaySign()
    {
        return $this->paySign;
    }

    /**
     * @param mixed $paySign
     */
    public function setPaySign($paySign): void
    {
        $this->paySign = $paySign;
    }

}