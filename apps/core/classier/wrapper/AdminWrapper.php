<?php


namespace apps\core\classier\wrapper;

use apps\core\classier\config\AdminConfig;
use apps\core\classier\model\AppAdminModel;

class AdminWrapper extends AppAdminModel
{
    /**
     * token
     * @var string|null
     */
    private $token;

    /***
     * @var string|null
     */
    private $type_text;

    /**
     * @var AdminWrapper|null
     */
    private $creator;

    /**
     * 子账号数量
     * @var int|null
     */
    private $child_count;


    /**
     * @param int|null $type
     */
    public function setType(?int $type)
    {
        // TODO: Change the autogenerated stub

        $this->type_text = AdminConfig::getTypeText($type);

        parent::setType($type);
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     */
    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return string|null
     */
    public function getTypeText(): ?string
    {
        return $this->type_text;
    }

    /**
     * @param AdminWrapper|null $creator
     */
    public function setCreator(?AdminWrapper $creator): void
    {
        $this->creator = $creator;
    }

    /**
     * @return AdminWrapper|null
     */
    public function getCreator(): ?AdminWrapper
    {
        return $this->creator;
    }

    /**
     * @return int|null
     */
    public function getChildCount(): ?int
    {
        return $this->child_count;
    }

    /**
     * @param int|null $child_count
     */
    public function setChildCount(?int $child_count): void
    {
        $this->child_count = $child_count;
    }

}