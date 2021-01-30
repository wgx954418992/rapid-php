<?php

namespace apps\core\classier\service;

use apps\core\classier\dao\master\CodeDao;
use apps\core\classier\wrapper\UserWrapper;
use Exception;

abstract class CodeService
{

    /**
     * 检查最后发送时间
     * @param $receiver
     * @param $templateId
     * @param int $limitTime
     * @throws Exception
     */
    protected function checkLastSendTime($receiver, $templateId, int $limitTime)
    {
        /** @var CodeDao $codeDao */
        $codeDao = CodeDao::getInstance();

        $lastSendTime = $codeDao->getVerifyCodeLastSendTime($templateId, $receiver);

        $waitTime = $limitTime - (time() - $lastSendTime);

        if ($waitTime > 0) throw new Exception("请等待{$waitTime}秒后在发送!");
    }

    /**
     * 发送验证码
     * @param UserWrapper|null $userModel
     * @param $receiver
     * @param $templateId
     * @param $limitTime
     * @return mixed
     */
    abstract public function sendVerificationCode(?UserWrapper $userModel, $receiver, $templateId, $limitTime);

    /**
     * 效验验证码，统一接口
     * @param $templateId
     * @param $receiver
     * @param $code
     * @param $validaTime
     * @return bool
     * @throws Exception
     */
    public function checkVerificationCode($templateId, $receiver, $code, $validaTime): bool
    {
        if (empty($templateId)) throw new Exception("模板错误!");

        if (empty($receiver)) throw new Exception("receiver 错误!");

        if (empty($code)) throw new Exception("验证码不能为空!");

        /** @var CodeDao $codeDao */
        $codeDao = CodeDao::getInstance();

        $codeModel = $codeDao->getCheckVerifyCode($templateId, $receiver, $code);

        if ($codeModel == null) throw new Exception('验证码错误!');

        if ($validaTime > 0) {
            if (($codeModel->getSendTime() + $validaTime) < time())
                throw new Exception('验证码已过期!');
        }

        if (!$codeDao->useVerifyCode($codeModel->getId()))
            throw new Exception('效验验证码失败!');

        return true;
    }

}