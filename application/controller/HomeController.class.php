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
     * @typed api
     * @header Set-Cookie: token=1
     * @return IndexView
     */
    public function hello(AppUserModel $userModel)
    {
        var_dump(D()->query("show tables")->get()->getValue('Tables_in_fecmall'));

//        D()->close();

        $this->getResponse()->write(json_encode($userModel));

        $this->getResponse()->write("<br><br><br><br><br><br>");

        $userModel->sValue('msg', '你好');

        return new IndexView($this, $userModel);
    }
}