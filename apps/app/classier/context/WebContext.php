<?php

namespace apps\app\classier\context;


use apps\app\classier\interceptor\CodeEmailInterceptor;
use apps\app\classier\interceptor\CodeSMSInterceptor;
use apps\core\classier\config\BaseConfig;
use apps\core\classier\config\email\SmtpConfig;
use apps\core\classier\config\EmailConfig;
use apps\core\classier\config\sms\AliYunConfig;
use apps\core\classier\config\sms\TCloudConfig;
use apps\core\classier\config\SMSConfig;
use apps\core\classier\helper\CommonHelper;
use apps\core\classier\sender\email\IEmailSender;
use apps\core\classier\sender\email\impl\SmtpSender;
use apps\core\classier\sender\email\ISmtpConfig;
use apps\core\classier\sender\sms\IAliYunConfig as SMSIAliYunConfig;
use apps\core\classier\sender\sms\impl\AliYunSender;
use apps\core\classier\sender\sms\impl\TCloudSender;
use apps\core\classier\sender\sms\ISMSSender;
use apps\core\classier\sender\sms\ITCloudConfig;
use apps\file\classier\config\FileConfig;
use apps\file\classier\config\oss\AliYunConfig as OSSAliYunConfig;
use apps\file\classier\config\OSSConfig;
use apps\file\classier\service\file\LocalFileManagerService;
use apps\file\classier\service\file\OssFileManagerService;
use apps\file\classier\service\IFileManagerService;
use apps\oss\classier\service\IOssService;
use Exception;
use oss\classier\config\IAliYunConfig as OSSIAliYunConfig;
use oss\classier\service\impl\AliYunOssService;
use rapidPHP\modules\application\classier\context\WebContext as BaseWebContext;
use rapidPHP\modules\server\classier\interfaces\Request;
use rapidPHP\modules\server\classier\interfaces\Response;
use function rapidPHP\DI;

class WebContext extends BaseWebContext
{

    /**
     * @var UserContext
     */
    private $userContext = null;

    /**
     * @var int|string
     */
    protected $decodeOptions = self::OPTIONS_DECODE_REALPATH | self::OPTIONS_DECODE_REQUEST_GET | self::OPTIONS_DECODE_REQUEST_POST;

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
            UserContext::class => [$this, 'getUserContext'],
        ]);

        $this->addInterceptor(new CodeSMSInterceptor($this));

        $this->addInterceptor(new CodeEmailInterceptor($this));

        $this->injection();
    }

    /**
     * 获取UserContext
     * @return UserContext
     * @throws Exception
     */
    public function getUserContext()
    {
        if (!is_null($this->userContext)) return $this->userContext;

        return $this->userContext = new UserContext($this);
    }

    /**
     * AESDecrypt
     * @param $value
     */
    private function AESDecrypt(&$value)
    {
        $decode = CommonHelper::AESDecrypt(str_replace([':', ';'], ['/', '+'], $value), BaseConfig::ENCRYPT_KEY);

        if ($decode !== false) $value = $decode;
    }

    /**
     * 全局统一解码
     * @param $value
     */
    public function decode(&$value)
    {
        if ($this->request->header('Data-Encode') != 'ENCODE-' . (md5("AES-128-ECB"))) return;

        if (is_array($value)) {
            foreach ($value as &$item) {
                $this->decode($item);
            }
        } else if (is_string($value)) {
            $this->AESDecrypt($value);
        }
    }


    /**
     * injection
     */
    private function injection()
    {
        DI([
            /********* SMS IOC - Start *************/
            SMSIAliYunConfig::class => function () {
                return AliYunConfig::getInstance();
            },

            ITCloudConfig::class => function () {
                return TCloudConfig::getInstance();
            },

            ISMSSender::class => function () {
                $service = SMSConfig::getInstance()->getService();

                switch ($service) {
                    case 'aliyun':
                        $service = AliYunSender::class;
                        break;
                    case 'tcloud':
                        $service = TCloudSender::class;
                        break;
                }

                return DI($service);
            },

            AliYunSender::class => function () {
                return new AliYunSender(DI(SMSIAliYunConfig::class));
            },

            TCloudSender::class => function () {
                return new TCloudSender(DI(ITCloudConfig::class));
            },

            /********* SMS IOC - End *************/


            /********* Email IOC - Start *************/
            ISmtpConfig::class => function () {
                return SmtpConfig::getInstance();
            },

            IEmailSender::class => function () {
                $service = EmailConfig::getInstance()->getService();

                switch ($service) {
                    case 'smtp':
                        $service = SmtpSender::class;
                        break;
                }

                return DI($service);
            },

            SmtpSender::class => function () {
                return new SmtpSender(DI(ISmtpConfig::class));
            },

            /********* Email IOC - End *************/

            OSSIAliYunConfig::class => function () {
                return OSSAliYunConfig::getInstance();
            },

            IOssService::class => function () {
                $service = OSSConfig::getInstance()->getService();

                switch ($service) {
                    case 'aliyun':
                        return new AliYunOssService(DI(OSSIAliYunConfig::class));
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
