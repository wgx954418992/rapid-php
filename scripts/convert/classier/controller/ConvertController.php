<?php

namespace script\convert\classier\controller;

use Exception;
use rapidPHP\modules\configure\classier\Configurator;
use rapidPHP\modules\core\classier\console\ConsoleController;
use ReflectionException;
use script\convert\classier\config\JavaHandlerConfig;
use script\convert\classier\config\SwiftHandlerConfig;
use script\convert\classier\enum\HandlerType;
use script\convert\classier\enum\ResolverType;
use script\convert\classier\service\ConvertService;

class ConvertController extends ConsoleController
{

    /**
     * 转java model
     * @route /java
     * @throws Exception
     */
    public function java($key)
    {
        $handlerConfig = JavaHandlerConfig::getInstance(Configurator::getInstance()->getValue($key));

        $result = ConvertService::getInstance()
            ->run(
                ResolverType::i(ResolverType::PHP),
                HandlerType::i(HandlerType::JAVA),
                $handlerConfig
            );

        foreach ($result as $value) {
            $this->psuccess("{$value} 转换完成");
        }

        $this->psuccess("java 转换完成");
    }

    /**
     * 转swift model
     * @route /swift
     * @param $key
     * @throws ReflectionException
     * @throws Exception
     */
    public function swift($key)
    {
        $handlerConfig = SwiftHandlerConfig::getInstance(Configurator::getInstance()->getValue($key));

        $result = ConvertService::getInstance()
            ->run(
                ResolverType::i(ResolverType::PHP),
                HandlerType::i(HandlerType::SWIFT),
                $handlerConfig
            );

        foreach ($result as $value) {
            $this->psuccess("{$value} 转换完成");
        }

        $this->psuccess("swift 转换完成");
    }
}
