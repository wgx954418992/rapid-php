<?php

namespace pay\wx\classier\response;

use Exception;
use rapidPHP\modules\reflection\classier\Utils;

/**
 * Class BaseResponse
 * @package pay\wx\classier\response
 */
class BaseResponse
{

    /**
     * 原始data
     * @var array|null
     */
    private $raw;

    /**
     * SUCCESS/FAIL
     * 此字段是通信标识，非交易标识，交易是否成功需要查看result_code来判断
     * @var string|null
     */
    private $return_code;

    /**
     * 当return_code为FAIL时返回信息为错误原因
     * 例如
     *  签名失败
     *  参数格式校验错误
     * @var string|null
     */
    private $return_msg;

    /**
     * 设置微信分配的公众账号ID
     * @var string|null
     */
    private $appid;

    /**
     * 设置微信支付分配的商户号
     * @var string|null
     */
    private $mch_id;

    /**
     * 设置随机字符串
     * @var string|null
     */
    private $nonce_str;

    /**
     * 签名
     * @var string|null
     */
    private $sign;

    /**
     * 业务结果
     * SUCCESS/FAIL
     * @var string|null
     */
    private $result_code;

    /**
     * 当result_code为FAIL时返回错误代码，详细参见下文错误列表
     * @var string|null
     */
    private $err_code;

    /**
     * 当result_code为FAIL时返回错误描述，详细参见下文错误列表
     * @var string|null
     */
    private $err_code_des;

    /**
     * 载入数据
     * @param $data
     * @throws Exception
     */
    public function loadData($data)
    {
        Utils::getInstance()->toObject($this, $data);

        $this->raw = $data;
    }

    /**
     * @return array|null
     */
    public function getRaw(): ?array
    {
        return $this->raw;
    }

    /**
     * @return string|null
     */
    public function getReturnCode(): ?string
    {
        return $this->return_code;
    }

    /**
     * @param string|null $return_code
     */
    public function setReturnCode(?string $return_code): void
    {
        $this->return_code = $return_code;
    }

    /**
     * @return string|null
     */
    public function getReturnMsg(): ?string
    {
        return $this->return_msg;
    }

    /**
     * @param string|null $return_msg
     */
    public function setReturnMsg(?string $return_msg): void
    {
        $this->return_msg = $return_msg;
    }

    /**
     * @return string|null
     */
    public function getAppid(): ?string
    {
        return $this->appid;
    }

    /**
     * @param string|null $appid
     */
    public function setAppid(?string $appid): void
    {
        $this->appid = $appid;
    }

    /**
     * @return string|null
     */
    public function getMchId(): ?string
    {
        return $this->mch_id;
    }

    /**
     * @param string|null $mch_id
     */
    public function setMchId(?string $mch_id): void
    {
        $this->mch_id = $mch_id;
    }

    /**
     * @return string|null
     */
    public function getNonceStr(): ?string
    {
        return $this->nonce_str;
    }

    /**
     * @param string|null $nonce_str
     */
    public function setNonceStr(?string $nonce_str): void
    {
        $this->nonce_str = $nonce_str;
    }

    /**
     * @return string|null
     */
    public function getSign(): ?string
    {
        return $this->sign;
    }

    /**
     * @param string|null $sign
     */
    public function setSign(?string $sign): void
    {
        $this->sign = $sign;
    }

    /**
     * @return string|null
     */
    public function getResultCode(): ?string
    {
        return $this->result_code;
    }

    /**
     * @param string|null $result_code
     */
    public function setResultCode(?string $result_code): void
    {
        $this->result_code = $result_code;
    }

    /**
     * @return string|null
     */
    public function getErrCode(): ?string
    {
        return $this->err_code;
    }

    /**
     * @param string|null $err_code
     */
    public function setErrCode(?string $err_code): void
    {
        $this->err_code = $err_code;
    }

    /**
     * @return string|null
     */
    public function getErrCodeDes(): ?string
    {
        return $this->err_code_des;
    }

    /**
     * @param string|null $err_code_des
     */
    public function setErrCodeDes(?string $err_code_des): void
    {
        $this->err_code_des = $err_code_des;
    }
}