<?php
namespace rapidPHP\plugin\pay\weixin;

use Exception;

class Utils
{
    /**
     * @var Config
     */
    private $config;

    /**
     * Utils constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * 生成签名
     * @param $data
     * @return string
     * @throws Exception
     */
    public function getSign($data)
    {
        //签名步骤一：按字典序排序参数
        ksort($data);

        $string = $this->toUrlParams($data);

        //签名步骤二：在string后加入KEY
        $string = "{$string}&key=" . $this->config->getKey();

        if ($this->config->getSignType() == "MD5") {
            $string = md5($string);
        } else if ($this->config->getSignType() == "HMAC-SHA256") {
            $string = hash_hmac("sha256", $string, $this->config->getKey());
        } else {
            throw new Exception("签名类型不支持！");
        }

        //签名步骤三：MD5加密
        $string = md5($string);

        //签名步骤四：所有字符转为大写
        return strtoupper($string);
    }

    /**
     * 检测签名
     * @param $data
     * @return bool
     * @throws Exception
     */
    public function verifySign($data)
    {
        if (!isset($data['sign'])) return false;

        return $data['sign'] == $this->getSign($data);
    }

    /**
     * 格式化参数格式化成url参数
     * @param $data
     * @return string
     */
    public static function toUrlParams($data)
    {
        $data = AR()->delete($data, ['sign']);

        ksort($data);

        return B()->toUrlString($data);
    }


    /**
     * 以post方式提交xml到对应的接口url
     * @param $xml :需要post的xml数据
     * @param $url :url
     * @param bool $useCert :是否需要证书，默认不需要
     * @param int $second :url执行超时时间，默认30s
     * @return mixed
     */
    public function postXmlCurl($xml, $url, $useCert = false, $second = 30)
    {
        $setOpt = [CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false, CURLOPT_HEADER => false, CURLOPT_RETURNTRANSFER => true];

        if ($this->config->getCurlProxyHost() != "0.0.0.0" && $this->config->getCurlProxyPort() != 0) {
            $setOpt[CURLOPT_PROXY] = $this->config->getCurlProxyHost();
            $setOpt[CURLOPT_PROXYPORT] = $this->config->getCurlProxyPort();
        }

        if ($useCert == true) {
            $setOpt[CURLOPT_SSLCERTTYPE] = 'PEM';
            $setOpt[CURLOPT_SSLCERT] = $this->config->getSslCertPath();
            $setOpt[CURLOPT_SSLKEYTYPE] = 'PEM';
            $setOpt[CURLOPT_SSLKEY] = $this->config->getSslKeyPath();
        }

        return B()->getHttpResponse($url, $xml, $second, null, $setOpt);
    }
}