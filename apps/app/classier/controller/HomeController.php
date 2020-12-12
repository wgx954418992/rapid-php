<?php

namespace apps\app\classier\controller;

use apps\app\classier\dao\master\UserDao;
use Exception;
use rapidPHP\modules\server\classier\interfaces\Request;

/**
 * Class HomeController
 * @route /
 * @package apps\app\classier\controller
 */
class HomeController extends BaseController
{

    /**
     * 首页
     * @route (|/|index)
     * @method get
     * @typed view
     * @header Cookie:a=1
     * @header Auth:a=1
     * @template index
     * @param mixed $get get aa
     * @return string[]
     * @throws Exception
     */
    public function index($get)
    {
        try {
            $user = UserDao::getInstance()->getUserByTel('18157309904');
        } catch (Exception $e) {
            $this->getResponse()->write($e->getMessage());
        }
        return ['user' => $user ?? null, 'msg' => $get ? '您传入了get参数' . $get : '您没有传入get 参数'];
    }

    /**
     * pathVariable
     * @route /path/{agreement}
     * @method get
     * @param int $agreement
     * @param Request $request
     */
    public function pathVariable(int $agreement, Request $request)
    {
        var_dump($agreement);
    }

}