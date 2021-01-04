<?php

namespace wxsdk\publicly\classier\server\crypt;

use Exception;
use wxsdk\publicly\config\CryptErrorConfig;
use function rapidPHP\B;

/**
 * Prpcrypt class
 *
 * 提供接收和推送给公众平台消息的加解密接口.
 */
class Prpcrypt
{
    /**
     * @var false|string
     */
    public $key;

    /**
     * @param $k
     */
    public function __construct($k)
    {
        $this->key = base64_decode($k . "=");
    }

    /**
     * 对明文进行加密
     * @param string $text 需要加密的明文
     * @param $appId
     * @return array 加密后的密文
     */
    public function encrypt($text, $appId)
    {
        try {
            //获得16位随机字符串，填充到明文之前
            $random = B()->randoms(16);

            $text = $random . pack("N", strlen($text)) . $text . $appId;

            $iv = substr($this->key, 0, 16);

            $pkc_encoder = new PKCS7Encoder;

            $text = $pkc_encoder->encode($text);

            $encrypted = openssl_encrypt($text, 'AES-256-CBC', substr($this->key, 0, 32), OPENSSL_ZERO_PADDING, $iv);

            return array(CryptErrorConfig::$OK, $encrypted);
        } catch (Exception $e) {
            return array(CryptErrorConfig::$EncryptAESError, null);
        }
    }

    /**
     * 对密文进行解密
     * @param string|null $encrypted 需要解密的密文
     * @param $appId
     * @return array 解密得到的明文
     */
    public function decrypt(?string $encrypted, $appId): ?array
    {
        try {
            $iv = substr($this->key, 0, 16);

            $decrypted = openssl_decrypt($encrypted, 'AES-256-CBC', substr($this->key, 0, 32), OPENSSL_ZERO_PADDING, $iv);
        } catch (Exception $e) {
            return array(CryptErrorConfig::$DecryptAESError, null);
        }

        try {
            $pkc_encoder = new PKCS7Encoder;

            $result = $pkc_encoder->decode($decrypted);

            if (strlen($result) < 16) return null;

            $content = substr($result, 16, strlen($result));

            $len_list = unpack("N", substr($content, 0, 4));

            $xml_len = $len_list[1];

            $xml_content = substr($content, 4, $xml_len);

            $from_appId = substr($content, $xml_len + 4);

            if (!$appId) $appId = $from_appId;
        } catch (Exception $e) {
            return array(CryptErrorConfig::$IllegalBuffer, null);
        }

        if ($from_appId != $appId) return array(CryptErrorConfig::$ValidateAppidError, null);

        return array(0, $xml_content, $from_appId);
    }
}