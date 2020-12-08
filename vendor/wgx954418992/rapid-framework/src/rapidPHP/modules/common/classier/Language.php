<?php

namespace rapidPHP\modules\common\classier;

class Language
{

    /**
     * 语言包映射路径
     * @var array
     */
    private static $map = [];

    /**
     * 语言包
     * @var array
     */
    private static $languages = [];

    /**
     * 添加语言包映射路径
     * @param $path
     */
    public static function addMap($path)
    {
        if (!is_dir($path)) return;

        $readFile = File::getInstance()->readDirFiles($path);

        foreach ($readFile as $file) {
            $filename = basename($file, '.php');

            if (!isset(self::$map[$filename])) self::$map[$filename] = [];

            self::$map[$filename][] = $file;
        }
    }

    /**
     * 载入语言包
     * @param $lang
     * @return mixed
     */
    private static function loadLanguage($lang)
    {
        if (isset(self::$languages[$lang])) return self::$languages[$lang];

        $files = isset(self::$map[$lang]) ? self::$map[$lang] : null;

        if (empty($files)) return [];

        foreach ($files as $file) {
            $language = (array)include($file . '');

            if (!isset(self::$languages[$lang])) self::$languages[$lang] = [];

            self::$languages[$lang] = array_merge(self::$languages[$lang], $language);
        }

        return self::$languages[$lang];
    }

    /**
     * 转换，翻译
     * @param $word
     * @param $lang
     * @param mixed ...$arg
     * @return mixed|string|string[]
     */
    public static function translate($word, $lang, $arg = [])
    {
        $language = self::loadLanguage($lang);

        $value = isset($language[$word]) ? $language[$word] : $word;

        if (is_array($arg) && !empty($arg)) {
            foreach ($arg as $name => $item) {
                $value = str_replace("{{$name}}", $item, $value);
            }
        }

        $value = preg_replace('#{(.*)}#i', '', $value);

        return $value;
    }
}