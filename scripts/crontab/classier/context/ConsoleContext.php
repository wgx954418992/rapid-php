<?php

namespace script\crontab\classier\context;

use apps\core\classier\config\email\SmtpConfig;
use apps\core\classier\config\EmailConfig;
use apps\core\classier\config\sms\AliYunConfig;
use apps\core\classier\config\sms\TCloudConfig;
use apps\core\classier\config\SMSConfig;
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
use apps\file\classier\service\IFileManagerService;
use apps\file\classier\service\file\OssFileManagerService;
use apps\oss\classier\service\IOssService;
use Exception;
use oss\classier\config\IAliYunConfig as OSSIAliYunConfig;
use oss\classier\service\impl\AliYunOssService;
use rapidPHP\modules\application\classier\context\ConsoleContext as BaseConsoleContext;
use rapidPHP\modules\console\classier\Input;
use rapidPHP\modules\console\classier\Output;
use function rapidPHP\DI;

class ConsoleContext extends BaseConsoleContext
{

    /**
     * @param Input $input
     * @param Output $output
     */
    public function __construct(Input $input, Output $output)
    {
        parent::__construct($input, $output);

        parent::supportsParameter([
            ConsoleContext::class => $this,
        ]);

        $this->injection();
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
