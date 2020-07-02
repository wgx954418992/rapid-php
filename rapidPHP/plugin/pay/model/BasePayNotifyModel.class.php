<?php

namespace rapidPHP\plugin\pay\model;

use rapidPHP\library\AB;

class BasePayNotifyModel extends AB
{

    /**
     * 订单号
     * @var string|null
     */
    public $payId;

    /**
     * 实际收款金额
     * @var float|null
     */
    public $money;

    /**
     * 收款人id
     * @var string|null
     */
    public $payee;

    /**
     * 支付人id
     * @var string|null
     */
    public $payment;

    /**
     * 返回结果
     * @var string|null
     */
    public $state;

    /**
     * 通知时间
     * @var string|null
     */
    public $time;

    /**
     * 总金额
     * @var float|null
     */
    public $amount;

    /**
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float|null $amount
     */
    public function setAmount(?float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return string|null
     */
    public function getPayId(): ?string
    {
        return $this->payId;
    }

    /**
     * @param string|null $payId
     */
    public function setPayId(?string $payId): void
    {
        $this->payId = $payId;
    }

    /**
     * @return float|null
     */
    public function getMoney(): ?float
    {
        return $this->money;
    }

    /**
     * @param float|null $money
     */
    public function setMoney(?float $money): void
    {
        $this->money = $money;
    }

    /**
     * @return string|null
     */
    public function getPayee(): ?string
    {
        return $this->payee;
    }

    /**
     * @param string|null $payee
     */
    public function setPayee(?string $payee): void
    {
        $this->payee = $payee;
    }

    /**
     * @return string|null
     */
    public function getPayment(): ?string
    {
        return $this->payment;
    }

    /**
     * @param string|null $payment
     */
    public function setPayment(?string $payment): void
    {
        $this->payment = $payment;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string|null $state
     */
    public function setState(?string $state): void
    {
        $this->state = $state;
    }

    /**
     * @return string|null
     */
    public function getTime(): ?string
    {
        return $this->time;
    }

    /**
     * @param string|null $time
     */
    public function setTime(?string $time): void
    {
        $this->time = $time;
    }
}