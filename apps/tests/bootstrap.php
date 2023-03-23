<?php

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
use apps\file\classier\config\oss\BaiduConfig as OSSBaiduConfig;
use apps\file\classier\config\OSSConfig;
use apps\file\classier\service\file\LocalFileManagerService;
use apps\file\classier\service\file\OssFileManagerService;
use apps\file\classier\service\IFileManagerService;
use apps\oss\classier\service\IOssService;
use oss\classier\config\IAliYunConfig as OSSIAliYunConfig;
use oss\classier\config\IBaiduConfig as OSSIBaiduConfig;
use oss\classier\service\impl\AliYunOssService;
use oss\classier\service\impl\BaiduBOSService;
use rapidPHP\modules\application\classier\apps\CGIApplication;
use rapidPHP\modules\configure\classier\Configurator;
use function rapidPHP\DI;

define('ENV_NAME', !empty(get_cfg_var('env.name')) ? get_cfg_var('env.name') : 'dev');

define('PATH_APP', str_replace('\\', '/', __DIR__) . '/');

define('PATH_PUBLIC', PATH_APP);

require dirname(dirname(__DIR__)) . '/vendor/autoload.php' . '';
require dirname(dirname(__DIR__)) . '/vendor/wgx954418992/rapid-framework/src/rapidPHP/init.php' . '';

$app = new CGIApplication(Configurator::getInstance());

$app->getConfig()
    ->setPaths([
        PATH_ROOT . 'apps/core/application.yaml',
        PATH_ROOT . 'apps/core/config/' . ENV_NAME,
        PATH_ROOT . 'apps/app/application.yaml'
    ])
    ->load();


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

    OSSIBaiduConfig::class => function () {
        return OSSBaiduConfig::getInstance();
    },

    IOssService::class => function () {
        $service = OSSConfig::getInstance()->getService();

        switch ($service) {
            case 'aliyun':
                return new AliYunOssService(DI(OSSIAliYunConfig::class));
            case 'baidu':
                return new BaiduBOSService(DI(OSSIBaiduConfig::class));
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
