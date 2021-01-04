<?php


namespace apps\core\classier\bean;


class AdminListCondition extends PageListCondition
{
    /**
     * 管理员类型
     * @var int|null
     */
    public $type;

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