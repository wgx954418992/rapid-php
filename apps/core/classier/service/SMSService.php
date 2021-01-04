<?php


namespace apps\core\classier\service;

use apps\core\classier\config\SMSConfig;
use apps\core\classier\dao\master\CodeDao;
use apps\core\classier\service\sms\ALSMSService;
use apps\core\classier\service\sms\SMSInterface;
use apps\core\classier\service\sms\TCSMSService;
use apps\core\classier\service\sms\ValidaInterface;
use apps\core\classier\wrapper\UserWrapper;
use Exception;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumber;
use libphonenumber\PhoneNumberUtil;
use rapidPHP\modules\reflection\classier\Classify;
use function rapidPHP\B;

class SMSService
{

    /**
     * 当前实例，不同sendSMSService的配置
     * @var SMSService
     */
    private static $instances = [];

    /**
     * @var SMSInterface
     */
    private $sendSMSService = null;

    /**
     * 发送短信验证码，效验能否发送的方法
     * @var ValidaInterface[]
     */
    private $validaService = [

    ];

    /**
     * SMSService constructor.
     * @param string|SMSInterface|ALSMSService|TCSMSService $sendSMSService
     * @throws Exception
     */
    public function __construct($sendSMSService)
    {
        if (empty($sendSMSService)) throw new Exception('sms service error!');

        $this->sendSMSService = Classify::getInstance($sendSMSService)
            ->newInstance();

        foreach ($this->validaService as $type => $class) {
            $this->validaService[$type] = Classify::getInstance($class)
                ->newInstance();
        }
    }

    /**
     * 单例模式
     * @param string $sendSMSService
     * @return self
     * @throws Exception
     */
    public static function getInstance($sendSMSService = ALSMSService::class)
    {
        if (isset(self::$instances[$sendSMSService]) && self::$instances[$sendSMSService] instanceof self) {
            return self::$instances[$sendSMSService];
        }

        return self::$instances[$sendSMSService] = new self($sendSMSService);
    }

    /**
     * 效验手机号码
     * @param $telephone
     * @param bool $isReset 是否重置手机号码，会自动加上区号
     * @param string $defaultRegion
     * @return PhoneNumber
     * @throws NumberParseException
     * @throws Exception
     */
    public static function validTelephone(&$telephone, $isReset = false, $defaultRegion = 'CN'): PhoneNumber
    {
        if (empty($telephone)) throw new Exception('手机号码不能为空!');

        $phoneUtil = PhoneNumberUtil::getInstance();

        $phoneNumber = $phoneUtil->parse($telephone, $defaultRegion);

        $isValid = $phoneUtil->isValidNumber($phoneNumber);

        if (!$isValid) throw new Exception('手机号码无效！');

        if ($isReset) {
            $telephone = $phoneNumber->getCountryCode() . $phoneNumber->getNationalNumber();
        }

        return $phoneNumber;
    }

    /**
     * 执行验证手机号码
     * @param UserWrapper|null $userModel
     * @param $templateId
     * @param $telephone
     * @return bool|mixed
     */
    private function toValidaTel(?UserWrapper $userModel, $templateId, $telephone): bool
    {
        if (!isset($this->validaService[$templateId])) return true;

        $service = $this->validaService[$templateId];

        if ($service instanceof ValidaInterface) {
            if (is_array($telephone)) {
                return $service->valida($userModel, B()->getData($telephone, 0), $telephone);
            } else {
                return $service->valida($userModel, $telephone, [$telephone]);
            }
        }

        return true;
    }


    /**
     * 通过模板id获取模板code
     * @param $templateId
     * @param $countryCode
     * @return bool|mixed|string
     * @throws Exception
     */
    public function getTemplateCodeByType($templateId, $countryCode)
    {
        $config = $this->sendSMSService->getConfig();

        if (!$templateCode = $config->getTemplateCodeByType($templateId, $countryCode))
            throw new Exception('模板错误!');

        return $templateCode;
    }

    /**
     * 发送短信
     * @param $templateCode
     * @param $telephone
     * @param $param
     * @return true
     * @throws Exception
     */
    public function send($templateCode, $telephone, $param = null): bool
    {
        if (empty($templateCode)) throw new Exception('模版错误!');

        if (empty($telephone)) throw new Exception('手机号码错误!');

        $result = $this->sendSMSService->send($templateCode, $telephone, $param);

        if (!$result) throw new Exception('发送失败!');

        return true;
    }

    /**
     * 发送验证码
     * @param UserWrapper|null $userModel
     * @param $telephone
     * @param $templateId
     * @param int $limitTime
     * @return string
     * @throws NumberParseException
     * @throws Exception
     */
    public function sendVerificationCode(?UserWrapper $userModel, $telephone, $templateId, $limitTime = SMSConfig::LIMIT_TIME)
    {
        $phoneNumber = self::validTelephone($telephone, true);

        if (!$this->toValidaTel($userModel, $templateId, $telephone))
            throw new Exception('效验能否发送短信失败!');

        $templateCode = $this->getTemplateCodeByType($templateId, $phoneNumber->getCountryCode());

        $codeDao = CodeDao::getInstance();

        $lastSendTime = $codeDao->getVerifyCodeLastSendTime($templateId, $telephone);

        $waitTime = $limitTime - (time() - $lastSendTime);

        if ($waitTime > 0) throw new Exception("请等待{$waitTime}秒后在发送!");

        $code = B()->randoms(4, '1234567890');

        $param = [$code];

        if ($this->sendSMSService instanceof ALSMSService) {
            $param = [['code' => $code]];
        }

        $this->send($templateCode, $telephone, $param);

        if (!$codeDao->addVerifyCode($templateId, $telephone, $code))
            throw new Exception("发送失败!");

        return true;
    }


    /**
     * 效验验证码
     * @param $templateId
     * @param $tel
     * @param $code
     * @return bool
     * @throws Exception
     */
    public function checkVerificationCode($templateId, $tel, $code): bool
    {
        if (empty($templateId)) throw new Exception("模板错误!");

        if (empty($tel)) throw new Exception("手机号码错误!");

        if (empty($code)) throw new Exception("验证码不能为空!");

        $codeDao = CodeDao::getInstance();

        $codeModel = $codeDao->getCheckVerifyCode($templateId, $tel, $code);

        if ($codeModel == null) throw new Exception('验证码错误!');

        if (($codeModel->getSendTime() + SMSConfig::VALIDA_TIME) < time())
            throw new Exception('验证码已过期!');

        if (!$codeDao->useVerifyCode($codeModel->getId()))
            throw new Exception('效验验证码失败!');

        return true;
    }
}