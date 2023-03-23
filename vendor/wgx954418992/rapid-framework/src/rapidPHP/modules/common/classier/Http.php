<?php

namespace rapidPHP\modules\common\classier;

class Http
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
     * 生成cookie
     * @param $cookie
     * @return string
     */
    private function makeCookie($cookie): string
    {
        $strCookie = '';

        if (is_array($cookie)) {
            foreach ($cookie as $item => $value) $strCookie .= "{$item}={$value};";
        } else {
            $strCookie = (string)$cookie;
        }

        return $strCookie;
    }


    /**
     * 发送httpResponse
     * @param string $url
     * @param array|string|null $post
     * @param int $timeout
     * @param array|null $cookie
     * @param array|null $setOpt
     * @param bool $isBuild
     * @return string|null
     */
    public function getHttpResponse(string $url,
                                           $post = [],
                                    int    $timeout = 5000,
                                    ?array $cookie = [],
                                    ?array $setOpt = [],
                                    bool   $isBuild = true): ?string
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($curl, CURLOPT_HEADER, 0);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        if (!empty($post)) {
            curl_setopt($curl, CURLOPT_POST, 1);

            curl_setopt($curl, CURLOPT_POSTFIELDS, is_array($post) && $isBuild ? http_build_query($post) : $post);
        }

        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);

        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);

        curl_setopt($curl, CURLOPT_COOKIE, !is_string($cookie) ? $this->makeCookie($cookie) : $cookie);

        foreach ($setOpt as $item => $value) curl_setopt($curl, $item, $value);

        $executive = curl_exec($curl);

        if (curl_errno($curl)) return null;

        curl_close($curl);

        return $executive;
    }


    /**
     * 解析http_response_headers
     * @param array $headers
     * @return array
     */
    public function parseHeaders(array $headers): array
    {
        $head = [];

        foreach ($headers as $v) {

            $t = explode(':', $v, 2);

            if (isset($t[1])) {
                $head[trim($t[0])] = trim($t[1]);
            } else {
                $head[] = $v;

                if (preg_match("#HTTP/[0-9.]+\s+([0-9]+)#", $v, $out)) {
                    $head['response_code'] = intval($out[1]);
                }
            }
        }

        return $head;
    }

    /**
     * 获取Http响应头
     * @param string $url
     * @param string $headers
     * @param array $context
     * @return array
     */
    public function getHTTPResponseHeaders(string $url, string $headers = '', array $context = []): array
    {
        $uri = Uri::getInstance()->parseUrl($url);

        $host = Build::getInstance()->getData($uri, Uri::URL_HOST);

        $scheme = Build::getInstance()->getData($uri, Uri::URL_SCHEME);

        $port = Build::getInstance()->contrast(Build::getInstance()->getData($uri, Uri::URL_PORT), $scheme === 'https' ? 443 : 80);

        if ($sock = @fsockopen($host, $port, $error)) {
            fputs($sock, "GET {$url} HTTP/1.1\r\n");

            fputs($sock, "Host: {$host}\r\n");

            fputs($sock, "{$headers}");

            foreach ($context as $name => $value) fputs($sock, "$name: $value\r\n");

            fputs($sock, "\r\n\r\n");

            $rawHeaders = [];

            while ($tmp = trim(fgets($sock, 4096))) {
                $rawHeaders [] = $tmp;
            }

            return $this->parseHeaders($rawHeaders);
        }

        return [];
    }
}
