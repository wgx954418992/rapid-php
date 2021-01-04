<?php

namespace wxsdk\publicly\config;

/**
 * Class CryptErrorConfig
 * @package wxsdk\publicly\config
 */
class CryptErrorConfig
{
    /**
     * @var int
     */
    public static $OK = 0;

    /**
     * @var int
     */
    public static $ValidateSignatureError = -40001;

    /**
     * @var int
     */
    public static $ParseXmlError = -40002;

    /**
     * @var int
     */
    public static $ComputeSignatureError = -40003;

    /**
     * @var int
     */
    public static $IllegalAesKey = -40004;

    /**
     * @var int
     */
    public static $ValidateAppidError = -40005;

    /**
     * @var int
     */
    public static $EncryptAESError = -40006;

    /**
     * @var int
     */
    public static $DecryptAESError = -40007;

    /**
     * @var int
     */
    public static $IllegalBuffer = -40008;

    /**
     * @var int
     */
    public static $EncodeBase64Error = -40009;

    /**
     * @var int
     */
    public static $DecodeBase64Error = -40010;

    /**
     * @var int
     */
    public static $GenReturnXmlError = -40011;
}