<?php

namespace apps\openapi\classier;

use Exception;
use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\reflection\classier\Method;
use rapidPHP\modules\router\classier\DocComment;
use rapidPHP\modules\server\config\HttpConfig;
use function rapidPHP\B;

class Utils
{

    /**
     * 单例模式
     */
    use Instances;

    /**
     * on not instance
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * 获取参数
     * @param Method $method
     * @return array
     * @throws Exception
     */
    public function getParameters(Method $method): array
    {
        $result = [];

        $parameters = $method->getParameters();

        foreach ($parameters as $parameter) {
            $name = $parameter->getName();

            $type = $parameter->getType();

            $actionParameter = new Parameter();

            $actionParameter->setName($name);

            $actionParameter->setType($type);

            $actionParameter->setIsAllowNull($parameter->getParameter()->allowsNull());

            $actionParameter->setIsDefaultValue($parameter->getParameter()->isDefaultValueAvailable());

            $parameterAnnotation = $parameter->getAnnotation();

            if ($parameterAnnotation != null) {
                $actionParameter->setSource($parameterAnnotation->getSource());

                $actionParameter->setRemark($parameterAnnotation->getRemark());
            }

            $result[$name] = $actionParameter;
        }

        return $result;
    }

    /**
     * 获取请求方法
     * @param Method $method
     * @return string
     * @throws Exception
     */
    public function getRequestMethod(Method $method): string
    {
        /** @var DocComment $methodComment */
        $methodComment = $method->getDocComment(DocComment::class);

        $requestMethod = strtolower($methodComment->getMethodAnnotation());

        if (empty($requestMethod) || $requestMethod == '*') {
            $requestMethod = HttpConfig::METHOD_GET;
        } else {
            $requestMethod = B()->getData(explode(',', $requestMethod), 0);
        }

        return strtolower($requestMethod);
    }
}