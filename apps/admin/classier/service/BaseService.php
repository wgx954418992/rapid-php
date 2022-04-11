<?php

namespace apps\admin\classier\service;

use apps\admin\classier\dao\master\AdminDao;
use apps\admin\classier\options\AdminOptions;
use apps\core\classier\dao\master\TokenDao;
use apps\core\classier\enum\ErrorCode;
use apps\core\classier\model\AppAdminModel;
use apps\core\classier\service\BaseService as CoreBaseService;
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
        if ($adminModel == null) throw new Exception('请先登录!', ErrorCode::USER_LOGIN_NOT);
    }

    /**
     * 通过token获取admin信息
     * @param $token
     * @param AdminOptions|null $options
     * @return AppAdminModel
     * @throws Exception
     */
    public function getTokenAdmin($token, ?AdminOptions $options = null)
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

        AdminService::getInstance()->setAdminOptions($adminModel, $options);

        return $adminModel;
    }
}
