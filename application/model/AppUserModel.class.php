<?php

namespace application\model;

use rapidPHP\library\AB;

/**
 * 用户表
 * @table app_user
 */
class AppUserModel extends AB
{


    /**
     * id
     * @length 0
     * @typed bigint
     */
    public $id;

    /**
     * 用户名
     * @length 10
     * @typed varchar
     */
    public $nickname;

    /**
     * 密码
     * @length 32
     * @typed varchar
     */
    public $psword;

    /**
     * 获取 id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 设置 id
     * @param $id
     * @return AppUserModel
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * 获取 用户名
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * 设置 用户名
     * @param $nickname
     * @return AppUserModel
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * 获取 密码
     * @return mixed
     */
    public function getPsword()
    {
        return $this->psword;
    }

    /**
     * 设置 密码
     * @param $psword
     * @return AppUserModel
     */
    public function setPsword($psword)
    {
        $this->psword = $psword;
        return $this;
    }
}