<?php


namespace apps\admin\classier\interceptor;


use apps\admin\classier\context\WebContext;
use apps\admin\classier\service\BaseService;
use Exception;
use rapidPHP\modules\exception\classier\ActionException;
use rapidPHP\modules\reflection\classier\annotation\Value;
use rapidPHP\modules\reflection\classier\Classify;
use rapidPHP\modules\router\classier\Action;
use rapidPHP\modules\router\classier\Interceptor;
use rapidPHP\modules\router\classier\Route;
use rapidPHP\modules\router\classier\Router;

class AuthorityInterceptor extends Interceptor
{

    /**
     * 拦截规则
     * @var string[]
     */
    protected $roles = [
        'account/.*',
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
        try {
            $adminContext = $this->webContext->getAdminContext();

            $adminModel = $adminContext->getCurrentAdmin();

            BaseService::validaAdmin($adminModel);

            $classify = Classify::getInstance($route->getClassName());

            /** @var Value $accessAnnotation */
            $accessAnnotation = $classify->getMethod($route->getMethodName())
                ->getDocComment()
                ->getOneAnnotation('access');

            if (!$accessAnnotation) return;

            foreach ((array)$adminModel->getAccessList() as $access) {
                if ($access->getCode() == $accessAnnotation->getValue()) return;
            }

            throw new Exception('您没有权限访问(C)!');
        } catch (Exception $e) {
            throw ActionException::getInstance($e, $action);
        }
    }
}
