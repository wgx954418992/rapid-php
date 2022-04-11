<?php


namespace apps\core\classier\sender\sms;

use apps\core\classier\enum\CodeType;

interface ISMSSender
{

    /**
     * 通过CodeType+国家地区获取模板code
     * @param CodeType $codeType
     * @param string $countryCode
     * @return string
     */
    public function getTemplateCode(CodeType $codeType, string $countryCode = '86'): string;

    /**
     * 发送接口
     * @param string $templateCode
     * @param string|array $telephone
     * @param array|null $param
     * @param null $sign
     * @return bool
     */
    public function send(string $templateCode, $telephone, ?array $param, $sign = null): bool;
}
