<?php


namespace apps\core\classier\service\sms;

use apps\core\classier\config\sms\TCSMSConfig;
use rapidPHP\modules\common\classier\AB;
use ReflectionException;
use TencentCloud\Common\Credential;
use TencentCloud\Common\Profile\ClientProfile;
use TencentCloud\Common\Profile\HttpProfile;
use TencentCloud\Sms\V20190711\Models\SendSmsRequest;
use TencentCloud\Sms\V20190711\SmsClient;
use function rapidPHP\AR;
use function rapidPHP\B;

class TCSMSService extends SMSInterface
{

    /**
     * @var Credential
     */
    private $cred;

    /**
     * @var HttpProfile
     */
    private $httpProfile;

    /**
     * @var ClientProfile
     */
    private $clientProfile;

    /**
     * TCSMService constructor.
     */
    public function __construct()
    {
        $config = new TCSMSConfig();

        parent::__construct($config);

        $this->cred = new Credential($config->getSecretId(), $config->getSecretKey());

        $this->httpProfile = new HttpProfile();
        $this->httpProfile->setReqMethod("GET");
        $this->httpProfile->setReqTimeout(30);
        $this->httpProfile->setEndpoint("sms.tencentcloudapi.com");

        $this->clientProfile = new ClientProfile();
        $this->clientProfile->setSignMethod("TC3-HMAC-SHA256");
        $this->clientProfile->setHttpProfile($this->httpProfile);
    }


    /**
     * 发送短息
     * @param $templateId {模板 ID: 必须填写已审核通过的模板 ID。模板ID可登录 [短信控制台] 查看 }
     * @param $phone {示例如：+8613711112222， 其中前面有一个+号 ，86为国家码，13711112222为手机号，最多不要超过200个手机号}
     * @param $param {模板参数: 若无模板参数，则设置为空}
     * @return bool
     * @throws ReflectionException
     */
    public function send($templateId, $phone, $param = null)
    {
        $config = parent::getConfig();

        $client = new SmsClient($this->cred, $config->getRegionId(), $this->clientProfile);

        $req = new SendSmsRequest();

        $req->SmsSdkAppid = $config->getAppId();

        $req->Sign = $config->getSign();

        $req->ExtendCode = $config->getExtendCode();

        if (!is_array($phone)) $phone = [$phone];

        $req->PhoneNumberSet = $phone;

        $req->SenderId = $config->getSenderId();

        $req->SessionContext = $config->getSessionContext();

        $req->TemplateID = $templateId;

        $req->TemplateParamSet = $param;

        $resp = $client->SendSms($req);

        $sendStatusSet = B()->getData($resp->serialize(), 'SendStatusSet');

        $data = new AB();

        $result = [];

        foreach ($sendStatusSet as $value) {
            $data->data($value);

            $phone = $data->toString('PhoneNumber');

            $fee = $data->toInt('Fee') === 1;

            if (!$fee) $fee = $data->toString('Message');

            $result[$phone] = $fee;
        }

        return AR()->isAllAppointValue($result,true);
    }

}