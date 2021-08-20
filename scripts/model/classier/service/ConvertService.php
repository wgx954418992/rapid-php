<?php

namespace script\model\classier\service;

use Exception;
use Generator;
use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\common\classier\StrCharacter;
use rapidPHP\modules\configure\classier\IConfigurator;
use script\model\classier\config\IHandlerConfig;
use script\model\classier\enum\HandlerType;
use script\model\classier\enum\ResolverType;
use script\model\classier\handler\JavaIHandler;
use script\model\classier\handler\PHPIHandler;
use script\model\classier\handler\SwiftIHandler;
use script\model\classier\helper\CommonHelper;
use script\model\classier\handler\IHandler;
use script\model\classier\resolver\IResolver;
use script\model\classier\resolver\SQLDBResolver;


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
        HandlerType::PHP => PHPIHandler::class,
        HandlerType::JAVA => JavaIHandler::class,
        HandlerType::SWIFT => SwiftIHandler::class,
    ];

    /**
     * @var IResolver[]
     */
    protected $resolvers = [
        ResolverType::SQL => SQLDBResolver::class,
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
     * @param IConfigurator $configurator
     * @param ResolverType $resolverType
     * @param IHandler $handler
     * @return IResolver[]
     * @throws Exception
     */
    public function getResolvers(IConfigurator $configurator, ResolverType $resolverType, IHandler $handler)
    {
        if (!isset($this->resolvers[$resolverType->getRawValue()])) {
            throw new Exception('resolver type type error');
        }

        $resolver = $this->resolvers[$resolverType->getRawValue()];

        return call_user_func([$resolver, 'getInstance'], $configurator, $handler);
    }

    /**
     * run
     * @param IConfigurator $configurator
     * @param ResolverType $resolverType
     * @param HandlerType $handlerType
     * @param IHandlerConfig $config
     * @return Generator
     * @throws Exception
     */
    public function run(IConfigurator $configurator, ResolverType $resolverType, HandlerType $handlerType, IHandlerConfig $config)
    {
        $handler = $this->getHandler($handlerType);

        $savePath = $config->getOutput();

        if (empty($savePath)) throw new Exception('savePath error!');

        $resolvers = $this->getResolvers($configurator, $resolverType, $handler);

        foreach ($resolvers as $resolver) {

            $types = $resolver->getTypes();

            foreach ($types as $type => $typeName) {

                $tables = $resolver->getTables($type);

                if (!$tables) continue;

                $sql = [];

                foreach ($tables as $table) {

                    $columns = $resolver->getTableColumn($type, $table->getName());

                    array_push($sql, $resolver->getTableCreateCommand($type, $table->getName()));

                    $content = $resolver->getModelContent($config, $table, $columns);

                    $UTableName = StrCharacter::getInstance()->toFirstUppercase($table->getName(), '_');

                    $outputFilepath = CommonHelper::parseVariable($savePath, ['UTableName' => $UTableName]);

                    CommonHelper::writeFile($outputFilepath, $content);
                }

                $randId = md5($resolver->getRandId());

                CommonHelper::writeFile(dirname($savePath) . "/.{$randId}_$typeName.sql", join(";\n\n", $sql));

                yield $typeName;
            }
        }
    }

}
