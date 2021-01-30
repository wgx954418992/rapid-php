<?php

namespace apps\app\classier\context;


use apps\core\classier\context\PathContextInterface;
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
     * @var PathContext
     */
    private $pathContext = null;

    /**
     * WebContext constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);

        parent::supportsParameter([
            WebContext::class => $this,
            UserContext::class => [$this, 'getUserContext'],
            PathContextInterface::class => [$this, 'getPathContext'],
        ]);
    }

    /**
     * 获取UserContext
     * @return UserContext
     * @throws Exception
     */
    public function getUserContext()
    {
        if (!is_null($this->userContext)) return $this->userContext;

        return $this->userContext = new UserContext($this);
    }

    /**
     * 获取PathContext
     * @return PathContext
     * @throws Exception
     */
    public function getPathContext()
    {
        if (!is_null($this->pathContext)) return $this->pathContext;

        return $this->pathContext = new PathContext($this);
    }
}