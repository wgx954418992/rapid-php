<?php

namespace rapidPHP\plugin\pay\model\weixin;

use rapidPHP\plugin\pay\model\weixin\BaseModel;

class BizPayUrlModel extends BaseModel
{
    /**
     * 设置微信分配的公众账号ID
     * @param $value
     * @return $this
     **/
    public $appid;


    /**
     * 设置微信支付分配的商户号
     * @param $value
     * @return $this
     **/
    public $mch_id;

    /**
     * 设置支付时间戳
     * @param $value
     * @return $this
     **/
    public $time_stamp;

    /**
     * 设置随机字符串
     * @param $value
     * @return $this
     **/
    public $nonce_str;

    /**
     * 设置商品ID
     * @param $value
     * @return $this
     **/
    public $product_id;


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
    public function getTimeStamp()
    {
        return $this->time_stamp;
    }

    /**
     * @param mixed $time_stamp
     */
    public function setTimeStamp($time_stamp): void
    {
        $this->time_stamp = $time_stamp;
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
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param mixed $product_id
     */
    public function setProductId($product_id): void
    {
        $this->product_id = $product_id;
    }

}