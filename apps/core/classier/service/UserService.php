<?php

namespace apps\core\classier\service;

use apps\core\classier\dao\master\TokenDao;
use apps\core\classier\dao\master\user\LogDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\UserLogModel;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use function rapidPHP\B;

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
     * 登录
     * @param $userId
     * @param $type
     * @param $ip
     * @param $userAgent
     * @return string
     * @throws Exception
     */
    public function login($userId, $type, $ip, $userAgent): string
    {
        if (empty($userId)) throw new Exception('user id error!');

        if (empty($type)) throw new Exception('type id error!');

        $token = B()->onlyId();

        $isThing = MasterDao::getSQLDB()->isInThing();

        if (!$isThing) MasterDao::getSQLDB()->beginTransaction();

        try {
            $tokenDao = TokenDao::getInstance();

            $tokenDao->delToken($userId, $type);

            $tokenDao->addToken($token, $userId, $type);

            $logDao = LogDao::getInstance();

            $userLogModel = new UserLogModel();

            $userLogModel->setToken($token);

            $userLogModel->setMode($type);

            $userLogModel->setBindId($userId);

            $userLogModel->setIp($ip);

            $userLogModel->setDevice($userAgent);

            $logDao->addLoginLog($userLogModel);

            if (!$isThing && !MasterDao::getSQLDB()->commit()) throw new Exception('登录失败!');

            return $token;
        } catch (Exception $e) {
            if (!$isThing) MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }
}