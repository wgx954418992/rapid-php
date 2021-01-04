<?php


namespace apps\core\classier\bean;

class OrderListCondition extends PageListCondition
{

    /**
     * @var int|null
     */
    private $user_id;

    /**
     * 订单状态
     * @var int|null
     */
    private $status;

    /**
     * 获取 排序名称
     * @return string
     */
    public function getOrderName(): string
    {
        return 'created_time';
    }

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
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     */
    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }

}