<?php


namespace rapidPHP\plugin\wxsdk\publicly;


class ErrorCode
{
    public static $OK = 0;

    public static $ValidateSignatureError = -40001;

    public static $ParseXmlError = -40002;

    public static $ComputeSignatureError = -40003;

    public static $IllegalAesKey = -40004;

    public static $ValidateAppidError = -40005;

    public static $EncryptAESError = -40006;

    public static $DecryptAESError = -40007;

    public static $IllegalBuffer = -40008;

    public static $EncodeBase64Error = -40009;

    public static $DecodeBase64Error = -40010;

    public static $GenReturnXmlError = -40011;
}