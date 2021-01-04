<?php

namespace oauth2\wx\model;


use oauth2\core\model\BaseUserModel;

class WXUserModel extends BaseUserModel
{

    /**
     * 用户特权信息，json 数组，如微信沃卡用户为（chinaunicom）
     * @var array|null
     */
    public $privilege;

    /**
     * 设置privilege
     * @param array|null $privilege
     */
    public function setPrivilege(?array $privilege)
    {
        $this->privilege = $privilege;
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