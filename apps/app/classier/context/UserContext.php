<?php

namespace apps\app\classier\context;

use apps\core\classier\config\BaseConfig;
use apps\core\classier\service\BaseService;
use apps\core\classier\wrapper\UserWrapper;
use Exception;

class UserContext
{

    /**
     * @var string
     */
    private $token;

    /**
     * @var WebContext
     */
    private $context;

    /**
     * @var UserWrapper
     */
    protected $userModel;

    /**
     * UserContext constructor.
     * @param WebContext $context
     */
    public function __construct(WebContext $context)
    {
        $this->context = $context;

        $this->token = $this->context->getRequest()->cookie(BaseConfig::TOKEN_NAME_USER);

        try {
            $this->userModel = BaseService::getInstance()->getUserByToken($this->token, $context->getRequest()->getHostUrl());
        } catch (Exception $e) {
            $this->token = null;

            $this->context->getResponse()->cookie(BaseConfig::TOKEN_NAME_USER, null);
        }
    }


    /**
     * 获取token
     * @return mixed
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * 获取用户信息
     * @return UserWrapper|null
     */
    public function getCurrentUser(): ?UserWrapper
    {
        return $this->userModel;
    }
}