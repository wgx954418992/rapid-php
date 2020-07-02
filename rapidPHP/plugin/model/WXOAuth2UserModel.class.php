<?php

namespace rapidPHP\plugin\model;


class WXOAuth2UserModel extends BaseOAuth2UserModel
{

    /**
     * 用户特权信息，json 数组，如微信沃卡用户为（chinaunicom）
     * @var array|null
     */
    public $privilege;

    /**
     * 设置privilege
     * @param array $privilege
     * @return self
     */
    public function setPrivilege(?array $privilege): self
    {
        $this->privilege = $privilege;
        return $this;
    }

    /**
     * 获取openId
     * @return array
     */
    public function getPrivilege(): ?array
    {
        return $this->privilege;
    }
}