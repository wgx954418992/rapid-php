<?php


namespace rapidPHP\modules\common\classier;


class Path
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
    public function dirName($path, int $count = 1): string
    {
        $path = dirname($path, $count);

        return $path == '' || $path == DIRECTORY_SEPARATOR ? '/' : "{$path}/";
    }

    /**
     * 获取路径信息
     * @param string $path
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
