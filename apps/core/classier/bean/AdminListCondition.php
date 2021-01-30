<?php


namespace apps\core\classier\bean;


class AdminListCondition extends PageListCondition
{
    /**
     * @var string|int|null
     */
    private $adminId;

    /**
     * 管理员类型
     * @var int|null
     */
    private $type;

    /**
     * @return int|string|null
     */
    public function getAdminId()
    {
        return $this->adminId;
    }

    /**
     * @param int|string|null $adminId
     */
    public function setAdminId($adminId): void
    {
        $this->adminId = $adminId;
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