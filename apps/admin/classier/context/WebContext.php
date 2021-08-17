<?php

namespace apps\admin\classier\context;


use apps\admin\classier\interceptor\AuthorityInterceptor;
use apps\file\classier\service\file\LocalFileManagerService;
use apps\file\classier\service\IFileManagerService;
use Exception;
use rapidPHP\modules\application\classier\context\WebContext as BaseWebContext;
use rapidPHP\modules\server\classier\interfaces\Request;
use rapidPHP\modules\server\classier\interfaces\Response;
use function rapidPHP\DI;

class WebContext extends BaseWebContext
{

    /**
     * @var AdminContext
     */
    private $adminContext = null;

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
        ]);

        $this->injection();

        $this->addInterceptor(new AuthorityInterceptor($this));
    }

    /**
     * injection
     */
    private function injection()
    {
        DI([
            IFileManagerService::class => function () {
                return LocalFileManagerService::getInstance();
            },
        ]);
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
}
