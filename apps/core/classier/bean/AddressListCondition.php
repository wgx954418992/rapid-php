<?php

namespace apps\core\classier\bean;

class AddressListCondition extends PageListCondition
{

    /**
     * bind id
     * @var string|int|null
     */
    private $bind_id;

    /**
     * 地址类型
     * @var int|null
     */
    private $type;

    /**
     * @return int|string|null
     */
    public function getBindId()
    {
        return $this->bind_id;
    }

    /**
     * @param int|string|null $bind_id
     */
    public function setBindId($bind_id): void
    {
        $this->bind_id = $bind_id;
    }

    /**
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int|null $type
     */
    public function setType(?int $type): void
    {
        $this->type = $type;
    }
}