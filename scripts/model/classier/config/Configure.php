<?php

namespace script\model\classier\config;


use Exception;
use rapidPHP\modules\application\classier\Application;
use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\configure\classier\reflection\DocComment;
use rapidPHP\modules\reflection\classier\Classify;
use function rapidPHP\AR;

trait Configure
{

    /**
     * 单例模式
     */
    use Instances;

    /**
     * 初始化当前
     * @return static
     * @throws Exception
     */
    public static function onNotInstance(array $data)
    {
        $static = new static();

        $classify = Classify::getInstance($static);

        $properties = $classify->getProperties();

        foreach ($properties as $property) {
            /** @var DocComment $comment */
            $comment = $property->getDocComment(DocComment::class);

            $config = $comment->getConfigAnnotation();

            if ($config != null) {
                $value = AR()->value($data, $config->getName());

                $property->setValue($value, $static);
            }
        }

        return $static;
    }
}
