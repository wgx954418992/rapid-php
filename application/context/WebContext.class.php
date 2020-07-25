<?php

namespace application\context;


use application\controller\exception\ExceptionController;
use Exception;
use rapidPHP\library\core\app\Context;
use rapidPHP\library\core\server\Request;
use rapidPHP\library\core\server\Response;
use ReflectionException;

class WebContext extends Context
{
    /**
     * @var UserContext
     */
    private $userContext = null;

    public function __construct(Request $request, Response $response, ...$options)
    {
        parent::__construct($request, $response, $options);

        $this->setExController(new ExceptionController($request, $response));
    }

    /**
     * 获取定义的参数
     * @param mixed ...$merge
     * @return array
     */
    public function supportsParameter(...$merge)
    {
        return parent::supportsParameter($merge, [
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