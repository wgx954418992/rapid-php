<?php


namespace wxsdk\publicly\classier\server\crypt;

use Exception;
use wxsdk\publicly\config\CryptErrorConfig;
use function rapidPHP\B;
use function rapidPHP\X;


/**
 * msg XMLParse class
 *
 * 提供提取消息格式中的密文及生成回复消息格式的接口.
 */
class MsgXMLParse
{

    /**
     * 提取出xml数据包中的加密消息
     * @param string $xmlText 待提取的xml字符串
     * @return array 提取出的加密消息字符串
     */
    public function extract(string $xmlText): array
    {
        try {
            $data = X()->decode($xmlText);

            if (empty($data)) throw new Exception('parse Xml error');

            $encrypt = B()->getData($data, 'Encrypt');

            $toUserName = B()->getData($data, 'ToUserName');

            return [0, $encrypt, $toUserName];
        } catch (Exception $e) {
            return [CryptErrorConfig::$ParseXmlError, null, null];
        }
    }

    /**
     * 生成xml消息
     * @param $encrypt string 加密后的消息密文
     * @param $signature string 安全签名
     * @param $timestamp string|int 时间戳
     * @param $nonce string 随机字符串
     * @return string
     */
    public function generate(string $encrypt, string $signature, $timestamp, string $nonce): string
    {
        $data = ['Encrypt' => $encrypt, 'MsgSignature' => $signature, 'TimeStamp' => $timestamp, 'Nonce' => $nonce];

        return X()->encode($data);
    }
}