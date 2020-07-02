<?php


namespace rapidPHP\plugin\wxsdk\publicly;


use Exception;


/**
 * XMLParse class
 *
 * 提供提取消息格式中的密文及生成回复消息格式的接口.
 */
class XMLParse
{

    /**
     * 提取出xml数据包中的加密消息
     * @param string $xmlText 待提取的xml字符串
     * @return array 提取出的加密消息字符串
     */
    public function extract($xmlText)
    {
        try {
            $data = X()->decode($xmlText);

            if (empty($data)) throw new Exception('parse Xml error');

            $encrypt = B()->getData($data, 'Encrypt');
            $toUserName = B()->getData($data, 'ToUserName');
            return [0, $encrypt, $toUserName];
        } catch (Exception $e) {
            return [ErrorCode::$ParseXmlError, null, null];
        }
    }

    /**
     * 生成xml消息
     * @param string $encrypt 加密后的消息密文
     * @param string $signature 安全签名
     * @param string $timestamp 时间戳
     * @param string $nonce 随机字符串
     * @return string
     */
    public function generate($encrypt, $signature, $timestamp, $nonce)
    {
        $data = ['Encrypt' => $encrypt, 'MsgSignature' => $signature, 'TimeStamp' => $timestamp, 'Nonce' => $nonce];

        return X()->encode($data);
    }
}