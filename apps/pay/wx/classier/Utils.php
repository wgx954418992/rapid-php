<?php

namespace pay\wx\classier;

use Exception;
use pay\wx\config\Config;
use pay\wx\classier\request\BaseRequest;
use pay\wx\classier\response\BaseResponse;
use pay\wx\classier\response\UnifiedOrderResponse;
use rapidPHP\modules\common\classier\Http;
use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\common\classier\Uri;
use rapidPHP\modules\reflection\classier\Classify;
use ReflectionException;
use function rapidPHP\B;
use function rapidPHP\X;

class Utils
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
     * 获取签名
     * @param Config $config
     * @param $data
     * @return string
     * @throws Exception
     */
    public function getSign(Config $config, array $data): string
    {
        unset($data['sign']);

        ksort($data);

        $string = Uri::getInstance()->toQuery($data);

        $string = "{$string}&key=" . $config->getKey();

        if ($config->getSignType() == 'MD5') {
            $result = md5($string);
        } else if ($config->getSignType() == 'HMAC-SHA256') {
            $result = hash_hmac('sha256', $string, $config->getKey());
        } else {
            throw new Exception('签名类型不支持！');
        }

        return strtoupper($result);
    }

    /**
     * 解析response
     * @param $xml
     * @return array|false|mixed|string
     * @throws Exception
     */
    public function parseResponseByXML($xml)
    {
        if (empty($xml)) throw new Exception('xml 错误!');

        $data = X()->decode($xml);

        if (empty($data)) throw new Exception('解析xml失败!');

        $returnCode = B()->getData($data, 'return_code');

        $returnMsg = B()->getData($data, 'return_msg');

        if (strtoupper($returnCode) != 'SUCCESS') {
            throw new Exception($returnMsg);
        }

        return $data;
    }

    /**
     * 发送http请求
     * @param Config $config
     * @param BaseRequest $request
     * @param string $responseClass
     * @return BaseResponse|UnifiedOrderResponse|array|null|string
     * @throws ReflectionException
     * @throws Exception
     */
    public function sendHttpRequest(Config $config, BaseRequest $request, $responseClass = BaseResponse::class)
    {
        if (empty($request->getAppid())) $request->setAppId($config->getAppId());

        if (empty($request->getMchId())) $request->setMchId($config->getMchId());

        if (empty($request->getNonceStr())) {
            $request->setNonceStr(B()->randoms(32, 'abcdefghijklmnopqrstuvwxyz0123456789'));
        }

        if (empty($request->getSign())) {
            $request->setSign(Utils::getInstance()->getSign($config, $request->toData()));
        }

        $setOpt = [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true
        ];

        if ($config->getCurlProxyHost() != "0.0.0.0" && $config->getCurlProxyPort() != 0) {
            $setOpt[CURLOPT_PROXY] = $config->getCurlProxyHost();
            $setOpt[CURLOPT_PROXYPORT] = $config->getCurlProxyPort();
        }

        if ($config->getSslCertPath() == true) {
            $setOpt[CURLOPT_SSLCERTTYPE] = 'PEM';
            $setOpt[CURLOPT_SSLCERT] = $config->getSslCertPath();
            $setOpt[CURLOPT_SSLKEYTYPE] = 'PEM';
            $setOpt[CURLOPT_SSLKEY] = $config->getSslKeyPath();
        }

        $responseXml = Http::getInstance()->getHttpResponse($request::URL, $request->toXml(), 30, null, $setOpt);

        if (empty($responseXml)) throw new Exception('请求失败!');

        if (empty($responseClass)) return $responseXml;

        /** @var BaseResponse $response */
        $response = Classify::getInstance($responseClass)->newInstance();

        $response->loadData($this->parseResponseByXML($responseXml));

        if (empty($response->getSign())) throw new Exception('签名错误');

        $responseSign = $this->getSign($config, $response->getRaw());

        if ($response->getSign() != $responseSign) {
            throw new Exception('签名错误!');
        }

        return $response;
    }
}