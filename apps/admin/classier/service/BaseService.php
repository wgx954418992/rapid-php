<?php

namespace apps\admin\classier\service;

use apps\core\classier\dao\master\AdminDao;
use apps\core\classier\dao\master\TokenDao;
use apps\core\classier\enum\ErrorCode;
use apps\core\classier\model\AppAdminModel;
use apps\core\classier\service\BaseService as CoreBaseService;
use apps\core\classier\wrapper\AdminWrapper;
use Exception;


class BaseService extends CoreBaseService
{

    /**
     * 效验admin
     * @param AppAdminModel|null $adminModel
     * @throws Exception
     */
    public static function validaAdmin(?AppAdminModel $adminModel)
    {
        if ($adminModel == null)
            throw new Exception('请先登录!', ErrorCode::USER_LOGIN_NOT);
    }

    /**
     * 通过token获取admin信息
     * @param $token
     * @return AppAdminModel
     * @throws Exception
     */
    public function getTokenAdmin($token)
    {
        if (empty($token)) throw new Exception('请先登录!');

        /** @var TokenDao $tokenDao */
        $tokenDao = TokenDao::getInstance();

        if (!$bindId = $tokenDao->getTokenBindId($token))
            throw new Exception('你的帐号已在异地登录,如果不是本人登录，请修改密码后，重新登录!');

        /** @var AdminDao $adminDao */
        $adminDao = AdminDao::getInstance();

        $adminModel = $adminDao->getAdmin($bindId);

        if ($adminModel == null) throw new Exception('帐号不存在!');

        return $adminModel;
    }


    /**
     * 获取管理员
     * @param $adminId
     * @param bool $isCreator
     * @return AdminWrapper
     * @throws Exception
     */
    public function getAdmin($adminId, bool $isCreator = false)
    {
        if (empty($adminId)) throw new Exception('管理员id 错误!');

        /** @var AdminDao $adminDao */
        $adminDao = AdminDao::getInstance();

        $adminWrapper = $adminDao->getAdmin($adminId);

        if ($adminWrapper == null) throw new Exception('管理员不存在!');

        if ($isCreator) {
            $creator = $adminDao->getAdmin($adminWrapper->getParentId());

            $adminWrapper->setCreator($creator);
        }

        return $adminWrapper;
    }
}
