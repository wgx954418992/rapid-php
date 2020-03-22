<?php

namespace application\controller;

use application\model\AppUserModel;
use application\service\UserService;
use rapidPHP\library\core\app\View;
use rapidPHP\library\RESTFullApi;
use ReflectionException;

/**
 * Class BaseController
 * @package application\controller
 */
class BaseController
{

    /**
     * @url /
     */
    public function root()
    {
        echo 'root----';

        View::show('index');
    }

    /**
     * @url /index
     */
    public function index()
    {
        echo 'index----';

        //如果不想返回可以直接显示
        //View::display('index')->assign('var', 'value')->view();

        return View::display('index')->assign('var', 'value');
    }

    /**
     * @url /home(|/index)
     * @see HomeController.hello method
     */
    public function home()
    {
        echo 'Hello Home Page';
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
        echo 'addUser----';

        var_dump($model);

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
        echo 'getUserInfoPost----';

        var_dump($userId);
    }

    /**
     * @url /user/info
     * @param int $userId
     * @method post
     */
    public function getUserInfoPostMethod(int $userId)
    {
        echo 'getUserInfoPostMethod----';

        var_dump($userId);
    }

    /**
     * @url /user/{$userId}/
     * @param int $userId
     */
    public function getUserInfoPath($userId = 1)
    {
        echo 'getUserInfoPath----';

        var_dump($userId);
    }

    /**
     * @url /user/{$userId}/cookie
     * @param string $userId cookies
     */
    public function getUserInfoCookie($userId)
    {
        echo 'getUserInfo----';

        echo $userId;
    }

    /**
     * @url /upload
     * @param $file :file
     */
    public function uploadFile($file)
    {
        var_dump($file);
    }
}