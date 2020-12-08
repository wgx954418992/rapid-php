<?php


namespace rapidPHP\modules\common\classier;


class Uri
{

    /**
     * parse url scheme
     */
    const URL_SCHEME = 'scheme';

    /**
     * parse url host
     */
    const URL_HOST = 'host';

    /**
     * parse url port
     */
    const URL_PORT = 'port';

    /**
     * parse url user
     */
    const URL_USER = 'user';

    /**
     * parse url pass
     */
    const URL_PASS = 'pass';

    /**
     * parse url path
     */
    const URL_PATH = 'path';

    /**
     * parse url query
     */
    const URL_QUERY = 'query';

    /**
     * parse url fragment
     */
    const URL_FRAGMENT = 'fragment';

    /**
     * @var Uri
     */
    private static $instance;

    /**
     * @return Uri
     */
    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }

    /**
     * UTF-8 aware parse_url() replacement.
     *
     * @param $url
     * @param int $component
     * @return mixed|string
     */
    public function parseUrl($url, $component = -1)
    {
        $encodedUrl = preg_replace_callback(
            '%[^:/?#&=\.]+%usD',
            function ($matches) {
                return urlencode($matches[0]);
            },
            $url
        );

        $components = parse_url($encodedUrl, $component);

        if (is_array($components)) {
            foreach ($components as &$part) {
                if (is_string($part)) {
                    $part = urldecode($part);
                }
            }
        } else if (is_string($components)) {
            $components = urldecode($components);
        }

        return $components;
    }

    /**
     * 获取url字符串的query参数
     * @param string $url
     * @param bool $isRemove
     * @return array
     */
    public function toArray(string &$url, $isRemove = false): array
    {
        if (!is_int(strpos('?', $url))) {
            $url = '?' . $url;
        }

        $urlQuery = $this->parseUrl($url, PHP_URL_QUERY);

        if (empty($urlQuery)) return [];

        parse_str($urlQuery, $list);

        if ($isRemove) {
            $url = rtrim(str_replace($urlQuery, '', $url), '?');
        }

        return $list;
    }


    /**
     * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
     * @param $data
     * @param bool $isEncode
     * @param bool $isEmpty
     * @param string $connector
     * @return string
     */
    public function toQuery($data, $isEncode = false, $isEmpty = true, $connector = '&')
    {
        $arg = '';

        foreach ($data as $key => $value)
            if (!is_array($value) && ($isEmpty == true && !empty($value) || $isEmpty == false))
                $arg .= (empty($arg) ? "" : $connector) . "{$key}=" . ($isEncode ? urlencode($value) : $value);

        return $arg;
    }
}