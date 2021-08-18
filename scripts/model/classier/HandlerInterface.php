<?php

namespace script\model\classier;


use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Instances;

abstract class HandlerInterface
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
     * 获取文件后缀
     * @return string
     */
    abstract public function getExt(): string;

    /**
     * onReceive
     * @param Table $table
     * @param $columns
     * @param array|null $options
     * @return string
     */
    abstract public function onReceive(Table $table, $columns, ?array $options = []): string;

    /**
     * 解析变量
     * @param string $content
     * @param array $defined
     * @return array|mixed|string|string[]|void
     */
    protected function parseVariable(string $content, array $defined): string
    {
        $vars = Build::getInstance()->getRegularAll('/\${(.*?)}/i', $content);

        if (empty($vars)) return $content;

        foreach ($vars as $var) {

            $value = $defined[$var] ?? '';

            $content = str_replace("\${{$var}}", $value, $content);
        }

        return $content;
    }
}
