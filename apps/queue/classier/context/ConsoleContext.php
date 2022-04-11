<?php

namespace apps\queue\classier\context;


use apps\file\classier\config\oss\aliyun\Config;
use apps\file\classier\service\file\OssFileManagerService;
use apps\file\classier\service\IFileManagerService;
use apps\oss\classier\service\IOssService;
use oss\classier\service\impl\AliYunOssService;
use rapidPHP\modules\application\classier\context\ConsoleContext as BaseConsoleContext;
use rapidPHP\modules\console\classier\Input;
use rapidPHP\modules\console\classier\Output;
use function rapidPHP\DI;

class ConsoleContext extends BaseConsoleContext
{

    /**
     * ConsoleContext constructor.
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
            IOssService::class => function () {
                return new AliYunOssService(Config::getInstance());
            },
            IFileManagerService::class => function () {
                return OssFileManagerService::getInstance();
            },
        ]);
    }

}
