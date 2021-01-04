<?php

namespace apps\core\classier\bean;

class UserListCondition extends PageListCondition
{

    /**
     * 用户id
     * @var string|int|null
     */
    public $user_id;

    /**
     * 用户类型
     * @var int|null
     */
    public $type;

    /**
     * 用户来源
     * @var int|null
     */
    public $source = null;

    /**
     * @return int|string|null
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param int|string|null $user_id
     */
    public function setUserId($user_id): void
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
     * @return int|null
     */
    public function getSource(): ?int
    {
        return $this->source;
    }

    /**
     * @param int|null $source
     */
    public function setSource(?int $source): void
    {
        $this->source = $source;
    }
}