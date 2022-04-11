<?php


namespace apps\core\classier\sender\sms\impl;

use apps\core\classier\enum\CodeType;
use apps\core\classier\sender\sms\ISMSSender;
use apps\core\classier\sender\sms\ITCloudConfig;
use Exception;
use rapidPHP\modules\common\classier\AB;
use TencentCloud\Common\Credential;
use TencentCloud\Common\Profile\ClientProfile;
use TencentCloud\Common\Profile\HttpProfile;
use TencentCloud\Sms\V20190711\Models\SendSmsRequest;
use TencentCloud\Sms\V20190711\SmsClient;
use function rapidPHP\AR;
use function rapidPHP\B;

class TCloudSender implements ISMSSender
{

    /**
     * @var ITCloudConfig
     */
    protected $config;

    /**
     * @var Credential
     */
    protected $cred;

    /**
     * @var HttpProfile
     */
    protected $httpProfile;

    /**
     * @var ClientProfile
     */
    protected $clientProfile;

    /**
     * TCloudSender constructor.
     * @param ITCloudConfig $config
     */
    public function __construct(ITCloudConfig $config)
    {
        $this->config = $config;

        $this->cred = new Credential($this->config->getSecretId(), $this->config->getSecretKey());

        $this->httpProfile = new HttpProfile();

        $this->httpProfile->setReqMethod("GET");

        $this->httpProfile->setReqTimeout(30);

        $this->httpProfile->setEndpoint("sms.tencentcloudapi.com");

        $this->clientProfile = new ClientProfile();

        $this->clientProfile->setSignMethod("TC3-HMAC-SHA256");

        $this->clientProfile->setHttpProfile($this->httpProfile);
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
     * 发送短息
     * @param string $templateCode {模板 ID: 必须填写已审核通过的模板 ID。模板ID可登录 [短信控制台] 查看 }
     * @param string|array $telephone {示例如：+8613711112222， 其中前面有一个+号 ，86为国家码，13711112222为手机号，最多不要超过200个手机号}
     * @param array|null $param {模板参数: 若无模板参数，则设置为空}
     * @param null $sign
     * @return bool
     * @throws Exception
     */
    public function send(string $templateCode, $telephone, ?array $param = null, $sign = null): bool
    {
        if (!is_array($telephone)) $telephone = [$telephone];

        if (count($telephone) > 200) throw new Exception('Telephone count exceed 200');

        $client = new SmsClient($this->cred, $this->config->getRegion(), $this->clientProfile);

        $req = new SendSmsRequest();

        $req->SmsSdkAppid = $this->config->getAppId();

        $req->Sign = empty($sign) ? $this->config->getSign() : $sign;

        $req->ExtendCode = $this->config->getExtendCode();

        $req->PhoneNumberSet = $telephone;

        $req->SenderId = $this->config->getSenderId();

        $req->SessionContext = $this->config->getSessionContext();

        $req->TemplateID = $templateCode;

        $req->TemplateParamSet = array_values($param);

        $resp = $client->SendSms($req);

        $sendStatusSet = B()->getData($resp->serialize(), 'SendStatusSet');

        $data = new AB();

        $result = [];

        foreach ($sendStatusSet as $value) {
            $data->data($value);

            $telephone = $data->toString('PhoneNumber');

            $fee = $data->toInt('Fee') === 1;

            if (!$fee) $fee = $data->toString('Message');

            $result[$telephone] = $fee;
        }

        return AR()->isAllAppointValue($result, true);
    }

}
