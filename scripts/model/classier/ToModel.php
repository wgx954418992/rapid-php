<?php

namespace script\model\classier;

use Exception;
use Generator;
use rapidPHP\Init;
use rapidPHP\modules\common\classier\AB;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\File;
use rapidPHP\modules\common\classier\StrCharacter;
use rapidPHP\modules\common\config\VarConfig;
use script\model\classier\handler\JavaHandler;
use script\model\classier\handler\PHPHandler;
use script\model\classier\handler\SwiftHandler;
use script\model\classier\service\SQLDBService;


class ToModel
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
     * @var self
     */
    private static $instance;

    /**
     * @return self
     */
    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }

    /**
     * @param $type
     * @return HandlerInterface
     * @throws Exception
     */
    public function getHandler(string $type)
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
     * @param $path
     * @param HandlerInterface $handler
     * @return ServiceInterface
     * @throws Exception
     */
    public function getService(string $type, $path, HandlerInterface $handler)
    {
        if (isset($this->services[$type])) {

            $service = $this->services[$type];

            return call_user_func([$service, 'getInstance'], $path, $handler);
        }

        throw new Exception('service type error');
    }

    /**
     * 通过appFile获取config对象
     * @param $path
     * @return Generator
     */
    public function getConfig($path)
    {
        $read = File::getInstance()->readDirFiles($path);

        foreach ($read as $file) {
            $ext = pathinfo($file, PATHINFO_EXTENSION);

            if ($ext !== 'yaml') continue;

            try {
                $init = new Init($file);

                $config = $init->getRawConfig();

                VarConfig::parseVarByArray($config);

                yield $file => AB::getInstance($config);
            } catch (Exception $e) {

            }
        }
    }

    /**
     * run
     * @param $path
     * @param $serviceType
     * @param $handlerType
     * @throws Exception
     */
    public function run($path, $serviceType = self::SERVER_SQL, $handlerType = self::HANDLER_PHP)
    {
        if (empty($path)) throw new Exception('path error!');

        if (empty($serviceType)) throw new Exception('service error!');

        if (empty($handlerType)) throw new Exception('handler error!');

        $handler = $this->getHandler($handlerType);

        $generator = $this->getService($serviceType, $path, $handler);

        /** @var ServiceInterface $service */
        foreach ($generator as $service) {

            $types = $service->getTypes();

            foreach ($types as $type => $typeName) {

                $tables = $service->getTables($type);

                if (!$tables) continue;

                $sql = [];

                /** @var Table $table */
                foreach ($tables as $table) {

                    $columns = $service->getTableColumn($type, $table->getName());

                    array_push($sql, $service->getTableCreateCommand($type, $table->getName()));

                    $content = $service->getModelContent($table, $columns);

                    $uTableName = StrCharacter::getInstance()->toFirstUppercase($table->getName(), '_');

                    $this->write($service->getWritePath(), "{$uTableName}Model" . $handler->getExt(), $content);
                }

                $randId = md5($service->getRandId());

                $this->write($service->getWritePath(), ".{$randId}_$typeName.sql", join(";\n\n", $sql));

                echo "{$typeName}编译完成\n";
            }
        }

        echo "任务完成\n";
    }

    /**
     * write
     * @param $path
     * @param $fileName
     * @param $data
     * @throws Exception
     */
    public function write($path, $fileName, $data)
    {
        if (!is_dir($path)) if (!mkdir($path, 0777, true)) throw new Exception('mkdir error!');

        $path = rtrim($path, '/*');

        $filepath = "{$path}/{$fileName}";

        $file = fopen($filepath, 'w+');

        fwrite($file, $data);

        fclose($file);
    }

    /**
     * @param $event
     * @throws Exception
     */
    public static function console($event)
    {
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');

        require $vendorDir . '/autoload.php' . '';

        $baseDir = dirname($vendorDir);

        $argv = Build::getInstance()->getData($_SERVER, 'argv');

        $path = Build::getInstance()->contrast(Build::getInstance()->getData($argv, 6), 'apps');

        $service = Build::getInstance()->contrast(Build::getInstance()->getData($argv, 5), self::SERVER_SQL);

        $handler = Build::getInstance()->contrast(Build::getInstance()->getData($argv, 4), self::HANDLER_PHP);

        (new self)->run($baseDir . '/' . $path, $service, $handler);
    }
}
