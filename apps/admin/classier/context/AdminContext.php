<?php

namespace apps\admin\classier\context;

use apps\admin\classier\options\AdminOptions;
use apps\admin\classier\service\BaseService;
use apps\core\classier\enum\TokenKey;
use apps\admin\classier\wrapper\AdminWrapper;
use Exception;

class AdminContext
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
     * @var AdminWrapper
     */
    private $adminModel;

    /**
     * AdminContext constructor.
     * @param WebContext $context
     */
    public function __construct(WebContext $context)
    {
        $this->context = $context;

        $this->token = $this->context->getRequest()->header(TokenKey::ADMIN);

        if (empty($this->token)) $this->token = $this->context->getRequest()->cookie(TokenKey::ADMIN);

        try {
            $this->adminModel = BaseService::getInstance()
                ->getTokenAdmin($this->token, AdminOptions::i(AdminOptions::OPTIONS_ACCESS_LIST));
        } catch (Exception $e) {
            $this->token = null;
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
     * 获取管理员信息
     * @return AdminWrapper|null
     */
    public function getCurrentAdmin()
    {
        return $this->adminModel;
    }
}
