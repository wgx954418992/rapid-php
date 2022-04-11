<?php


namespace apps\core\classier\sender\sms\impl;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use apps\core\classier\enum\CodeType;
use apps\core\classier\sender\sms\IAliYunConfig;
use apps\core\classier\sender\sms\ISMSSender;
use Exception;
use function rapidPHP\AR;
use function rapidPHP\B;

class AliYunSender implements ISMSSender
{

    /**
     * @var IAliYunConfig
     */
    protected $config;

    /**
     * @var string
     */
    protected $clientName;

    /**
     * AliYunSender constructor.
     * @param IAliYunConfig $config
     * @throws ClientException
     */
    public function __construct(IAliYunConfig $config)
    {
        $this->config = $config;

        $this->clientName = md5($config->getAccessKeyId() . $config->getAccessKeySecret());

        if (!AlibabaCloud::has($this->clientName)) {
            AlibabaCloud::accessKeyClient($this->config->getAccessKeyId(), $this->config->getAccessKeySecret())
                ->regionId($this->config->getRegion())
                ->name($this->clientName);
        }
    }

    /**
     * 通过CodeType+国家地区获取模板code
     * @param CodeType $codeType
     * @param string $countryCode
     * @return string
     */
    public function getTemplateCode(CodeType $codeType, string $countryCode = '86'): string
    {
        if ($countryCode == '86') {
            $codes = (array)$this->config->getTemplateCodeDomestic();
        } else {
            $codes = (array)$this->config->getTemplateCodeAbroad();
        }

        if (array_key_exists($codeType->getRawValue(), $codes)) return $codes[$codeType->getRawValue()];

        return '';
    }

    /**
     * 发送短信
     * @param string $templateCode -模板Code
     * @param string|array $telephone -手机号码
     * @param array|null $param -参数
     * @param null $sign
     * @return bool
     * @throws ClientException
     * @throws ServerException
     * @throws Exception
     */
    public function send(string $templateCode, $telephone, ?array $param = null, $sign = null): bool
    {
        if (!is_array($telephone)) $telephone = [$telephone];

        if (!empty($param) && AR()->getDepth($param) === 1) {
            $param = [$param];
        }

        $dysmsapi = AlibabaCloud::dysmsapi()
            ->v20170525()
            ->sendBatchSms()
            ->regionId($this->config->getRegion())
            ->withTemplateCode($templateCode)
            ->withPhoneNumberJson(json_encode($telephone))
            ->withSignNameJson(json_encode(empty($sign) ? $this->config->getSign() : $sign));

        if (!empty($param)) $dysmsapi->withTemplateParamJson(json_encode($param));

        $result = $dysmsapi
            ->client($this->clientName)
            ->request();

        $code = B()->getData($result->toArray(), 'Code');

        if (strtoupper($code) === 'OK') return true;

        throw new Exception(B()->getData($result->toArray(), 'Message'));
    }

}
