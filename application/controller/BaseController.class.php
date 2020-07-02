<?php

namespace application\controller;

use application\model\AppUserModel;
use application\server\RunSHttpServer;
use application\service\UserService;
use Exception;
use rapidPHP\library\core\app\Controller;
use rapidPHP\library\core\app\View;
use rapidPHP\library\RESTFullApi;
use ReflectionException;
use Swoole\Server;

/**
 * Class BaseController
 * @package application\controller
 */
class BaseController extends Controller
{

    /**
     * @url /
     * @throws Exception
     */
    public function root()
    {
        if(defined('SWOOLE_HTTP_SERVER')){
            RunSHttpServer::getInstance()->addTask(json_encode(['type' => 'sendEmail', 'data' => 1]));
        }

        $this->getResponse()->write('root----');

        View::display($this, 'index');
    }

    /**
     * @url /index
     * @throws ReflectionException
     */
    public function index()
    {
        $this->getResponse()->write('index----');

        //如果不想返回可以直接显示
        //View::display('index')->assign('var', 'value')->view();

        return View::display($this, 'index')->assign('var', 'value');
    }

    /**
     * @url /home(|/index)
     * @see HomeController.hello method
     */
    public function home()
    {
        $this->getResponse()->write('Hello Home Page----');
    }

    /**
     * @url /user/add.html
     * @method get
     * @param AppUserModel $model
     * @return RESTFullApi
     * @throws ReflectionException
     */
    public function addUser($model)
    {
        $this->getResponse()->write('addUser----');

        $this->getResponse()->write(json_encode($model));

        /** @var UserService $userService */
        $userService = M(UserService::class);

        return RESTFullApi::success($userService->addUser($model), '添加成功');
    }

    /**
     * @url /user/info
     * @param int $userId post
     */
    public function getUserInfo($userId)
    {
        $this->getResponse()->write('getUserInfoPost----');

        $this->getResponse()->write($userId);
    }

    /**
     * @url /user/info
     * @param int $userId
     * @method post
     */
    public function getUserInfoPostMethod(int $userId)
    {
        $this->getResponse()->write('getUserInfoPostMethod----');

        $this->getResponse()->write($userId);
    }

    /**
     * @url /user/{$userId}/
     * @param int $userId
     */
    public function getUserInfoPath($userId = 1)
    {
        $this->getResponse()->write('getUserInfoPath----');

        $this->getResponse()->write($userId);
    }

    /**
     * @url /user/{$userId}/cookie
     * @param string $userId cookies
     */
    public function getUserInfoCookie($userId)
    {
        $this->getResponse()->write('getUserInfo----');

        $this->getResponse()->write($userId);
    }

    /**
     * @url /upload
     * @param $file :file
     */
    public function uploadFile($file)
    {
        $this->getResponse()->write('uploadFile----');

        $this->getResponse()->write(json_encode($file));
    }
}