<?php

namespace script\convert\classier\controller;

use Exception;
use rapidPHP\modules\common\classier\File;
use rapidPHP\modules\common\classier\StrCharacter;
use rapidPHP\modules\core\classier\console\ConsoleController;
use rapidPHP\modules\reflection\classier\Classify;
use rapidPHP\modules\reflection\classier\Utils as ReflectionUtils;
use script\convert\classier\AnalysisInterface;
use script\convert\classier\converter\JavaConverter;
use script\convert\classier\converter\SwiftConverter;
use script\convert\classier\ConverterInterface;
use script\convert\classier\service\PHPAnalysis;
use script\model\classier\HandlerInterface;
use script\model\classier\ServiceInterface;

class ConverterController extends ConsoleController
{

    /**
     * 转换者 java
     */
    const CONVERTER_JAVA = 'java';

    /**
     * 转换者 swift
     */
    const CONVERTER_SWIFT = 'swift';

    /**
     * 解析 service
     */
    const SERVER_PHP = 'php';

    /**
     * @var ConverterInterface[]
     */
    private $CONVERTERS = [
        self::CONVERTER_JAVA => JavaConverter::class,
        self::CONVERTER_SWIFT => SwiftConverter::class,
    ];

    /**
     * @var AnalysisInterface[]
     */
    private $services = [
        self::SERVER_PHP => PHPAnalysis::class,
    ];

    /**
     * @param string $type
     * @return ConverterInterface
     * @throws Exception
     */
    public function getConverter(string $type): ConverterInterface
    {
        if (isset($this->CONVERTERS[$type])) {

            $handler = $this->CONVERTERS[$type];

            return call_user_func([$handler, 'getInstance']);
        }

        throw new Exception('converter type error');
    }

    /**
     * 获取服务接口
     * @param string $type
     * @return AnalysisInterface
     * @throws Exception
     */
    public function getService(string $type)
    {
        if (!isset($this->services[$type])) throw new Exception('service type error');

        return call_user_func([$this->services[$type], 'getInstance']);
    }

    /**
     * write
     * @param $fileName
     * @param $data
     * @throws Exception
     */
    public function writeFile($fileName, $data)
    {
        $path = pathinfo($fileName, PATHINFO_DIRNAME);

        if (!is_dir($path)) if (!mkdir($path, 0777, true)) throw new Exception('mkdir error!');

        $file = fopen($fileName, 'w+');

        fwrite($file, $data);

        fclose($file);
    }

    /**
     * 没有
     * @param $paths
     * @param string $serviceType
     * @param string $converter
     * @param string $savePath
     * @param string $namespace
     * @param array|null $options
     * @throws Exception
     */
    public function run($paths,
                        $serviceType = self::SERVER_PHP,
                        $converter = self::CONVERTER_JAVA,
                        $savePath = PATH_APP . 'model/',
                        $namespace = 'apps\\app\model',
                        ?array $options = []
    )
    {
        if (empty($paths)) throw new Exception('paths error!');

        if (empty($serviceType)) throw new Exception('service error!');

        if (empty($converter)) throw new Exception('converter error!');

        if (empty($savePath)) throw new Exception('savePath error!');

        $converter = $this->getConverter($converter);

        $service = $this->getService($serviceType);

        foreach ($paths as $path) {
            $files = File::getInstance()->readDirFiles($path);

            foreach ($files as $file) {

                $className = ReflectionUtils::getInstance()->getClassFullNameByFile($file);

                $classify = Classify::getInstance($className);

                $properties = $service->getProperties($file);

                if ($parentClassify = $classify->getParentClassify()) {
                    $options['extends'] = $parentClassify->getName();
                }

                $content = $converter->onConvert($properties, $className, $classify->getDocComment()->getDoc(), $namespace, $options);

                $diffPath = str_replace($path, '', $file);

                $filename = $savePath . $diffPath;

                $this->writeFile(str_replace('.' . pathinfo($filename, PATHINFO_EXTENSION), $converter->getExt(), $filename), $content);

                $this->psuccess("{$file}转换完成");
            }
        }
    }


    /**
     * wrapper转swift
     * @route wrapper/swift
     */
    public function wrapperToSwift()
    {
        $this->run(
            [
                PATH_ROOT . 'apps/core/classier/wrapper/',
            ],
            self::SERVER_PHP,
            self::CONVERTER_SWIFT,
            PATH_ROOT . 'convert/swift/wrapper/',
            null,
            [
                'extends' => 'BaseModel',
                'imports' => [
                    'Foundation'
                ]
            ]
        );

        $this->psuccess("wrapper 转 swift 完成");
    }

    /**
     * bean转swift
     * @route bean/swift
     */
    public function beanToSwift()
    {
        $this->run(
            [
                PATH_ROOT . 'apps/core/classier/bean/',
            ],
            self::SERVER_PHP,
            self::CONVERTER_SWIFT,
            PATH_ROOT . 'convert/swift/bean/',
            null,
            [
                'extends' => 'BaseModel',
                'imports' => [
                    'Foundation'
                ]
            ]
        );

        $this->psuccess("bean 转 swift 完成");
    }

}