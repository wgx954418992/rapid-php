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
     * @var string|null
     */
    private $status;

    /**
     * factory id
     * @var int|null
     */
    private $factoryId;

    /**
     * warehouse id
     * @var int|null
     */
    private $warehouseId;


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
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int|null
     */
    public function getFactoryId(): ?int
    {
        return $this->factoryId;
    }

    /**
     * @param int|null $factoryId
     */
    public function setFactoryId(?int $factoryId): void
    {
        $this->factoryId = $factoryId;
    }

    /**
     * @return int|null
     */
    public function getWarehouseId(): ?int
    {
        return $this->warehouseId;
    }

    /**
     * @param int|null $warehouseId
     */
    public function setWarehouseId(?int $warehouseId): void
    {
        $this->warehouseId = $warehouseId;
    }

}