<?php


namespace apps\app\classier\interceptor;


use apps\app\classier\context\WebContext;
use apps\core\classier\enum\CodeType;
use apps\core\classier\wrapper\UserWrapper;
use Exception;
use rapidPHP\modules\router\classier\Action;
use rapidPHP\modules\router\classier\Interceptor;
use rapidPHP\modules\router\classier\Route;
use rapidPHP\modules\router\classier\Router;

class CodeEmailInterceptor extends Interceptor
{

    /**
     * 拦截规则
     * @var string[]
     */
    protected $roles = [
        'code/send/email',
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
        $currentUser = $this->webContext->getUserContext()->getCurrentUser();

        $receiver = $this->webContext->getRequest()->request('receiver');

        $codeType = $this->webContext->getRequest()->request('type');

        $this->onInvokeBefore($currentUser, $receiver, CodeType::i($codeType));
    }

    /**
     * @param UserWrapper|null $currentUser
     * @param $receiver
     * @param CodeType $codeType
     * @throws Exception
     */
    public function onInvokeBefore(?UserWrapper $currentUser, $receiver, CodeType $codeType)
    {
        if (empty($receiver)) throw new Exception('邮箱错误!');

        $codeType
            ->then(CodeType::LOGIN, function () {

            })
            ->then(CodeType::CHANGE_VERIFY, function () {

            })
            ->then(CodeType::CHANGE_TELEPHONE, function () {

            })
            ->fetch();
    }
}
