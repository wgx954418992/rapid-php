<?php

namespace rapidPHP\plugin\wxsdk\mini;

/**
 *
 * error code 说明.
 * <ul>
 *    <li>-41001: encodingAesKey 非法</li>
 *    <li>-41003: aes 解密失败</li>
 *    <li>-41004: 解密后得到的buffer非法</li>
 *    <li>-41005: base64加密失败</li>
 *    <li>-41016: base64解密失败</li>
 * </ul>
 */
class WXBizDataCrypt
{

    public static $OK = 0;

    public static $IllegalAesKey = -41001;

    public static $IllegalIv = -41002;

    public static $IllegalBuffer = -41003;

    public static $DecodeBase64Error = -41004;

    /**
     * 检验数据的真实性，并且获取解密后的明文.
     * @param $appId string 小程序的appid
     * @param $sessionKey  string 用户在小程序登录后获取的会话密钥
     * @param $encryptedData string 加密的用户数据
     * @param $iv string 与用户数据一同返回的初始向量
     * @param $data string 解密后的原文
     *
     * @return int 成功0，失败返回对应的错误码
     */
    public static function decryptData($appId, $sessionKey, $encryptedData, $iv, &$data)
    {
        if (strlen($sessionKey) != 24) return self::$IllegalAesKey;

        $aesKey = base64_decode($sessionKey);

        if (strlen($iv) != 24) return self::$IllegalIv;

        $aesIV = base64_decode($iv);

        $aesCipher = base64_decode($encryptedData);

        $result = openssl_decrypt($aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);

        $dataArray = B()->jsonDecode($result);

        if (empty($dataArray)) return self::$IllegalBuffer;

        $resultAppId = B()->getData(B()->getData($dataArray, 'watermark'), 'appid');

        if ($resultAppId != $appId) return self::$IllegalBuffer;

        $data = $dataArray;

        return self::$OK;
    }
}