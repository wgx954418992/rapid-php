<?php


namespace apps\app\classier\context;


use Exception;

class UserContext
{

    /**
     * @var string
     */
    private $token;

    /**
     * @var Context
     */
    private $context;

    /**
     * @var UserWrapper
     */
    protected $userModel;

    /**
     * UserContext constructor.
     * @param WebContext $context
     * @throws Exception
     */
    public function __construct(WebContext $context)
    {
        $this->context = $context;

        $this->token = $this->context->getRequest()->cookie('token');
    }


    /**
     * 获取token
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * 获取用户信息
     * @return UserWrapper
     */
    public function getCurrentUser()
    {
        return $this->userModel;
    }
}