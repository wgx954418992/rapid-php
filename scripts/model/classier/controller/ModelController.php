<?php

namespace script\model\classier\controller;

use Exception;
use rapidPHP\modules\common\classier\StrCharacter;
use rapidPHP\modules\configure\classier\Configurator;
use rapidPHP\modules\configure\classier\IConfigurator;
use rapidPHP\modules\core\classier\console\ConsoleController;
use script\model\classier\handler\JavaHandler;
use script\model\classier\handler\PHPHandler;
use script\model\classier\handler\SwiftHandler;
use script\model\classier\HandlerInterface;
use script\model\classier\service\SQLDBService;
use script\model\classier\ServiceInterface;
use script\model\classier\Table;
use function rapidPHP\B;

class ModelController extends ConsoleController
{

    /**
     * handler view
     */
    const HANDLER_PHP = 'php';

    /**
     * handler auto
     */
    const HANDLER_JAVA = 'java';

    /**
     * handler api
     */
    const HANDLER_SWIFT = 'swift';

    /**
     * handler view
     */
    const SERVER_SQL = 'sql';

    /**
     * handler api
     */
    const SERVER_NO_SQL = 'nosql';

    /**
     * @var HandlerInterface[]
     */
    private $handlers = [
        self::HANDLER_PHP => PHPHandler::class,
        self::HANDLER_JAVA => JavaHandler::class,
        self::HANDLER_SWIFT => SwiftHandler::class,
    ];

    /**
     * @var ServiceInterface[]
     */
    private $services = [
        self::SERVER_SQL => SQLDBService::class,
    ];

    /**
     * @param string $type
     * @return HandlerInterface
     * @throws Exception
     */
    public function getHandler(string $type): HandlerInterface
    {
        if (isset($this->handlers[$type])) {

            $handler = $this->handlers[$type];

            return call_user_func([$handler, 'getInstance']);
        }

        throw new Exception('handler type error');
    }

    /**
     * 获取服务接口
     * @param string $type
     * @param IConfigurator $configurator
     * @param HandlerInterface $handler
     * @return mixed
     * @throws Exception
     */
    public function getService(string $type, IConfigurator $configurator, HandlerInterface $handler)
    {
        if (!isset($this->services[$type])) throw new Exception('service type error');

        $service = $this->services[$type];

        return call_user_func([$service, 'getInstance'], $configurator, $handler);
    }

    /**
     * write
     * @param $path
     * @param $fileName
     * @param $data
     * @throws Exception
     */
    public function writeFile($path, $fileName, $data)
    {
        if (!is_dir($path)) if (!mkdir($path, 0777, true)) throw new Exception('mkdir error!');

        $path = rtrim($path, '/*');

        $filepath = "{$path}/{$fileName}";

        $file = fopen($filepath, 'w+');

        fwrite($file, $data);

        fclose($file);
    }

    /**
     * run
     * @param IConfigurator $configurator
     * @param string $serviceType
     * @param string $handlerType
     * @param array|null $options
     * @throws Exception
     */
    public function run(IConfigurator $configurator,
                        string $serviceType = self::SERVER_SQL,
                        string $handlerType = self::HANDLER_PHP,
                        ?array $options = []
    )
    {
        if (empty($serviceType)) throw new Exception('service error!');

        if (empty($handlerType)) throw new Exception('handler error!');

        $savePath = (string)B()->getData($options, 'output');

        if (empty($savePath)) throw new Exception('savePath error!');

        $handler = $this->getHandler($handlerType);

        $services = $this->getService($serviceType, $configurator, $handler);

        /** @var ServiceInterface $service */
        foreach ($services as $service) {

            $types = $service->getTypes();

            foreach ($types as $type => $typeName) {

                $tables = $service->getTables($type);

                if (!$tables) continue;

                $sql = [];

                /** @var Table $table */
                foreach ($tables as $table) {

                    $columns = $service->getTableColumn($type, $table->getName());

                    array_push($sql, $service->getTableCreateCommand($type, $table->getName()));

                    $content = $service->getModelContent($table, $columns, $options);

                    $uTableName = StrCharacter::getInstance()->toFirstUppercase($table->getName(), '_');

                    $this->writeFile($savePath, "{$uTableName}Model" . $handler->getExt(), $content);
                }

                $randId = md5($service->getRandId());

                $this->writeFile($savePath, ".{$randId}_$typeName.sql", join(";\n\n", $sql));

                $this->psuccess("{$typeName}编译完成");
            }
        }
    }

    /**
     * 转php model
     * @route /php
     */
    public function php()
    {
        $this->run(
            Configurator::getInstance(),
            self::SERVER_SQL,
            self::HANDLER_PHP,
            Configurator::getInstance()->getValue('model.php')
        );

        $this->psuccess("php model 转换完成");
    }

    /**
     * 转java model
     * @route /java
     */
    public function java()
    {
        $this->run(
            Configurator::getInstance(),
            self::SERVER_SQL,
            self::HANDLER_JAVA,
            Configurator::getInstance()->getValue('model.java')
        );

        $this->psuccess("java model 转换完成");
    }

    /**
     * 转swift model
     * @route /swift
     */
    public function swift()
    {
        $this->run(
            Configurator::getInstance(),
            self::SERVER_SQL,
            self::HANDLER_SWIFT,
            Configurator::getInstance()->getValue('model.swift')
        );

        $this->psuccess("swift model 转换完成");
    }
}
