<?php

namespace apps\admin\classier\service;

use apps\core\classier\config\AdminConfig;
use apps\core\classier\config\BaseConfig;
use apps\core\classier\dao\master\AdminDao;
use apps\core\classier\service\UserService as CoreUserService;
use Exception;
use rapidPHP\modules\common\classier\Instances;


class UserService
{

    /**
     * 单例模式
     */
    use Instances;

    /**
     * 初始化当前
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * 管理员登录
     * @param $username
     * @param $password
     * @param $ip
     * @param $userAgent
     * @return string
     * @throws Exception
     */
    public function loginByAdmin($username, $password, $ip, $userAgent): string
    {
        if (empty($username) || empty($password)) throw new Exception('帐号密码不能为空!');

        /** @var AdminDao $adminDao */
        $adminDao = AdminDao::getInstance();

        $adminWrapper = $adminDao->getUPAdmin($username, $password, AdminConfig::TYPE_ADMIN);

        if ($adminWrapper == null) throw new Exception('帐号不存在或者密码错误!');

        return CoreUserService::getInstance()
            ->login($adminWrapper->getId(), BaseConfig::LOGIN_MODE_ACCOUNT, $ip, $userAgent);
    }


}