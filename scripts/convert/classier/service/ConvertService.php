<?php

namespace script\convert\classier\service;

use Exception;
use Generator;
use rapidPHP\modules\common\classier\Instances;
use script\convert\classier\config\IHandlerConfig;
use script\convert\classier\enum\HandlerType;
use script\convert\classier\enum\ResolverType;
use script\convert\classier\handler\JavaIHandler;
use script\convert\classier\handler\SwiftIHandler;
use script\convert\classier\handler\IHandler;
use script\convert\classier\helper\CommonHelper;
use script\convert\classier\resolver\IResolver;
use script\convert\classier\resolver\PHPResolver;


class ConvertService
{


    /**
     * 单例模式
     */
    use Instances;

    /**
     * 初始化当前
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * @var IHandler[]
     */
    protected $handlers = [
        HandlerType::JAVA => JavaIHandler::class,
        HandlerType::SWIFT => SwiftIHandler::class,
    ];

    /**
     * @var IResolver[]
     */
    protected $resolvers = [
        ResolverType::PHP => PHPResolver::class,
    ];

    /**
     * 获取执行者
     * @param HandlerType $handlerType
     * @return IHandler
     * @throws Exception
     */
    public function getHandler(HandlerType $handlerType): IHandler
    {
        if (isset($this->handlers[$handlerType->getRawValue()])) {

            $handler = $this->handlers[$handlerType->getRawValue()];

            return call_user_func([$handler, 'getInstance']);
        }

        throw new Exception('handler type error');
    }

    /**
     * 获取解析者
     * @param $paths
     * @param ResolverType $resolverType
     * @return IResolver[]
     * @throws Exception
     */
    public function getResolvers($paths, ResolverType $resolverType)
    {
        if (!isset($this->resolvers[$resolverType->getRawValue()])) {
            throw new Exception('resolver type type error');
        }

        $resolver = $this->resolvers[$resolverType->getRawValue()];

        return call_user_func([$resolver, 'getInstance'], $paths);
    }

    /**
     * run
     * @param ResolverType $resolverType
     * @param HandlerType $handlerType
     * @param IHandlerConfig $config
     * @return Generator
     * @throws Exception
     */
    public function run(ResolverType $resolverType, HandlerType $handlerType, IHandlerConfig $config)
    {
        $savePath = $config->getOutput();

        if (empty($savePath)) throw new Exception('savePath error!');

        $paths = $config->getInput();

        $handler = $this->getHandler($handlerType);

        $resolvers = $this->getResolvers($paths, $resolverType);

        foreach ($resolvers as $resolver) {

            $diffPath = $resolver->getDiffPath();

            $className = $resolver->getClassName();

            $shortName = $resolver->getShortName();

            $constants = $resolver->getConstants();

            $properties = $resolver->getProperties();

            $attributes = array_merge($constants, $properties);

            $defined = [
                'diffPath' => $diffPath,
                'className' => $className,
                'shortName' => $shortName,
                'comment' => $resolver->getComment(),
                'extendsNames' => $resolver->getExtendsNames(),
                'implementsNames' => $resolver->getImplementsNames(),
            ];

            $content = $handler->onHandler($config, $attributes, $defined);

            $outputFilepath = CommonHelper::parseVariable($savePath, $defined);

            CommonHelper::writeFile($outputFilepath, $content);

            yield $resolver->getClassName();
        }
    }

}
