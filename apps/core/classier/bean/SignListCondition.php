<?php

namespace apps\core\classier\bean;

use function rapidPHP\B;

class SignListCondition extends BaseListCondition
{

    /**
     * 用户id
     * @var int|null
     */
    protected $user_id;

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @param int|null $user_id
     */
    public function setUserId(?int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getOrderName(): string
    {
        return B()->contrast($this->order_name, 'ymd');
    }

    /**
     * @return string
     */
    public function getOrderType(): string
    {
        $orderType = strtoupper($this->order_type);

        if (empty($orderType)) $orderType = 'ASC';

        if ($orderType != 'DESC' && $orderType != 'ASC') return 'ASC';

        return $orderType;
    }
}
