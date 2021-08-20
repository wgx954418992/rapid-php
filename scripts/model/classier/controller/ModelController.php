<?php

namespace script\model\classier\controller;

use Exception;
use rapidPHP\modules\configure\classier\Configurator;
use rapidPHP\modules\core\classier\console\ConsoleController;
use ReflectionException;
use script\model\classier\config\JavaHandlerConfig;
use script\model\classier\config\PHPHandlerConfig;
use script\model\classier\config\SwiftHandlerConfig;
use script\model\classier\enum\HandlerType;
use script\model\classier\enum\ResolverType;
use script\model\classier\service\ConvertService;

class ModelController extends ConsoleController
{

    /**
     * 转php model
     * @route /php
     * @param $key
     * @throws ReflectionException
     * @throws Exception
     */
    public function php($key)
    {
        $handlerConfig = PHPHandlerConfig::getInstance(Configurator::getInstance()->getValue($key));

        $result = ConvertService::getInstance()
            ->run(Configurator::getInstance(),
                ResolverType::i(ResolverType::SQL),
                HandlerType::i(HandlerType::PHP),
                $handlerConfig
            );

        foreach ($result as $value) {
            $this->psuccess("{$value} 编译完成");
        }

        $this->psuccess("php model 编译完成");
    }

    /**
     * 转java model
     * @route /java
     * @param $key
     * @throws ReflectionException
     * @throws Exception
     */
    public function java($key)
    {
        $handlerConfig = JavaHandlerConfig::getInstance(Configurator::getInstance()->getValue($key));

        $result = ConvertService::getInstance()
            ->run(Configurator::getInstance(),
                ResolverType::i(ResolverType::SQL),
                HandlerType::i(HandlerType::JAVA),
                $handlerConfig
            );

        foreach ($result as $value) {
            $this->psuccess("{$value} 编译完成");
        }

        $this->psuccess("java model 编译完成");
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
            ->run(Configurator::getInstance(),
                ResolverType::i(ResolverType::SQL),
                HandlerType::i(HandlerType::SWIFT),
                $handlerConfig
            );

        foreach ($result as $value) {
            $this->psuccess("{$value} 编译完成");
        }

        $this->psuccess("swift model 编译完成");
    }
}
