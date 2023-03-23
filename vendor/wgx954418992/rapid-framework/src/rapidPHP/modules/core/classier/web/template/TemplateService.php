<?php

namespace rapidPHP\modules\core\classier\web\template;

use Exception;
use rapidPHP\modules\common\classier\Path;

class TemplateService
{
    /**
     * 输出类型 文件
     */
    const OUTPUT_TYPE_FILE = 1;

    /**
     * 输出类型 content
     */
    const OUTPUT_TYPE_CONTENT = 2;

    /**
     * 后缀
     * @var array|null
     */
    public $ext;

    /**
     * 模板路径
     * @var string|null
     */
    public $template_path;

    /**
     * 缓存路径
     * @var string|null
     */
    public $cache_path;

    /**
     * TemplateService constructor.
     * @param array|null $ext
     * @param string|null $template_path
     * @param string|null $cache_path
     */
    public function __construct(?array $ext, ?string $template_path, ?string $cache_path)
    {
        $this->ext = $ext;

        $this->template_path = $template_path;

        $this->cache_path = $cache_path;
    }


    /**
     * @return array|null
     */
    public function getExt(): ?array
    {
        return $this->ext;
    }

    /**
     * @return string|null
     */
    public function getTemplatePath(): ?string
    {
        return $this->template_path;
    }

    /**
     * @return string|null
     */
    public function getCachePath(): ?string
    {
        return $this->cache_path;
    }

    /**
     * 查找该文件的模板路径
     * @param $filename
     * @param $root
     * @return string|null
     */
    public function findFilepath($filename, $root): ?string
    {
        $root = rtrim($root, '/*') . '/';

        $path = ltrim(pathinfo($filename, PATHINFO_DIRNAME), '/*');

        if (empty($path) || $path == '.') return $root;

        $path .= '/';

        if (is_dir($path)) return $path;

        if (is_dir($root . $path)) return $root . $path;

        if (is_dir(PATH_APP . $path)) return PATH_APP . $path;

        if (is_dir(PATH_ROOT . $path)) return PATH_ROOT . $path;

        return $root;
    }

    /**
     * 获取文件名后缀
     * @param $file
     * @param $filename
     * @return mixed
     */
    public function findFileSuffix($file, $filename)
    {
        $suffix = pathinfo($filename, PATHINFO_EXTENSION);

        if ($suffix) return $suffix;

        foreach ($this->ext as $ext) {
            if (is_file("{$file}.{$ext}")) return $ext;
        }

        return null;
    }

    /**
     * 查找模板文件
     * @param $filename
     * @return string
     */
    public function findTemplateFile($filename): string
    {
        if (is_file($filename)) return $filename;

        $path = $this->findFilepath($filename, $this->getTemplatePath());

        $name = pathinfo($filename, PATHINFO_FILENAME);

        $file = "{$path}{$name}";

        $ext = $this->findFileSuffix($file, $filename);

        return Path::getInstance()->formatPath($ext ? $file . '.' . $ext : $file);
    }

    /**
     * 获取缓存文件路径
     * @param $filename
     * @return string
     */
    public function findCacheFile($filename): string
    {
        $path = pathinfo($this->getCachePath() . $filename, PATHINFO_DIRNAME) . '/';

        $filename = pathinfo($filename, PATHINFO_FILENAME);

        $file = "{$path}{$filename}.php";

        return Path::getInstance()->formatPath($file);
    }

    /**
     * 添加缓存
     * @param $filename
     * @param $content
     * @param $outputType
     * @return bool|string
     * @throws Exception
     */
    public function addCache($filename, $content, &$outputType = null)
    {
        $cacheFile = $this->findCacheFile($filename);

        $cachePath = dirname($cacheFile);

        if (!is_dir($cachePath) && !mkdir($cachePath, 0777, true))
            throw new Exception('create cache dir fail!');

        if (file_put_contents($cacheFile, $content)) {
            $outputType = self::OUTPUT_TYPE_FILE;

            return $cacheFile;
        }

        return false;
    }


    /**
     * @param $filename
     * @param $outputType
     * @return string|bool
     */
    public function getCache($filename, &$outputType = null)
    {
        $filepath = $this->findTemplateFile($filename);

        if (!is_file($filepath)) return false;

        $cacheFile = $this->findCacheFile($filename);

        if (is_file($cacheFile) && (filemtime($cacheFile) >= filemtime($filepath))) {
            $outputType = self::OUTPUT_TYPE_FILE;

            return $cacheFile;
        }

        return false;
    }
}
