<?php

namespace apps\app\classier\context;

use apps\core\classier\config\BaseConfig;
use apps\app\classier\service\BaseService;
use apps\core\classier\enum\TokenKey;
use apps\core\classier\options\UserOptions;
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

        $this->token = $this->context->getRequest()->header(TokenKey::USER);

        if (empty($this->token)) $this->token = $this->context->getRequest()->get(TokenKey::USER);

        if (empty($this->token)) $this->token = $this->context->getRequest()->post(TokenKey::USER);

        try {
            $this->userModel = BaseService::getInstance()
                ->getUserByToken(
                    $this->token,
                    UserOptions::i(UserOptions::SPECIFIC_MAJOR | UserOptions::MEMBER)
                );
        } catch (Exception $e) {
            $this->token = null;
        }
    }


    /**
     * 获取token
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * 获取用户信息
     * @return UserWrapper|null
     */
    public function getCurrentUser()
    {
        return $this->userModel;
    }
}
