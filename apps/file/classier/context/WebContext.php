<?php

namespace apps\file\classier\context;

use apps\file\classier\config\FileConfig;
use apps\file\classier\config\oss\AliYunConfig;
use apps\file\classier\config\OSSConfig;
use apps\file\classier\interceptor\AdminUploadInterceptor;
use apps\file\classier\interceptor\AppUploadInterceptor;
use apps\file\classier\service\file\LocalFileManagerService;
use apps\file\classier\service\IFileManagerService;
use apps\file\classier\service\file\OssFileManagerService;
use apps\oss\classier\service\IOssService;
use Exception;
use oss\classier\config\IAliYunConfig;
use oss\classier\service\impl\AliYunOssService;
use rapidPHP\modules\application\classier\context\WebContext as BaseWebContext;
use rapidPHP\modules\router\classier\Router;
use rapidPHP\modules\server\classier\interfaces\Request;
use rapidPHP\modules\server\classier\interfaces\Response;
use function rapidPHP\DI;

class WebContext extends BaseWebContext
{

    /**
     * WebContext constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);

        parent::supportsParameter([
            WebContext::class => $this,
            UserContext::class => null,
        ]);

        $this->injection();

        $this->addInterceptor(new AdminUploadInterceptor($this));

        $this->addInterceptor(new AppUploadInterceptor($this));
    }

    /**
     * @param Router $router
     */
    public function onMatchingBefore(Router $router)
    {
        $headers = [
            'Content-type: text/html; charset=utf-8',
            'Access-Control-Allow-Credentials: true',
        ];

        if ($this->request->header('Origin')) {
            $headers[] = "Access-Control-Allow-Origin: {$this->request->header('Origin')}";
        }

        if ($this->request->header('Access-Control-Request-Method')) {
            $headers[] = "Access-Control-Allow-Methods: {$this->request->header('Access-Control-Request-Method')}";
        }

        if ($this->request->header('Access-Control-Request-Headers')) {
            $headers[] = "Access-Control-Allow-Headers: {$this->request->header('Access-Control-Request-Headers')}";
        }

        $this->response->setHeader($headers);

        if ($this->request->getMethod() === 'OPTIONS') {
            $this->response->end();
        }
    }


    /**
     * injection
     */
    private function injection()
    {
        DI([
            IAliYunConfig::class => function () {
                return AliYunConfig::getInstance();
            },

            IOssService::class => function () {
                $service = OSSConfig::getInstance()->getService();

                switch ($service) {
                    case 'aliyun':
                        return  new AliYunOssService(DI(IAliYunConfig::class));
                    default:
                        throw new Exception('oss service error!');
                }
            },

            IFileManagerService::class => function () {
                $service = FileConfig::getInstance()->getService();

                switch ($service) {
                    case 'oss':
                        return OssFileManagerService::getInstance();
                    case 'local':
                        return LocalFileManagerService::getInstance();
                    default:
                        throw new Exception('file service error!');
                }
            },
        ]);
    }

}
