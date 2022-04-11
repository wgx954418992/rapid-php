<?php

namespace apps\app\classier\service;

use apps\core\classier\dao\master\UserDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\LoginType;
use apps\core\classier\enum\setting\attribute\point\IntegralRule;
use apps\core\classier\helper\CommonHelper;
use apps\core\classier\model\AppUserModel;
use apps\core\classier\service\BaseService;
use apps\core\classier\service\IntegralService;
use apps\core\classier\service\LoginService as CoreLoginService;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use ReflectionException;
use function rapidPHP\B;
use function rapidPHP\Cal;
use function rapidPHP\Str;

class PhoneLoginService
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
     * 手机号码登录
     * @param $telephone
     * @param LoginType $type
     * @param $ip
     * @param $userAgent
     * @param null $recommendUid
     * @return string
     * @throws ReflectionException
     * @throws Exception
     */
    public function loginByPhone($telephone, LoginType $type, $ip, $userAgent, $recommendUid = null): string
    {
        if (empty($telephone)) throw new Exception('手机号码不能为空!');

        $telephone = CommonHelper::validTelephone($telephone);

        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        $userModel = $userDao->getUserByTel($telephone);

        $recommendUserModel = $recommendUid ? $userDao->getUser($recommendUid) : null;

        MasterDao::getSQLDB()->beginTransaction();

        try {

            if ($userModel === null) {

                $userModel = new AppUserModel();

                $userModel->setId(B()->onlyIdToInt());

                $userModel->setRegisterIp($ip);

                $userModel->setUsername(B()->randoms(10));

                $userModel->setTelephone($telephone);

                $userModel->setBirthday(Cal()->getDate());

                if ($recommendUserModel){
                    $userModel->setRecommendUid($recommendUserModel->getId());
                }

                $userDao->addUser($userModel);

                IntegralService::setPointByIU($userModel->getId(), IntegralRule::i(IntegralRule::REGISTER));

                try {
                    if ($recommendUserModel) {

                        $integralRule = IntegralRule::i(IntegralRule::INVITE_REGISTER);

                        $integralRule->setText('邀请用户' . Str()->hideTel($userModel->getTelephone()));

                        IntegralService::setPointByIU($recommendUserModel->getId(), $integralRule);
                    }
                } catch (Exception $e) {
                    BaseService::getInstance()->addLog('code login recommend', $e);
                }
            }

            $token = CoreLoginService::getInstance()
                ->login($userModel->getId(), $type, $ip, $userAgent);

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('登录失败');

            return $token;
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }
}
