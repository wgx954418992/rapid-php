<?php


namespace script\model\classier\helper;


use Exception;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\File;

class CommonHelper
{


    /**
     * 解析变量
     * @param string $content
     * @param array $defined
     * @return array|mixed|string|string[]|void
     */
    public static function parseVariable(string $content, array $defined): string
    {
        $vars = Build::getInstance()->getRegularAll('/\#{(.*?)}/i', $content);

        if (empty($vars)) return $content;

        foreach ($vars as $var) {

            $value = $defined[$var] ?? '';

            $content = str_replace("#{{$var}}", $value, $content);
        }

        return $content;
    }

    /**
     * write
     * @param $filename
     * @param $data
     * @return bool
     * @throws Exception
     */
    public static function writeFile($filename, $data): bool
    {
        if (!is_dir(dirname($filename))) if (!mkdir(dirname($filename), 0777, true)) throw new Exception('mkdir error!');

        return File::getInstance()->write($filename, $data);
    }
}
