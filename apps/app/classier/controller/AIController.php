<?php

namespace apps\app\classier\controller;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use apps\app\classier\context\UserContext;
use apps\app\classier\service\BaseService;
use apps\core\classier\config\speech\AliYunConfig;
use apps\core\classier\enum\ErrorCode;
use apps\core\classier\enum\setting\attribute\point\IntegralRule;
use apps\core\classier\service\IntegralService;
use apps\core\classier\service\ocr\BaiduService;
use apps\file\classier\service\IFileManagerService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use ReflectionException;
use function rapidPHP\AR;
use function rapidPHP\DI;

/**
 * AIController
 * @route /ai
 */
class AIController extends BaseController
{

    /**
     * 获取阿里云speech token
     * @route /speech/aliyun/token
     * @method get
     * @return RESTFulApi
     * @throws ClientException
     * @throws ServerException
     * @throws Exception
     */
    public function getAliYunSpeechToken()
    {
        $config = AliYunConfig::getInstance();

        AlibabaCloud::accessKeyClient($config->getAccessKeyId(), $config->getAccessKeySecret())
            ->regionId('cn-shanghai')
            ->name('speech-client');

        $response = AlibabaCloud::nlsCloudMeta()
            ->V20180518()
            ->createToken()
            ->client('speech-client')
            ->request();

        if (!$response->isSuccess()) throw new Exception('获取token失败');

        $token = AR()->value($response->toArray(), 'Token.Id');

        if (empty($token)) throw new Exception('获取token失败(E)');

        return RESTFulApi::success([
            'token' => $token,
            'app_key' => $config->getAppKey(),
            'wss' => $config->getWss(),
        ]);
    }

    /**
     * 获取ocr识别结果
     * @route /ocr/handler
     * @method get
     * @return RESTFulApi
     * @throws ClientException
     * @throws ServerException
     * @throws Exception
     */
    public function getOcrResult($fileId, $method)
    {
        /** @var IFileManagerService $fileManagerService */
        $fileManagerService = DI(IFileManagerService::class);

        $fileModel = $fileManagerService->getFile($fileId);

        $result = BaiduService::getInstance()
            ->getOcrResult($fileModel->getPath(), $method);

        return RESTFulApi::success($result);
    }

    /**
     * 扣除积分
     * @route /deduct/integral
     * @method post
     * @param UserContext $context
     * @param $type
     * @return RESTFulApi
     * @throws ReflectionException
     * @throws Exception
     */
    public function deductIntegral(UserContext $context, $type)
    {
        $userModel = $context->getCurrentUser();

        BaseService::getInstance()->validaUserModel($userModel);

        IntegralService::setPointByIU(
            $userModel->getId(),
            IntegralRule::i($type),
            function (IntegralService $integralService, ?int $point) {
                if (is_null($point)) return;

                if ($integralService->getPoint()->getNumber() < abs($point)) {
                    throw new Exception('您的积分不够，请充值后进行操作');
                }
            }
        );

        return RESTFulApi::success();
    }
}
