<?php


namespace apps\core\classier\wrapper\user;


use apps\core\classier\model\UserMemberModel;

class MemberWrapper extends UserMemberModel
{

    /**
     * 是否有效
     * @var bool|null
     */
    protected $is_valid;

    /**
     * @return bool|null
     */
    public function getIsValid(): ?bool
    {
        return $this->is_valid;
    }

    /**
     * @param bool|null $is_valid
     */
    public function setIsValid(?bool $is_valid): void
    {
        $this->is_valid = $is_valid;
    }
}
