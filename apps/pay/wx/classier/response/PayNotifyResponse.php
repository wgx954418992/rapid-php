<?php

namespace pay\wx\classier\response;

use Exception;
use pay\core\classier\PayNotifyInterface;
use function rapidPHP\AB;
use function rapidPHP\Cal;

class PayNotifyResponse extends BaseResponse implements PayNotifyInterface
{

    /**
     * 订单号
     * @var string|null
     */
    private $payId;

    /**
     * 实际收款金额
     * @var float|null
     */
    private $money;

    /**
     * 收款人id
     * @var string|null
     */
    private $payee;

    /**
     * 支付人id
     * @var string|null
     */
    private $payment;

    /**
     * 返回结果
     * @var string|null
     */
    private $state;

    /**
     * 通知时间
     * @var string|null
     */
    private $time;

    /**
     * 总金额
     * @var float|null
     */
    private $amount;

    /**
     * 载入数据
     * @param array|string|null $data
     * @return bool
     * @throws Exception
     */
    public function loadData($data): bool
    {
        if (!is_array($data)) throw new Exception('data 错误!');

        $AB = AB($data);

        $this->payId = $AB->toValue('out_trade_no');

        if (empty($this->payId)) throw new Exception('out_trade_no 错误!');

        $this->amount = $this->money = $AB->toFloat('total_fee') / 100;

        $this->payee = $AB->toFloat('mch_id') / 100;

        if (empty($this->payee)) throw new Exception('mch_id 错误!');

        $this->payment = $AB->toValue('openid');

        if (empty($this->payment)) throw new Exception('openid 错误!');

        $this->state = $AB->toValue('return_code');

        if (empty($this->state)) throw new Exception('return_code 错误!');

        $payTime = $AB->toValue('time_end');

        if (empty($payTime)) throw new Exception('time_end 错误!');

        $this->time = Cal()->getDate(Cal()->dateToTime($payTime));

        parent::loadData($data);

        return true;
    }

    /**
     * @return string|null
     */
    public function getPayId(): ?string
    {
        return $this->payId;
    }

    /**
     * @return float|null
     */
    public function getMoney(): ?float
    {
        return $this->money;
    }

    /**
     * @return string|null
     */
    public function getPayee(): ?string
    {
        return $this->payee;
    }

    /**
     * @return string|null
     */
    public function getPayment(): ?string
    {
        return $this->payment;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @return string|null
     */
    public function getTime(): ?string
    {
        return $this->time;
    }

    /**
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }
}