<?php
namespace apps\admin\classier\wrapper;

use apps\core\classier\wrapper\UserWrapper as CoreUserWrapper;

class UserWrapper extends CoreUserWrapper
{

    /**
     * 登录次数
     * @var int
     */
    protected $login_count = 0;

    /**
     * @return int
     */
    public function getLoginCount(): int
    {
        return $this->login_count;
    }

    /**
     * @param int $login_count
     */
    public function setLoginCount(int $login_count): void
    {
        $this->login_count = $login_count;
    }
}
