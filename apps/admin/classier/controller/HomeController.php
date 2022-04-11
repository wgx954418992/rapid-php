<?php

namespace apps\admin\classier\controller;


use apps\core\classier\enum\TokenKey;

class HomeController extends BaseController
{

    /**
     * 后台主页
     * @route (/|index)
     * @param bool|null $exit get
     */
    public function index(?bool $exit = null)
    {
        if ($exit) $this->getResponse()->cookie(TokenKey::ADMIN, null);

        parent::location('login');
    }
}
