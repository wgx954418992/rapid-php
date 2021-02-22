<?php

namespace pay\core\classier;

interface PayNotifyInterface
{

    /**
     * 载入数据
     * @param string|array|null $data
     * @return bool
     */
    public function loadData($data): bool;

    /**
     * 订单号
     * @return string|null
     */
    public function getPayId(): ?string;

    /**
     * 实际收款金额
     * @return float|null
     */
    public function getMoney(): ?float;

    /**
     * 收款人id
     * @return string|null
     */
    public function getPayee(): ?string;

    /**
     * 支付人id
     * @return string|null
     */
    public function getPayment(): ?string;

    /**
     * 返回结果
     * @return string|null
     */
    public function getState(): ?string;

    /**
     * 通知时间
     * @return string|null
     */
    public function getTime(): ?string;

    /**
     * 总金额
     * @return float|null
     */
    public function getAmount(): ?float;
}