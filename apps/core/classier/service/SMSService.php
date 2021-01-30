<?php


namespace apps\core\classier\service;

use apps\core\classier\config\BaseConfig;
use apps\core\classier\config\SMSConfig;
use apps\core\classier\dao\master\CodeDao;
use apps\core\classier\helper\CommonHelper;
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

class SMSService extends CodeService
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

        if ($this->sendSMSService instanceof ALSMSService) {
            $param = [$param];
        }

        $result = $this->sendSMSService->send($templateCode, $telephone, $param);

        if (!$result) throw new Exception($templateCode . ' 发送失败!');

        return true;
    }

    /**
     * 发送验证码
     * @param UserWrapper|null $userModel
     * @param $receiver
     * @param $templateId
     * @param int $limitTime
     * @return string
     * @throws Exception
     */
    public function sendVerificationCode(?UserWrapper $userModel, $receiver, $templateId, $limitTime = SMSConfig::LIMIT_TIME)
    {
        /** @var PhoneNumber $phoneNumber */
        $receiver = CommonHelper::validTelephone($receiver, $phoneNumber);

        if (!$this->toValidaTel($userModel, $templateId, $receiver))
            throw new Exception('效验能否发送短信失败!');

        $templateCode = $this->getTemplateCodeByType($templateId, $phoneNumber->getCountryCode());

        $this->checkLastSendTime($receiver, $templateId, $limitTime);

        $code = B()->randoms(4, '1234567890');

        $param = [$code];

        if ($this->sendSMSService instanceof ALSMSService) {
            $param = ['code' => $code];
        }

        $this->send($templateCode, $receiver, $param);

        /** @var CodeDao $codeDao */
        $codeDao = CodeDao::getInstance();

        if (!$codeDao->addVerifyCode($templateId, $receiver, $code))
            throw new Exception("发送失败!");

        return true;
    }

    /**
     * 效验验证码
     * @param $templateId
     * @param $receiver
     * @param $code
     * @param float|int $validaTime
     * @return bool
     * @throws Exception
     */
    public function checkVerificationCode($templateId, $receiver, $code, $validaTime = SMSConfig::VALIDA_TIME): bool
    {
        if (empty($receiver)) throw new Exception("手机号码错误!");

        return parent::checkVerificationCode($templateId, $receiver, $code, $validaTime);
    }
}