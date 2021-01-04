<?php

namespace apps\app\classier\service\account;

use apps\app\classier\service\BaseService;
use apps\core\classier\wrapper\UserWrapper;
use Exception;

class ValidaAccountService
{
    /**
     * @var UserWrapper
     */
    protected $userModel;

    /**
     * 效验用户登录状态
     * @param UserWrapper|null $userModel
     * @throws Exception
     */
    public function __construct(?UserWrapper $userModel)
    {
        BaseService::validaUserModel($userModel);

        $this->userModel = $userModel;
    }

    /**
     * 获取用户信息
     * @return UserWrapper
     */
    public function getCurrentUser(): UserWrapper
    {
        return $this->userModel;
    }

    /**
     * 获取用户id
     * @return int
     */
    public function getUserId(): int
    {
        return $this->getCurrentUser()->getId();
    }
}