<?php

namespace apps\file\classier\config\oss;

use apps\core\classier\config\Configure;
use oss\classier\config\IAliYunConfig;
use SplSubject;

class AliYunConfig implements IAliYunConfig
{

    /**
     * Configure
     */
    use Configure;

    /**
     * ACCESS KEY ID
     * @var string
     * @config oss.aliyun.accessKeyId
     */
    protected $accessKeyId;

    /**
     * SECRET
     * @var string
     * @config oss.aliyun.secret
     */
    protected $secret;

    /**
     * END POINT
     * @var string
     * @config oss.aliyun.endpoint
     */
    protected $endpoint;

    /**
     * bucket
     * @var string
     * @config oss.aliyun.bucket
     */
    protected $bucket;

    /**
     * callback
     * @var string[]
     * @config oss.aliyun.callback
     */
    protected $callback;

    /**
     * @return string
     */
    public function getAccessKeyId(): string
    {
        return $this->accessKeyId;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
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
