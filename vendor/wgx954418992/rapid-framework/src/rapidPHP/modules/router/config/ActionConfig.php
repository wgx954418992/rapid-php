<?php

namespace rapidPHP\modules\router\config;

use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Xml;

class ActionConfig
{

    /**
     * 编码类型 xml
     */
    const ENCODE_TYPE_XML = 'xml';

    /**
     * 编码类型 json
     */
    const ENCODE_TYPE_JSON = 'json';

    /**
     * 获取编码类型
     * @param $remark
     * @return string|null
     */
    public static function getEncodeType($remark): ?string
    {
        if(empty($remark)) return null;

        if (strtolower(substr($remark, 0, self::ENCODE_TYPE_XML)) === self::ENCODE_TYPE_XML) {
            return self::ENCODE_TYPE_XML;
        } else if (strtolower(substr($remark, 0, self::ENCODE_TYPE_JSON)) === self::ENCODE_TYPE_JSON) {
            return self::ENCODE_TYPE_JSON;
        }
        return null;
    }

    /**
     * 获取编码值
     * @param $type
     * @param $value
     * @return bool|mixed|null
     */
    public static function getEncodeValue($type, $value): ?bool
    {
        switch (strtolower($type)) {
            case self::ENCODE_TYPE_XML:
                return Xml::getInstance()->decode($value);
            case self::ENCODE_TYPE_JSON:
                return Build::getInstance()->jsonDecode($value);
        }
        return $value;
    }
}