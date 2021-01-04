<?php


namespace apps\core\classier\service\sms;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use apps\core\classier\config\sms\ALSMSConfig;
use function rapidPHP\B;

class ALSMSService extends SMSInterface
{

    /**
     * ALSMSService constructor.
     * @throws ClientException
     */
    public function __construct()
    {
        $config = new ALSMSConfig();

        parent::__construct($config);

        AlibabaCloud::accessKeyClient($config->getAccessKeyId(), $config->getAccessKeySecret())
            ->regionId($config->getRegionId())
            ->asDefaultClient();
    }

    /**
     * 发送短信
     * @param $templateCode -模板Code
     * @param $phoneNumber -手机号码
     * @param $param -参数
     * @return bool
     * @throws ClientException
     * @throws ServerException
     */
    public function send($templateCode, $phoneNumber, $param = null): bool
    {
        $config = parent::getConfig();

        if (!is_array($phoneNumber)) $phoneNumber = [$phoneNumber];

        $query = [
            'RegionId' => $config->getRegionId(),
            'TemplateCode' => $templateCode,
            'SignNameJson' => json_encode($config->getSign()),
            'PhoneNumberJson' => json_encode($phoneNumber),
        ];

        if (!empty($param)) $query['TemplateParamJson'] = json_encode($param);

        $result = AlibabaCloud::rpc()
            ->product('Dysmsapi')
            ->version('2017-05-25')
            ->action('SendBatchSms')
            ->method('POST')
            ->host('dysmsapi.aliyuncs.com')
            ->options(['query' => $query,])
            ->request();

        $code = B()->getData($result->toArray(), 'Code');

        return strtoupper($code) === 'OK';
    }

}