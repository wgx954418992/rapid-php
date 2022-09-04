<?php

namespace rapidPHP\modules\console\classier;

use Exception;
use rapidPHP\modules\common\classier\Instances;

class Utils
{

    /**
     * 字体颜色 black
     */
    const FOREGROUND_COLOR_BLACK = 'black';

    /**
     * 字体颜色 dark_gray
     */
    const FOREGROUND_COLOR_DARK_GRAY = 'dark_gray';

    /**
     * 字体颜色 blue
     */
    const FOREGROUND_COLOR_BLUE = 'blue';

    /**
     * 字体颜色 light_blue
     */
    const FOREGROUND_COLOR_LIGHT_BLUE = 'light_blue';

    /**
     * 字体颜色 green
     */
    const FOREGROUND_COLOR_GREEN = 'green';

    /**
     * 字体颜色 light_green
     */
    const FOREGROUND_COLOR_LIGHT_GREEN = 'light_green';

    /**
     * 字体颜色 cyan
     */
    const FOREGROUND_COLOR_CYAN = 'cyan';

    /**
     * 字体颜色 light_cyan
     */
    const FOREGROUND_COLOR_LIGHT_CYAN = 'light_cyan';

    /**
     * 字体颜色 red
     */
    const FOREGROUND_COLOR_RED = 'red';

    /**
     * 字体颜色 light_red
     */
    const FOREGROUND_COLOR_LIGHT_RED = 'light_red';

    /**
     * 字体颜色 purple
     */
    const FOREGROUND_COLOR_PURPLE = 'purple';

    /**
     * 字体颜色 light_purple
     */
    const FOREGROUND_COLOR_LIGHT_PURPLE = 'light_purple';

    /**
     * 字体颜色 brown
     */
    const FOREGROUND_COLOR_BROWN = 'brown';

    /**
     * 字体颜色 yellow
     */
    const FOREGROUND_COLOR_YELLOW = 'yellow';

    /**
     * 字体颜色 light_gray
     */
    const FOREGROUND_COLOR_LIGHT_GRAY = 'light_gray';

    /**
     * 字体颜色 white
     */
    const FOREGROUND_COLOR_WHITE = 'white';

    /**
     * 背景颜色 black
     */
    const BACKGROUND_COLOR_BLACK = 'black';

    /**
     * 背景颜色 red
     */
    const BACKGROUND_COLOR_RED = 'red';

    /**
     * 背景颜色 green
     */
    const BACKGROUND_COLOR_GREEN = 'green';

    /**
     * 背景颜色 yellow
     */
    const BACKGROUND_COLOR_YELLOW = 'yellow';

    /**
     * 背景颜色 blue
     */
    const BACKGROUND_COLOR_BLUE = 'blue';

    /**
     * 背景颜色 magenta
     */
    const BACKGROUND_COLOR_MAGENTA = 'magenta';

    /**
     * 背景颜色 cyan
     */
    const BACKGROUND_COLOR_CYAN = 'cyan';

    /**
     * 背景颜色 light_gray
     */
    const BACKGROUND_COLOR_LIGHT_GRAY = 'light_gray';

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
     * 字体颜色
     * @var string[]
     */
    private $foregroundColors = [
        self::FOREGROUND_COLOR_BLACK => '0;30',
        self::FOREGROUND_COLOR_DARK_GRAY => '1;30',
        self::FOREGROUND_COLOR_BLUE => '0;34',
        self::FOREGROUND_COLOR_LIGHT_BLUE => '1;34',
        self::FOREGROUND_COLOR_GREEN => '0;32',
        self::FOREGROUND_COLOR_LIGHT_GREEN => '1;32',
        self::FOREGROUND_COLOR_CYAN => '0;36',
        self::FOREGROUND_COLOR_LIGHT_CYAN => '1;36',
        self::FOREGROUND_COLOR_RED => '0;31',
        self::FOREGROUND_COLOR_LIGHT_RED => '1;31',
        self::FOREGROUND_COLOR_PURPLE => '0;35',
        self::FOREGROUND_COLOR_LIGHT_PURPLE => '1;35',
        self::FOREGROUND_COLOR_BROWN => '0;33',
        self::FOREGROUND_COLOR_YELLOW => '1;33',
        self::FOREGROUND_COLOR_LIGHT_GRAY => '0;37',
        self::FOREGROUND_COLOR_WHITE => '1;37',
    ];

    /**
     * 背景颜色
     * @var string[]
     */
    private $backgroundColors = [
        self::BACKGROUND_COLOR_BLACK => '40',
        self::BACKGROUND_COLOR_RED => '41',
        self::BACKGROUND_COLOR_GREEN => '42',
        self::BACKGROUND_COLOR_YELLOW => '43',
        self::BACKGROUND_COLOR_BLUE => '44',
        self::BACKGROUND_COLOR_MAGENTA => '45',
        self::BACKGROUND_COLOR_CYAN => '46',
        self::BACKGROUND_COLOR_LIGHT_GRAY => '47',
    ];

    /**
     * 获取带颜色的字体代码
     * @param $string
     * @param $foregroundColor
     * @param $backgroundColor
     * @return string
     */
    public function getColoredString($string, $foregroundColor = null, $backgroundColor = null): string
    {
        $coloredString = "";

        if (isset($this->foregroundColors[$foregroundColor])) {
            $coloredString .= "\033[" . $this->foregroundColors[$foregroundColor] . "m";
        }

        if (isset($this->backgroundColors[$backgroundColor])) {
            $coloredString .= "\033[" . $this->backgroundColors[$backgroundColor] . "m";
        }

        $coloredString .= $string . "\033[0m";

        return $coloredString;
    }

    /**
     * 线程调用脚本
     * @param $bin
     * @param $param
     * @param int $sleep
     * @return bool
     * @throws Exception
     */
    public function threadExec($bin, $param, int $sleep = 1): bool
    {
        if (!function_exists('exec')) throw new Exception('exec 方法不存在!');

        if (!function_exists('popen')) throw new Exception('popen 方法不存在!');

        if (!is_file($bin)) {
            exec('type -P ' . $bin, $out);

            $bin = array_key_exists(0, $out) ? $out[0] : null;
        }

        if (!is_file($bin)) throw new Exception($bin . ' 文件不存在!');

        $paramString = '';

        foreach ($param as $name => $value) {
            if (empty($value) && empty($name)) continue;

            if (is_string($name)) {
                $paramString .= " {$name} '{$value}'";
            } else {
                $paramString .= " '{$value}'";
            }
        }

        pclose(popen("{$bin} {$paramString}&", "r"));

        sleep($sleep);

        return true;
    }

    /**
     * 线程调用脚本
     * @param $bin
     * @param $script
     * @param array $param
     * @param int $sleep
     * @return bool
     * @throws Exception
     */
    public function threadExecScript($bin, $script = null, array $param = [], int $sleep = 1): bool
    {
        if (!is_file($script)) $script = PATH_ROOT . DIRECTORY_SEPARATOR . $script;

        if (!is_file($script)) throw new Exception('脚本不存在!');

        if (!is_null($script)) array_unshift($param, $script);

        return $this->threadExec($bin, $param, $sleep);
    }
}
