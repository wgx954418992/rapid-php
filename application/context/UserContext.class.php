<?php


namespace application\context;


use application\model\AppUserModel;
use application\service\BaseService;
use application\wrapper\UserWrapper;
use Exception;
use rapidPHP\library\core\app\Context;

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
     * @var AppUserModel
     */
    protected $userModel;

    /**
     * UserContext constructor.
     * @param Context $context
     * @throws Exception
     */
    public function __construct(Context $context)
    {
        $this->context = $context;

        $this->token = $this->context->getRequest()->get('token');

        if (empty($this->token)) $this->token = $this->context->getRequest()->post('token');

        if (empty($this->token)) $this->token = $this->context->getRequest()->cookie('token');

        try {
            $this->userModel = new AppUserModel();
        } catch (Exception $e) {

            $this->token = null;

            $this->context->getResponse()->cookie('token', null);
        }
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
     * @return AppUserModel
     */
    public function getCurrentUser()
    {
        return $this->userModel;
    }
}