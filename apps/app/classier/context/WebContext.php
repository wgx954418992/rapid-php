<?php

namespace apps\app\classier\context;


use Exception;
use rapidPHP\modules\application\classier\context\WebContext as BaseWebContext;
use rapidPHP\modules\server\classier\interfaces\Request;
use rapidPHP\modules\server\classier\interfaces\Response;

class WebContext extends BaseWebContext
{
    /**
     * @var UserContext
     */
    private $userContext = null;

    /**
     * WebContext constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);

        parent::supportsParameter([
            UserContext::class => [$this, 'getUserContext'],
        ]);
    }

    /**
     * 获取用户context
     * @return UserContext|null
     * @throws Exception
     */
    public function getUserContext()
    {
        if (!is_null($this->userContext)) return $this->userContext;

        return $this->userContext = new UserContext($this);
    }
}