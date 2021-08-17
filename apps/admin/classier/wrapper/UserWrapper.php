<?php
namespace apps\admin\classier\wrapper;


use apps\core\classier\wrapper\UserWrapper as CoreUserWrapper;

class UserWrapper extends CoreUserWrapper
{

    /**
     * 登录次数
     * @var int
     */
    public $login_count = 0;

    /**
     * 书信数量
     * @var int
     */
    public $letter_count = 0;

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

    /**
     * @return int
     */
    public function getLetterCount(): int
    {
        return $this->letter_count;
    }

    /**
     * @param int $letter_count
     */
    public function setLetterCount(int $letter_count): void
    {
        $this->letter_count = $letter_count;
    }
}
