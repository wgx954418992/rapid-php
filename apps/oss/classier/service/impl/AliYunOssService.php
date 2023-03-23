<?php


namespace oss\classier\service\impl;


use apps\oss\classier\service\IOssService;
use Exception;
use oss\classier\config\IAliYunConfig;
use oss\classier\model\UploadModel;
use OSS\Core\OssException;
use OSS\OssClient;
use rapidPHP\modules\common\classier\Xml;

class AliYunOssService extends IOssService
{

    /**
     * OSS RENAMES
     */
    const OSS_RENAMES = [
        self::OSS_PROCESS => OssClient::OSS_PROCESS,
        self::OSS_CALLBACK => OssClient::OSS_CALLBACK,
        self::OSS_CALLBACK_VAR => OssClient::OSS_CALLBACK_VAR,
    ];

    /**
     * client
     * @var OssClient
     */
    protected $client;

    /**
     * config
     * @var IAliYunConfig
     */
    protected $config;

    /**
     * @param IAliYunConfig $config
     * @throws Exception
     */
    public function __construct(IAliYunConfig $config)
    {
        if (!class_exists(\OSS\OssClient::class)) {
            throw new Exception('Aliyun OSS Client Not Found，run `composer require aliyuncs/oss-sdk-php`');
        }

        $this->config = $config;

        $this->client = new OssClient($config->getAccessKeyId(), $config->getSecret(), $config->getEndpoint());
    }

    /**
     * 上传文件
     * @param UploadModel $uploadModel
     * @return null|bool|string
     * @throws OssException
     * @throws Exception
     */
    public function uploadFile(UploadModel $uploadModel)
    {
        $options = [
            OssClient::OSS_CONTENT_TYPE => $uploadModel->getMime(),
        ];

        if ($uploadModel->isUseCallback()) {
            $options[self::OSS_CALLBACK] = json_encode($this->config->getCallback());

            if (!empty($uploadModel->getCallbackVar())) {
                $options[self::OSS_CALLBACK_VAR] = json_encode($uploadModel->getCallbackVar());
            }
        }

        $options = array_merge($options, $uploadModel->getOptions());

        $this->handlerOptions($options);

        $data = $this->client->uploadFile($this->config->getBucket(), $uploadModel->getObject(), $uploadModel->getPath(), $options);

        if ($uploadModel->isUseCallback()) {
            $body = $data['body'];

            if (empty($body)) {
                throw new Exception('Use `callback` but the response body is empty,Please check callback:' . json_encode($this->config->getCallback()));
            }

            if (substr($body, 0, 5) == '<?xml') {
                list('Code' => $code, 'Message' => $msg) = Xml::getInstance()->decode($body);

                if ($code === 'CallbackFailed') {

                    throw new Exception('Callback Failed Message:' . $msg . ' ' . $body);
                }
            }

            return $body;
        }

        return true;
    }

    /**
     * object是否存在
     * @param $object
     * @return bool
     */
    public function existObject($object): bool
    {
        return $this->client->doesObjectExist($this->config->getBucket(), $object);
    }

    /**
     * 删除object
     * @param $object
     * @return bool
     */
    public function delObject($object): bool
    {
        $this->client->deleteObject($this->config->getBucket(), $object);

        return true;
    }

    /**
     * 获取对象授权url
     * @param $object
     * @param int $expires
     * @param array|null $options
     * @return string
     * @throws OssException
     */
    public function getObjectSignUrl($object, int $expires = 60, ?array $options = null): string
    {
        $this->handlerOptions($options);

        return $this->client->signUrl($this->config->getBucket(), $object, $expires, OssClient::OSS_HTTP_GET, $options);
    }

    /**
     * 获取对象内容
     * @param $object
     * @param array|null $options
     * @return string
     */
    public function getObject($object, ?array $options = null): string
    {
        $this->handlerOptions($options);

        return $this->client->getObject($this->config->getBucket(), $object, $options);
    }
}
