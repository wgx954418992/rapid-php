<?php

namespace apps\app\classier\controller;

use apps\app\classier\context\UserContext;
use apps\core\classier\service\AreaService;
use apps\core\classier\service\BaseService;
use apps\core\classier\service\EmailService;
use apps\core\classier\service\SMSService;
use Exception;
use libphonenumber\NumberParseException;
use rapidPHP\modules\common\classier\RESTFulApi;
use ReflectionException;

class HomeController extends BaseController
{

    /**
     * 发送短信验证码
     * @route /code/sms/send
     * @method post
     * @typed api
     * @param UserContext $context
     * @param $telephone
     * @param $templateId
     * @return RESTFulApi
     * @throws NumberParseException
     * @throws Exception
     */
    public function sendSMSCode(UserContext $context, $telephone, $templateId)
    {
        SMSService::getInstance()->sendVerificationCode($context->getCurrentUser(), $telephone, $templateId);

        return RESTFulApi::success(null, '发送成功');
    }

    /**
     * 发送邮件验证码
     * @route /code/email/send
     * @method post
     * @typed api
     * @param UserContext $context
     * @param $email
     * @param $templateId
     * @return RESTFulApi
     * @throws Exception
     */
    public function sendEmailCode(UserContext $context, $email, $templateId)
    {
        EmailService::getInstance()->sendVerificationCode($context->getCurrentUser(), $email, $templateId);

        return RESTFulApi::success(null, '发送成功');
    }
}