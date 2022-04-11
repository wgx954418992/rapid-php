<?php

namespace apps\core\classier\bean;

use function rapidPHP\B;

class CollectionListCondition extends BaseListCondition
{

    use PageListCondition;

    /**
     * @var int|null
     */
    private $type;

    /**
     * @var int|null
     */
    private $user_id;

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

    /**
     * @return string
     */
    public function getOrderName(): string
    {
        return B()->contrast($this->order_name, 'add_time');
    }
}
