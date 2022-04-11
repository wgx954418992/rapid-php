<?php

namespace apps\admin\classier\service;

use apps\admin\classier\dao\master\AdminDao;
use apps\admin\classier\enum\admin\Type;
use apps\core\classier\enum\LoginType;
use apps\core\classier\service\LoginService as CoreLoginService;
use Exception;
use rapidPHP\modules\common\classier\Instances;


class PswordLoginService
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

        $adminModel = $adminDao->getAdminByUP($username, $password, Type::WEB);

        if ($adminModel == null) throw new Exception('帐号不存在或者密码错误!');

        return CoreLoginService::getInstance()
            ->login($adminModel->getId(),
                LoginType::i(LoginType::ADMIN_ACCOUNT),
                $ip,
                $userAgent
            );
    }


}
