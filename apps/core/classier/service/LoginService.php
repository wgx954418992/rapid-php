<?php

namespace apps\core\classier\service;

use apps\core\classier\dao\master\TokenDao;
use apps\core\classier\dao\master\user\LogDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\LoginType;
use apps\core\classier\model\UserLogModel;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use ReflectionException;
use function rapidPHP\B;

class LoginService
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
     * @param LoginType $type
     * @param $ip
     * @param $userAgent
     * @return string
     * @throws Exception
     */
    public function login($userId, LoginType $type, $ip, $userAgent): string
    {
        if (empty($userId)) throw new Exception('user id error!');

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

            $userLogModel->setType($type->getRawValue());

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

    /**
     * 获取登录记录
     * @param $bindId
     * @return array
     * @throws ReflectionException
     * @throws Exception
     */
    public function getLogList($bindId)
    {
        if (empty($bindId)) throw new Exception('bindId 错误!');

        /** @var LogDao $logDao */
        $logDao = LogDao::getInstance();

        return $logDao->getLogList($bindId);
    }

    /**
     * 获取登录次数
     * @param $bindId
     * @return int
     * @throws ReflectionException
     * @throws Exception
     */
    public function getLoginCount($bindId): int
    {
        if (empty($bindId)) throw new Exception('bindId 错误!');

        /** @var LogDao $logDao */
        $logDao = LogDao::getInstance();

        return $logDao->getLoginCount($bindId);
    }

}
