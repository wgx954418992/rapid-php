<?php

namespace rapidPHP\modules\common\classier;

class Language
{

    /**
     * 语言包映射路径
     * @var array
     */
    protected static $map = [];

    /**
     * 语言包
     * @var array
     */
    protected static $languages = [];

    /**
     * 添加语言包映射路径
     * @param $path
     */
    public static function addMap($path)
    {
        if (!is_dir($path)) return;

        $readFile = File::getInstance()->readDirFiles($path, File::OPTIONS_SUBDIRECTORY);

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
    protected static function loadLanguage($lang): array
    {
        if (isset(self::$languages[$lang])) return self::$languages[$lang];

        $files = self::$map[$lang] ?? null;

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
     * @param array|null $arg
     * @return string|string[]|null
     */
    public static function translate($word, $lang, ?array $arg = [])
    {
        $language = self::loadLanguage($lang);

        $value = $language[$word] ?? $word;

        if (!empty($arg)) {
            foreach ($arg as $name => $item) {
                $value = str_replace("{{$name}}", $item, $value);
            }
        }

        return preg_replace('#{(.*)}#i', '', $value);
    }
}
