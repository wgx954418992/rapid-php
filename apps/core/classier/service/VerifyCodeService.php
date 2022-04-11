<?php

namespace apps\core\classier\service;

use apps\core\classier\config\EmailConfig;
use apps\core\classier\config\SMSConfig;
use apps\core\classier\dao\master\CodeDao;
use apps\core\classier\enum\CodeType;
use apps\core\classier\enum\SendType;
use apps\core\classier\helper\CommonHelper;
use apps\core\classier\model\AppCodeModel;
use apps\core\classier\sender\email\IEmailSender;
use apps\core\classier\sender\sms\ISMSSender;
use Exception;
use libphonenumber\PhoneNumber;
use rapidPHP\modules\common\classier\Instances;
use function rapidPHP\B;
use function rapidPHP\DI;
use function rapidPHP\V;

class VerifyCodeService
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
     * 发送短信验证码
     * @param $receiver
     * @param CodeType $codeType
     * @return bool
     * @throws Exception
     */
    public function sendSMSCode($receiver, CodeType $codeType): bool
    {
        /** @var PhoneNumber $phoneNumber */
        $receiver = CommonHelper::validTelephone($receiver, $phoneNumber);

        /** @var ISMSSender $sender */
        $sender = DI(ISMSSender::class);

        $templateCode = $sender->getTemplateCode($codeType, $phoneNumber->getCountryCode());

        if (empty($templateCode)) throw new Exception('没有找到对应的Template Code!');

        $limitTime = SMSConfig::getInstance()->getLimit();

        /** @var CodeDao $codeDao */
        $codeDao = CodeDao::getInstance();

        $lastSendTime = $codeDao->getCodeLastSendTime($codeType, $receiver);

        $waitTime = $limitTime - (time() - $lastSendTime);

        if ($waitTime > 0) throw new Exception("请等待{$waitTime}秒后在发送!");

        $code = B()->randoms(4, '1234567890');

        $param = ['code' => $code];

        $result = $sender->send($templateCode, $receiver, $param);

        if (!$result) throw new Exception($templateCode . ' 发送失败!');

        $codeModel = new AppCodeModel();

        $codeModel->setCodeType($codeType->getRawValue());

        $codeModel->setSendType(SendType::SMS);

        $codeModel->setCode($code);

        $codeModel->setContent($templateCode);

        $codeModel->setReceiver($receiver);

        $codeModel->setCreatedId($receiver);

        if (!$codeDao->addCode($codeModel))
            throw new Exception("发送失败!");

        return true;
    }

    /**
     * 发送邮箱验证码
     * @param $receiver
     * @param CodeType $codeType
     * @return bool
     * @throws Exception
     */
    public function sendEmailCode($receiver, CodeType $codeType): bool
    {
        if (!V()->email($receiver)) throw new Exception('邮箱错误!');

        $template = EmailConfig::getInstance()->getTemplate($codeType);

        if (empty($template)) throw new Exception('没有找到对应的Template!');

        $limitTime = EmailConfig::getInstance()->getLimit();

        /** @var CodeDao $codeDao */
        $codeDao = CodeDao::getInstance();

        $lastSendTime = $codeDao->getCodeLastSendTime($codeType, $receiver);

        $waitTime = $limitTime - (time() - $lastSendTime);

        if ($waitTime > 0) throw new Exception("请等待{$waitTime}秒后在发送!");

        $code = B()->randoms(4, '1234567890');

        $param = ['code' => $code];

        list($title, $body, $attachments) = $template;

        CommonHelper::parseVariable($title, $param);

        CommonHelper::parseVariable($body, $param);

        /** @var IEmailSender $sender */
        $sender = DI(IEmailSender::class);

        $result = $sender->send($title, $body, $receiver, $attachments);

        if (!$result) throw new Exception($codeType->getRawValue() . ' 发送失败!');

        $codeModel = new AppCodeModel();

        $codeModel->setCodeType($codeType->getRawValue());

        $codeModel->setSendType(SendType::EMAIL);

        $codeModel->setCode($code);

        $codeModel->setContent(json_encode($template));

        $codeModel->setReceiver($receiver);

        $codeModel->setCreatedId($receiver);

        if (!$codeDao->addCode($codeModel))
            throw new Exception("发送失败!");

        return true;
    }


    /**
     * 效验验证码
     * @param $receiver
     * @param CodeType $codeType
     * @param $code
     * @throws Exception
     */
    public function checkCode($receiver, CodeType $codeType, $code)
    {
        if (empty($receiver)) throw new Exception("receiver 错误!");

        if (empty($code)) throw new Exception("验证码不能为空!");

        if ($code == SMSConfig::getInstance()->getUniversal()) return;

        /** @var CodeDao $codeDao */
        $codeDao = CodeDao::getInstance();

        $codeModel = $codeDao->getCheckCode($codeType, $receiver, $code);

        if ($codeModel == null) throw new Exception('验证码错误!');

        switch (SendType::i($codeModel->getSendType())->getRawValue()) {
            case SendType::SMS:
                $validaTime = SMSConfig::getInstance()->getValida();
                break;
            case SendType::EMAIL:
                $validaTime = EmailConfig::getInstance()->getValida();
                break;
            default:
                throw new Exception('send type error!');
        }

        if ($validaTime > 0) {
            if (($codeModel->getSendTime() + $validaTime) < time())
                throw new Exception('验证码已过期!');
        }

        if (!$codeDao->checkedCode($codeModel->getId()))
            throw new Exception('效验验证码失败!');
    }
}
