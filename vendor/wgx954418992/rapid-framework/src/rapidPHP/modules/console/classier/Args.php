<?php

namespace rapidPHP\modules\console\classier;

use rapidPHP\modules\common\classier\Instances;

class Args
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
        global $argv;

        return new static($argv);
    }

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var array
     */
    protected $args = [];

    /**
     * CommandArgs constructor.
     * @param $argv
     */
    public function __construct($argv)
    {
        if(is_null($argv)) $argv = [];

        $index = 1;

        $length = count($argv);

        while ($index < $length) {

            $curVal = $argv[$index];

            if (($key = $this->isShortOptions($curVal)) || ($key = $this->isLongOptions($curVal))) {
                $index++;

                if (isset($argv[$index]) && $this->isArg($argv[$index])) {
                    $this->options[$key] = $argv[$index];
                } else {
                    $this->options[$key] = true;

                    $index--;
                }
            } else if (($key = $this->isShortOptionsWithValue($curVal))
                || ($key = $this->isLongOptionsWithValue($curVal))) {

                $this->options[$key[0]] = $key[1];
            } else if ($this->isArg($curVal)) {
                $this->args[] = $curVal;
            }

            $index++;
        }

    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }


    /**
     * @return array
     */
    public function getArgs(): array
    {
        return $this->args;
    }


    /**
     * 获取选项值
     * @param int|string|null $opt
     * @return array|string|NULL
     */
    public function getOptionValue($opt = NULL)
    {
        if (is_null($opt)) {
            return $this->options;
        } else if (isset($this->options[$opt])) {
            return $this->options[$opt];
        }

        return null;
    }

    /**
     * 获取命令行参数值
     * @param integer|null|string $index
     * @return array|string|NULL
     */
    public function getArgsValue($index = NULL)
    {
        if (is_null($index)) {
            return $this->args;
        } else if (isset($this->args[$index])) {
            return $this->args[$index];
        }

        return null;
    }

    /**
     * 是否是 -s 形式的短选项
     * @param string $opt
     * @return string|boolean 返回短选项名
     */
    public function isShortOptions(string $opt)
    {
        if (preg_match('/^\-([a-zA-Z0-9])$/', $opt, $matches)) {
            return $matches[1];
        }

        return false;
    }

    /**
     * 是否是 -svalue 形式的短选项
     * @param string $opt
     * @return array|boolean 返回短选项名以及选项值
     */
    public function isShortOptionsWithValue(string $opt)
    {
        if (preg_match('/^\-([a-zA-Z0-9])(\S+)$/', $opt, $matches)) {
            return [$matches[1], $matches[2]];
        }

        return false;
    }

    /**
     * 是否是 --longopts 形式的长选项
     * @param string $opt
     * @return string|boolean 返回长选项名
     */
    public function isLongOptions(string $opt)
    {
        if (preg_match('/^\-\-([a-zA-Z0-9\-_]{2,})$/', $opt, $matches)) {
            return $matches[1];
        }
        return false;
    }

    /**
     * 是否是 --longopts=value 形式的长选项
     * @param string $opt
     * @return array|boolean 返回长选项名及选项值
     */
    public function isLongOptionsWithValue(string $opt)
    {
        if (preg_match('/^\-\-([a-zA-Z0-9\-_]{2,})(?:\=(.*?))$/', $opt, $matches)) {
            return [$matches[1], $matches[2]];
        }
        return false;
    }

    /**
     * 是否是命令行参数
     * @param string $value
     * @return boolean
     */
    public function isArg(string $value): bool
    {
        return !preg_match('/^\-/', $value);
    }
}
