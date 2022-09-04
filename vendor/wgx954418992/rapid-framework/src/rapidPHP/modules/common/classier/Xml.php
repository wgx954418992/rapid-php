<?php

namespace rapidPHP\modules\common\classier;

use XMLWriter;

class Xml
{

    /**
     * 采用单例模式
     */
    use Instances;

    /**
     * 实例不存在
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * Xml constructor.
     */
    public function __construct()
    {

    }

    /**
     * xml开始
     * @param $root
     * @param $version
     * @param $encoding
     * @return XMLWriter
     */
    private function xmlStart($root, $version, $encoding): XMLWriter
    {
        $xml = new XMLWriter();

        $xml->openMemory();

        if (!empty($version)) {
            $xml->startDocument($version, $encoding);
        }

        if (!empty($root)) {
            $xml->startElement($root);
        }

        return $xml;
    }

    /**
     * xml数据转换
     * @param XMLWriter $xml
     * @param array $array
     * @param $rKey
     * @return XMLWriter
     */
    private function xmlData(XMLWriter $xml, array $array, $rKey = null): XMLWriter
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {

                $cKey = !is_string($key)?$rKey:$key;

                if(is_string($cKey) ){
                    $xml->startElement($cKey);
                }

                $this->xmlData($xml, $value, $key);

                if(is_string($cKey) ){
                    $xml->endElement();
                }
            } else {
                $xml->writeElement($key, $value);
            }
        }

        return $xml;
    }


    /**
     * 数组转换xml
     * @param array $array
     * @param string $root
     * @param string $version
     * @param string $encoding
     * @return string
     */
    public function encode(array $array, string $root = 'xml', string $version = '1.0', string $encoding = 'utf-8'): string
    {
        $xml = $this->xmlStart($root, $version, $encoding);

        $xml = $this->xmlData($xml, $array);

        $xml->endElement();

        return $xml->outputMemory(true);
    }


    /**
     * 解析xml
     * @param $xml
     * @return mixed|array|string|null
     */
    public function decode($xml)
    {
        if (is_string($xml)) {
            return json_decode(json_encode((array)@simplexml_load_string($xml, null, LIBXML_NOCDATA)), true);
        }

        return false;
    }
}
