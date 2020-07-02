<?php

namespace rapidPHP\plugin\wxsdk\publicly;


use Exception;
use SimpleXMLElement;

class WXBizMsgCrypt
{
    private $appId;

    private $token;

    private $encodingAesKey;

    /**
     * 构造函数
     * @param $token string 公众平台上，开发者设置的token
     * @param $appId string 公众平台的appId
     * @param $encodingAesKey string 公众平台上，开发者设置的EncodingAESKey
     */
    public function __construct($token, $appId, $encodingAesKey)
    {
        $this->token = $token;
        $this->appId = $appId;
        $this->encodingAesKey = $encodingAesKey;
    }

    /**
     * 将公众平台回复用户的消息加密打包.
     * <ol>
     *    <li>对要发送的消息进行AES-CBC加密</li>
     *    <li>生成安全签名</li>
     *    <li>将消息密文和安全签名打包成xml格式</li>
     * </ol>
     *
     * @param $replyMsg string 公众平台待回复用户的消息，xml格式的字符串
     * @param $timeStamp string 时间戳，可以自己生成，也可以用URL参数的timestamp
     * @param $nonce string 随机串，可以自己生成，也可以用URL参数的nonce
     * @param &$encryptMsg string 加密后的可以直接回复用户的密文，包括msg_signature, timestamp, nonce, encrypt的xml格式的字符串,
     *                      当return返回0时有效
     *
     * @return int 成功0，失败返回对应的错误码
     */
    public function encryptMsg($replyMsg, $timeStamp, $nonce, &$encryptMsg)
    {
        $pc = new Prpcrypt($this->encodingAesKey);

        //加密
        $array = $pc->encrypt($replyMsg, $this->appId);
        $ret = $array[0];
        if ($ret != ErrorCode::$OK) return $ret;

        if ($timeStamp == null) $timeStamp = time();
        $encrypt = $array[1];

        //生成安全签名
        $array = $this->getSHA1($this->token, $timeStamp, $nonce, $encrypt);
        $ret = $array[0];
        if ($ret != ErrorCode::$OK) return $ret;

        $signature = $array[1];

        //生成发送的xml
        $XMLParse = new XMLParse;
        $encryptMsg = $XMLParse->generate($encrypt, $signature, $timeStamp, $nonce);
        return ErrorCode::$OK;
    }

    /**
     * 检验消息的真实性，并且获取解密后的明文.
     * <ol>
     *    <li>利用收到的密文生成安全签名，进行签名验证</li>
     *    <li>若验证通过，则提取xml中的加密消息</li>
     *    <li>对消息进行解密</li>
     * </ol>
     *
     * @param $msgSignature string 签名串，对应URL参数的msg_signature
     * @param $timestamp string 时间戳 对应URL参数的timestamp
     * @param $nonce string 随机串，对应URL参数的nonce
     * @param $postData string 密文，对应POST请求的数据
     * @param &$msg string|SimpleXMLElement 解密后的原文，当return返回0时有效
     *
     * @return int 成功0，失败返回对应的错误码
     */
    public function decryptMsg($msgSignature, $timestamp, $nonce, $postData, &$msg)
    {
        if (strlen($this->encodingAesKey) != 43) return ErrorCode::$IllegalAesKey;

        $pc = new Prpcrypt($this->encodingAesKey);

        //提取密文
        $XMLParse = new XMLParse;
        $array = $XMLParse->extract($postData);

        $ret = $array[0];
        if ($ret != ErrorCode::$OK) return $ret;

        if ($timestamp == null) $timestamp = time();

        $encrypt = $array[1];
        //$touser_name = $array[2];

        //验证安全签名
        $array = $this->getSHA1($this->token, $timestamp, $nonce, $encrypt);

        $ret = $array[0];
        if ($ret != ErrorCode::$OK) return $ret;

        $signature = $array[1];
        if ($signature != $msgSignature) return ErrorCode::$ValidateSignatureError;

        $result = $pc->decrypt($encrypt, $this->appId);
        if ($result[0] != ErrorCode::$OK) return $result[0];

        $msg = X()->decode($result[1]);

        return ErrorCode::$OK;
    }

    /**
     * 用SHA1算法生成安全签名
     * @param string $token 票据
     * @param string $timestamp 时间戳
     * @param string $nonce 随机字符串
     * @param string $encrypt_msg 密文消息
     * @return array
     */
    public function getSHA1($token, $timestamp, $nonce, $encrypt_msg)
    {
        try {
            $array = array($encrypt_msg, $token, $timestamp, $nonce);
            sort($array, SORT_STRING);
            $str = implode($array);
            return array(ErrorCode::$OK, sha1($str));
        } catch (Exception $e) {
            return array(ErrorCode::$ComputeSignatureError, null);
        }
    }
}