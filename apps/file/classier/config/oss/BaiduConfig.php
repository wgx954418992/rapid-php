<?php

namespace apps\file\classier\config\oss;

use apps\core\classier\config\Configure;
use oss\classier\config\IAliYunConfig;
use oss\classier\config\IBaiduConfig;
use SplSubject;

class BaiduConfig implements IBaiduConfig
{

    /**
     * Configure
     */
    use Configure;

    /**
     * ACCESS KEY ID
     * @var string
     * @config oss.baidu.accessKey
     */
    protected $accessKey;

    /**
     * SECRETKey
     * @var string
     * @config oss.baidu.secretKey
     */
    protected $secretKey;

    /**
     * END POINT
     * @var string
     * @config oss.baidu.endpoint
     */
    protected $endpoint;

    /**
     * bucket
     * @var string
     * @config oss.baidu.bucket
     */
    protected $bucket;

    /**
     * callback
     * @var string[]
     * @config oss.baidu.callback
     */
    protected $callback;

    /**
     * @return string
     */
    public function getAccessKey(): string
    {
        return $this->accessKey;
    }

    /**
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @return string
     */
    public function getBucket(): string
    {
        return $this->bucket;
    }

    /**
     * @return string[]
     */
    public function getCallback(): array
    {
        if (empty($this->callback)) return [];

        $data = [];

        foreach ($this->callback as $name => $value) {
            $data[$name] = preg_replace("#\#\{(.*?)\}#i", '${$1}', $value);
        }

        return $data;
    }
}
