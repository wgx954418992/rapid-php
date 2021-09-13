<?php


namespace rapidPHP\modules\common\classier;


use rapidPHP\modules\common\config\ModulesConfig;

class Modules
{

    /**
     * 采用单例模式
     */
    use Instances;

    /**
     * 实例不存在
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * 获取modules下的子模块目录
     * @param $name
     * @param $submodule
     * @return string
     */
    public function getModulesPath($name, $submodule): string
    {
        $submodule = '/' . ltrim($submodule, '/*');

        $submodule = rtrim($submodule, '*/') . '/';

        return Path::getInstance()->formatPath(PATH_MODULES . $name . $submodule);
    }

    /**
     * 获取modules库文件目录
     * @param $name
     * @return string
     */
    public function getModulesClassierPath($name): string
    {
        return $this->getModulesPath($name, ModulesConfig::SUBMODULE_CLASSIER);
    }

    /**
     * 获取modules配置文件目录
     * @param $name
     * @return string
     */
    public function getModulesConfigPath($name): string
    {
        return $this->getModulesPath($name, ModulesConfig::SUBMODULE_CONFIG);
    }

    /**
     * 获取modules资源目录
     * @param $name
     * @return string
     */
    public function getModulesResourcePath($name): string
    {
        return $this->getModulesPath($name, ModulesConfig::SUBMODULE_RESOURCE);
    }

    /**
     * 获取modules集合包装目录
     * @param $name
     * @return string
     */
    public function getModulesWrapperPath($name): string
    {
        return $this->getModulesPath($name, ModulesConfig::SUBMODULE_WRAPPER);
    }

    /**
     * 获取模块对应文件
     * @param $name
     * @return string
     */
    public function getModulesFilePath($name)
    {
        $file = $name . (strpos($name, '.') ? '' : '.php');

        if (is_file($rootPath = Path::getInstance()->formatPath(PATH_ROOT . $file))) {
            return $rootPath;
        } else if (is_file($rapidPHPPath = Path::getInstance()->formatPath(PATH_RAPIDPHP_ROOT . $file))) {
            return $rapidPHPPath;
        } else if (is_file($modulesPath = Path::getInstance()->formatPath(PATH_MODULES . $file))) {
            return $modulesPath;
        } else if (is_file($frameworkPath = Path::getInstance()->formatPath(PATH_FRAMEWORK . $file))) {
            return $frameworkPath;
        }

        return false;
    }
}
