<?php

namespace rapidPHP\modules\configure\classier;

use Exception;
use rapidPHP\modules\application\config\ApplicationConfig;
use rapidPHP\modules\common\classier\AR;
use rapidPHP\modules\common\classier\File;
use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\common\classier\Variable;
use rapidPHP\modules\configure\classier\loader\JsonLoader;
use rapidPHP\modules\configure\classier\loader\PHPLoader;
use rapidPHP\modules\configure\classier\loader\XmlLoader;
use rapidPHP\modules\configure\classier\loader\YamlLoader;
use rapidPHP\modules\configure\classier\reflection\DocComment;
use rapidPHP\modules\reflection\classier\Classify;
use function rapidPHP\AR;

class Configurator implements IConfigurator
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
     * config
     * @var array
     */
    protected $config = [];

    /**
     * observers
     * @var callable[]
     */
    protected $observers = [];

    /**
     * config path
     * @var string[]
     */
    protected $paths = [
        PATH_APP . 'application.yaml'
    ];

    /**
     * Config constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->config = ApplicationConfig::getDefaultConfig();

        Variable::parseVarByArray($this->config);
    }

    /**
     * observer
     * @param callable $callback
     * @return Configurator
     */
    public function observer(callable $callback)
    {
        $this->observers[] = $callback;

        return $this;
    }

    /**
     * set paths
     * @param array $paths
     * @return Configurator
     */
    public function setPaths(array $paths)
    {
        $this->paths = $paths;

        return $this;
    }

    /**
     * 追加path
     * @param string $path
     * @return Configurator
     */
    public function addPath(string $path)
    {
        $this->paths[] = $path;

        return $this;
    }

    /**
     * paths
     * @return string[]
     */
    public function getPaths(): array
    {
        return $this->paths;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }


    /**
     * 获取config value 里面的值
     * 支持 a.b.c.e
     * @param $name
     * @return array|mixed|null
     */
    public function getValue($name)
    {
        return AR()->value($this->config, $name);
    }

    /**
     * set object properties
     * @param $object
     * @throws Exception
     */
    public function setProperties($object)
    {
        $classify = Classify::getInstance($object);

        $properties = $classify->getProperties();

        foreach ($properties as $property) {
            /** @var DocComment $comment */
            $comment = $property->getDocComment(DocComment::class);

            $config = $comment->getConfigAnnotation();

            if ($config != null) {
                $value = $this->getValue($config->getName());

                $property->setValue($value, $object);
            }
        }
    }

    /**
     * 获取loader
     * @param string $filename
     * @return ILoader|null
     */
    public function getLoader(string $filename): ?ILoader
    {
        /** @var ILoader[] $loaders */
        $loaders = [JsonLoader::getInstance(), PHPLoader::getInstance(), XmlLoader::getInstance(), YamlLoader::getInstance()];

        foreach ($loaders as $loader) {
            if ($loader->isSupport($filename)) return $loader;
        }

        return null;
    }

    /**
     * 载入配置文件
     * @param bool $isAppend
     * @return Configurator
     * @throws Exception
     */
    public function load(bool $isAppend = true)
    {
        if (!$isAppend) {
            $this->config = ApplicationConfig::getDefaultConfig();

            Variable::parseVarByArray($this->config);
        }

        foreach ($this->paths as $path) {

            if (is_dir($path)) {
                $files = File::getInstance()->readDirFiles($path, File::OPTIONS_NONE);
            } else {
                $files = [$path];
            }

            foreach ($files as $filename) {

                $loader = $this->getLoader($filename);

                if (!$loader) continue;

                $config = $loader->load($filename);

                Variable::parseVarByArray($config);

                AR::getInstance()->merge($this->config, $config);
            }
        }

        foreach ($this->observers as $observer) {
            if (is_callable($observer)) call_user_func($observer);
        }

        return $this;
    }
}
