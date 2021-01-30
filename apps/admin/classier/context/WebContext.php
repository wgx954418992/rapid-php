<?php

namespace apps\admin\classier\context;


use apps\admin\classier\interceptor\AuthorityInterceptor;
use apps\core\classier\context\PathContextInterface;
use Exception;
use rapidPHP\modules\application\classier\context\WebContext as BaseWebContext;
use rapidPHP\modules\server\classier\interfaces\Request;
use rapidPHP\modules\server\classier\interfaces\Response;

class WebContext extends BaseWebContext
{

    /**
     * @var AdminContext
     */
    private $adminContext = null;

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
            AdminContext::class => [$this, 'getAdminContext'],
            PathContextInterface::class => [$this, 'getPathContext'],
        ]);

        $this->addInterceptor(new AuthorityInterceptor($this));
    }

    /**
     * 获取AdminContext
     * @return AdminContext
     * @throws Exception
     */
    public function getAdminContext()
    {
        if (!is_null($this->adminContext)) return $this->adminContext;

        return $this->adminContext = new AdminContext($this);
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