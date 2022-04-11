<?php


namespace apps\admin\classier\wrapper;

use apps\admin\classier\wrapper\admin\AccessWrapper;
use apps\core\classier\model\AppAdminModel;

class AdminWrapper extends AppAdminModel
{


    /**
     * 头像
     * @var string
     */
    protected $avatar;

    /**
     * 创建者
     * @var AdminWrapper|null
     */
    protected $creator;

    /**
     * 子账号数量
     * @var int|null
     */
    protected $child_count;

    /**
     * @var AccessWrapper[]|null
     */
    protected $access_list;

    /**
     * display name
     * @return string|null
     */
    public function getDisplayName()
    {
        if ($this->nickname) {
            return $this->nickname;
        }

        return $this->username;
    }

    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     */
    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
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

    /**
     * @return AccessWrapper[]|null
     */
    public function getAccessList(): ?array
    {
        return $this->access_list;
    }

    /**
     * @param AccessWrapper[]|null $access_list
     */
    public function setAccessList(?array $access_list): void
    {
        $this->access_list = $access_list;
    }
}
