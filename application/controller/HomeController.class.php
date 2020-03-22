<?php

namespace application\controller;

use application\model\AppUserModel;
use application\view\IndexView;

/**
 * Class HomeController
 * @url /home
 * @package application\controller
 */
class HomeController extends BaseController
{

    /**
     * @url /
     * @param AppUserModel $userModel
     * @return IndexView
     */
    public function hello(AppUserModel $userModel)
    {
        var_dump($userModel);

        echo "<br><br><br><br><br><br>";

        $userModel->setValue('msg', '你好');

        return new IndexView($userModel);
    }
}