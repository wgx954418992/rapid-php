<?php


namespace oss\classier\service\impl;


use apps\oss\classier\service\IOssService;
use BaiduBce\Auth\SignOptions;
use BaiduBce\Exception\BceServiceException;
use BaiduBce\Services\Bos\BosClient;
use BaiduBce\Services\Bos\BosOptions;
use DateTime;
use Exception;
use oss\classier\config\IBaiduConfig;
use oss\classier\model\UploadModel;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Http;
use rapidPHP\modules\common\classier\Xml;
use function rapidPHP\B;

class BaiduBOSService extends IOssService
{

    /**
     * OSS RENAMES
     */
    const OSS_RENAMES = [
        self::OSS_PROCESS => BosOptions::BCE_PROCESS,
//        self::OSS_CALLBACK => BosOptions::OSS_CALLBACK,
//        self::OSS_CALLBACK_VAR => BosOptions::OSS_CALLBACK_VAR,
    ];

    /**
     * client
     * @var BOSClient
     */
    protected $client;

    /**
     * config
     * @var IBaiduConfig
     */
    protected $config;

    /**
     * @param IBaiduConfig $config
     * @throws Exception
     */
    public function __construct(IBaiduConfig $config)
    {
        if (!class_exists(\BaiduBce\Services\Bos\BosClient::class)) {
            throw new Exception('Biadu Bos Client Not Found，run `composer require wgx954418992/php-baidubce`');
        }

        $this->config = $config;

        $this->client = new BOSClient([
            'credentials' => [
                'accessKeyId' => $config->getAccessKey(),
                'secretAccessKey' => $config->getSecretKey(),
            ],
            'endpoint' => $config->getEndpoint(),
        ]);
    }

    /**
     * 上传文件
     * @param UploadModel $uploadModel
     * @return null|bool|string
     * @throws Exception
     */
    public function uploadFile(UploadModel $uploadModel)
    {
        $options = [
            BosOptions::CONTENT_TYPE => $uploadModel->getMime(),
        ];

        $options = array_merge($options, $uploadModel->getOptions());

        $this->handlerOptions($options);

        $data = (array)$this->client->putObjectFromFile(
            $this->config->getBucket(),
            $uploadModel->getObject(),
            $uploadModel->getPath(),
            $options
        );

        if ($uploadModel->isUseCallback() && !empty($this->config->getCallback())) {
            try {
                list('callbackUrl' => $callbackUrl, 'callbackBody' => $callbackBody) = $this->config->getCallback();

                $vars = (array)Build::getInstance()->getRegularAll('/\${(.*?)}/i', $callbackBody);

                $defined = [
                    'bucket' => $this->config->getBucket(),
                    'object' => $uploadModel->getObject(),
                    'etag' => $data['metadata']['etag'],
                    'mimeType' => $uploadModel->getMime(),
                    'size' => $uploadModel->getSize(),
                ];

                foreach ($vars as $var) {
                    $value = $defined[$var] ?? null;

                    $callbackBody = str_replace("\${{$var}}", $value, $callbackBody);
                }

                $body = Http::getInstance()
                    ->getHttpResponse($callbackUrl, $callbackBody);

                if (empty($body)) {
                    throw new Exception('Use `callback` but the response body is empty,Please check callback:' . json_encode($this->config->getCallback()));
                }

                if (B()->isJson($body)) return $body;

                throw new Exception('Use `callback` error,data type is not json type:' . $body);

            } catch (Exception $e) {
                try {
                    $this->delObject($uploadModel->getObject());
                } catch (Exception $delE) {

                }

                throw $e;
            }
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
        try {
            $this->client->getObjectMetadata($this->config->getBucket(), $object);
        } catch (BceServiceException $e) {
            return $e->getStatusCode() != 404;
        }

        return true;
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
     */
    public function getObjectSignUrl($object, int $expires = 60, ?array $options = null): string
    {
        if (is_null($options)) $options = [];

        if (!isset($options[BosOptions::SIGN_OPTIONS])) {
            $options[BosOptions::SIGN_OPTIONS] = [
                SignOptions::TIMESTAMP => new DateTime(),
                SignOptions::EXPIRATION_IN_SECONDS => $expires
            ];
        }

        $this->handlerOptions($options);

        return $this->client->generatePreSignedUrl($this->config->getBucket(), $object, $options);
    }

    /**
     * 获取对象内容
     * @param $object
     * @param array|null $options
     * @return string
     * @throws Exception
     */
    public function getObject($object, ?array $options = null): string
    {
        $this->handlerOptions($options);

        return $this->client->getObjectAsString($this->config->getBucket(), $object, $options);
    }
}
