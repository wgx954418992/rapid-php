<?php


namespace apps\file\classier\interceptor;


use apps\core\classier\enum\TokenKey;
use apps\file\classier\context\UserContext;
use apps\file\classier\context\WebContext;
use Exception;
use rapidPHP\modules\router\classier\Action;
use rapidPHP\modules\router\classier\Interceptor;
use rapidPHP\modules\router\classier\Route;
use rapidPHP\modules\router\classier\Router;

class AppUploadInterceptor extends Interceptor
{

    /**
     * 拦截规则
     * @var string[]
     */
    protected $roles = [
//        'app/file/upload',
    ];

    /**
     * 排除规则
     * @var string[]
     */
    protected $excludes = [];

    /**
     * @var WebContext
     */
    private $webContext;

    /**
     * AuthorityInterceptor constructor.
     * @param WebContext $webContext
     */
    public function __construct(WebContext $webContext)
    {
        $this->webContext = $webContext;
    }

    /**
     * 处理拦截
     * @param Router $router
     * @param Action $action
     * @param Route $route
     * @param $pathVariable
     * @param $realPath
     * @param $role
     * @throws Exception
     */
    public function onHandler(Router $router, Action $action, Route $route, &$pathVariable, &$realPath, &$role)
    {
        $request = $this->webContext->getRequest();

        $token = $request->request(TokenKey::USER);

        if (!$token) throw new Exception('Authority fail! ', 403);

        $this->webContext->supportsParameter([UserContext::class => new UserContext($user->getId())]);
    }
}
