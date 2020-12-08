<?php


namespace rapidPHP\modules\common\classier;


class Path
{
    /**
     * @var Path
     */
    private static $instance;

    /**
     * @return Path
     */
    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }

    /**
     * 格式化路径
     * @param $path
     * @return string
     */
    public function formatPath($path): string
    {
        return str_replace('\\', '/', $path);
    }

    /**
     * 目录后退，可指定后退次数
     * @param $path
     * @param int $count
     * @return string
     */
    public function dirName($path, $count = 1)
    {
        $count = (int)$count;

        while ($count > 0) {
            $count--;

            $path = dirname($path);
        }

        return $path == '' || $path == DIRECTORY_SEPARATOR ? '/' : "{$path}/";
    }

    /**
     * 获取路径信息
     * @param $path
     * @return array
     */
    public function getPathInfo(string $path): array
    {
        $info = explode('/', $this->formatPath($path));

        $filename = str_replace('?', '\?', end($info));

        $filenameInfo = explode('.', $filename);

        return [
            'dir' => str_replace($filename, '', $path),

            'filename' => $filename,

            'prefix' => Build::getInstance()->getData(pathinfo($path), 'filename'),

            'suffix' => count($filenameInfo) == 1 ? null : end($filenameInfo)
        ];
    }
}