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
     * 解析 url 信息，支持中文，可完全替代parse_url 并且兼容原 parse_url
     *
     * - parse_url('https://wgx:dd@www.baidu.com:80/1?a=1')
     * - parse_url('https://www.baidu.com/search#print')
     * - parse_url('file:///xxx/xxx/xxx')
     * - parse_url('ftp://www.baidu.com')
     * - parse_url('?a=1')
     * - parse_url('www.baidu.com/aa/1')
     * @param $uri
     * @param int|string $component
     * @return array|int|mixed|string|null
     */
    public function parseUrl($uri, $component = -1)
    {
        preg_match('/^(?:([A-Za-z-\x{4e00}-\x{9fa5}+@#]+):)?(\/{0,3})?(?:(\w+:\w+)@)?([0-9.\-A-Za-z-\x{4e00}-\x{9fa5}]+)?(?::(\d+))?(?:(\/[^?#]*))?(?:\?([^#]*))?(?:#(.*))?$/ui', $uri, $data);

        $scheme = $data[1] ?? null;

        $up = explode(':', $data[3] ?? null);

        $host = $data[4] ?? null;

        $port = $data[5] ?? null;

        $path = $data[6] ?? null;

        if ($path && substr($path, 0, 1) != '/') $path = '/' . $path;

        $query = $data[7] ?? null;

        $fragment = $data[8] ?? null;

        if ($scheme === 'file') {
            $path = "/{$host}{$path}";

            $host = null;
        }

        $user = (!empty($up) && isset($up[0])) ? $up[0] : null;

        $pass = (!empty($up) && isset($up[1])) ? $up[1] : null;

        $intComponent = is_numeric($component) ? (int)$component : -1;

        switch ($intComponent) {
            case PHP_URL_SCHEME:
                return $scheme;
            case PHP_URL_HOST:
                return $host;
            case PHP_URL_PORT:
                return $port;
            case PHP_URL_USER:
                return $user;
            case PHP_URL_PASS:
                return $pass;
            case PHP_URL_PATH:
                return $path;
            case PHP_URL_QUERY:
                return $query;
            case PHP_URL_FRAGMENT:
                return $fragment;
            default:
                $result = [];

                if ($scheme != null) $result[self::URL_SCHEME] = $scheme;

                if ($host != null) $result[self::URL_HOST] = $host;

                if ($port != null) $result[self::URL_PORT] = (int)$port;

                if ($user != null) $result[self::URL_USER] = $user;

                if ($pass != null) $result[self::URL_PASS] = $pass;

                if ($path != null) $result[self::URL_PATH] = $path;

                if ($query != null) $result[self::URL_QUERY] = $query;

                if ($fragment != null) $result[self::URL_FRAGMENT] = $fragment;

                if ($component && is_string($component)) {
                    return $result[$component] ?? null;
                }

                return $result;
        }
    }

    /**
     * 获取url字符串的query参数
     * @param string $url
     * @param bool $isRemove
     * @return array
     */
    public function toArray(string &$url, bool $isRemove = false): array
    {
        $urlQuery = $this->parseUrl($url, PHP_URL_QUERY);

        if (empty($urlQuery)) $urlQuery = $url;

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
    public function toQuery($data, bool $isEncode = false, bool $isEmpty = true, string $connector = '&'): string
    {
        $arg = '';

        foreach ($data as $key => $value) {
            if (!is_array($value) && ($isEmpty && $value !== '' && $value !== null || !$isEmpty)) {

                $arg .= (empty($arg) ? "" : $connector) . "{$key}=" . ($isEncode ? urlencode($value) : $value);
            }
        }

        return $arg;
    }
}
