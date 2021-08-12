<?php

namespace rapidPHP\modules\config\classier;

use Exception;
use rapidPHP\modules\application\config\ApplicationConfig;
use rapidPHP\modules\common\classier\File;
use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\common\classier\Variable;
use rapidPHP\modules\config\classier\loader\JsonLoader;
use rapidPHP\modules\config\classier\loader\PHPLoader;
use rapidPHP\modules\config\classier\loader\XmlLoader;
use rapidPHP\modules\config\classier\loader\YamlLoader;
use rapidPHP\modules\reflection\classier\Classify;
use function rapidPHP\AR;

class Config
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
     * config path
     * @var string[]
     */
    protected $paths = [
    ];

    /**
     * set paths
     * @param array $paths
     */
    public function setPaths(array $paths)
    {
        $this->paths = $paths;
    }

    /**
     * 追加path
     * @param string $path
     */
    public function appendPath(string $path)
    {
        $this->paths[] = $path;
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
     * Config constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->config = ApplicationConfig::getDefaultConfig();
    }

    /**
     * 获取loader
     * @param string $filename
     * @return ILoader|null
     */
    protected function getLoader(string $filename): ?ILoader
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
     * @throws Exception
     */
    public function load(bool $isAppend = true)
    {
        if (!$isAppend) {
            $this->config = ApplicationConfig::getDefaultConfig();
        }

        foreach ($this->paths as $path) {

            if (is_dir($path)) {
                $files = File::getInstance()->readDirFiles($path, false, false);
            } else {
                $files = [$path];
            }

            foreach ($files as $filename) {
                $loader = $this->getLoader($filename);

                if (!$loader) continue;

                $config = $loader->load($filename);

                Variable::parseVarByArray($config);

                $this->config = array_merge($this->config, $config);
            }
        }
    }

    /**
     * 获取config value 里面的值
     * 支持 a.b.c.e
     * @param $name
     * @return array|mixed|null
     */
    public function value($name)
    {
        return AR()->value($this->config, $name);
    }

    /**
     * set object properties
     * @param $object
     * @throws Exception
     */
    public static function object($object)
    {
        $classify = Classify::getInstance($object);

        $properties = $classify->getProperties();

        foreach ($properties as $property) {
            /** @var DocComment $comment */
            $comment = $property->getDocComment(DocComment::class);

            $config = $comment->getConfigAnnotation();

            if ($config != null) {
                $value = Config::getInstance()->value($config->getName());

                $property->setValue($value, $object);
            }
        }
    }
}
