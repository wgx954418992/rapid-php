<?php


namespace rapidPHP\modules\reflection\classier;

use enum\classier\Enum;
use Exception;
use rapidPHP\modules\common\classier\AB;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\File;
use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\common\classier\Variable;
use rapidPHP\modules\core\classier\Model;
use rapidPHP\modules\options\classier\Options;


class Utils
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
     * 格式化className
     * @param $className
     * @return string
     */
    public function formatClassName($className): string
    {
        return str_replace('/', '\\', ltrim($className, '/*'));
    }

    /**
     * 获取文件内容里面的命名空间，只能支持单个
     * @param string|null $content
     * @return mixed|null
     */
    public function getNamespaceName(?string $content)
    {
        return Build::getInstance()->getRegular('/namespace (.*?);/i', $content);
    }

    /**
     * 获取文件内容里面的className，只能支持单个
     * @param string|null $content
     * @return mixed|null
     */
    public function getClassName(?string $content)
    {
        return Build::getInstance()->getRegular('/class (\w+)/i', $content);
    }

    /**
     * 获取文件内容里面的命名空间+className，只能支持单个
     * @param string|null $content
     * @return string|null
     */
    public function getClassFullName(?string $content): ?string
    {
        $namespaceName = $this->getNamespaceName($content);

        $className = $this->getClassName($content);

        if (empty($className)) return null;

        return $namespaceName . '\\' . $className;
    }

    /**
     * 获取文件里面的命名空间+className，只能支持单个
     * @param string $file
     * @return string|null
     */
    public function getClassFullNameByFile(string $file): ?string
    {
        if (!is_file($file)) return null;

        return $this->getClassFullName(File::getInstance()->getContent($file));
    }

    /**
     * 通过data获取参数的value
     * @param Parameter $parameter
     * @param $data -参数必须是key=>value形式，不能按照顺序传参
     * @return mixed|void|null
     */
    public function getParamValue(Parameter $parameter, $data)
    {
        $name = $parameter->getName();

        $defaultValue = $parameter->getDefaultValue();

        if (is_array($data) && array_key_exists($name, $data)) {
            $value = $data[$name];
        } else if (is_object($data)) {
            if ($data instanceof AB && $data->hasName($name)) {
                $value = $data->toValue($name);
            } else if (isset($data->$name)) {
                $value = $data->$name;
            }
        }

        return $value ?? $defaultValue;
    }

    /**
     * 通过data生成方法参数
     * @param Method $method
     * @param $data -参数必须是key=>value形式，不能按照顺序传参
     * @return array
     * @throws Exception
     */
    public function makeMethodParameters(Method $method, $data): array
    {
        $parameters = $method->getParameters();

        $result = [];

        foreach ($parameters as $parameter) {
            $value = $this->getParamValue($parameter, $data);

            $type = $parameter->getType();

            if (empty($type)) {
                /** type 没有限制，直接传入 **/
                $result[] = $value;
            } else if (Variable::isSetType($type)) {
                /** type 限制为基本类型 **/
                if ($value === null && $parameter->getParameter()->allowsNull()) {
                    $result[] = null;
                } else {
                    Variable::setType($value, $type);

                    $result[] = $value;
                }
            } else {
                /** type 这时候type不是空也不是基本类型，那就是object类型 **/

                if ($value === null) {
                    if ($parameter->getParameter()->allowsNull()) {
                        $result[] = null;
                    } else {
                        $result[] = $this->toObject($type, $value);
                    }
                } else if (Variable::isSetType($value)) {
                    $result[] = $this->toObject($type, $value);
                } else {
                    if (is_object($value) && get_class($value) === $type) {
                        $result[] = $value;
                    } else if (is_subclass_of($value, $type)) {
                        $result[] = $value;
                    } else {
                        $result[] = $this->toObject($type, $value);
                    }
                }
            }
        }

        return $result;
    }

    /**
     * 转对象，支持对象关联对象
     * @template T
     * @param $object
     * @param object|array|null|AB $data -参数必须是key=>value形式，不能按照顺序传参
     * @return object|void|T|null
     * @throws Exception
     */
    public function toObject($object, $data = null)
    {
        if (is_null($object)) return null;

        if (!is_object($object) && !is_string($object)) return null;

        if (is_subclass_of($object, Enum::class) ||
            is_subclass_of($object, Options::class)) {

            return call_user_func_array("{$object}::i", $data === null ? [] : (is_array($data) ? $data : [$data]));
        }

        if (empty($data)) {
            $data = [];
        } else if (!is_array($data) && !is_object($data)) {
            $data = [$data];
        }

        $classify = Classify::getInstance($object);

        if (is_string($object)) $object = $classify->newInstanceKV($data);

        $setterMethods = $classify->getSetterMethods();

        foreach ($setterMethods as $method) {

            $parameters = $this->makeMethodParameters($method, $data);

            if ($method->getMethod()->isPrivate() ||
                $method->getMethod()->isProtected()) {
                $method->getMethod()->setAccessible(true);
            }

            $method->getMethod()->invokeArgs($object, $parameters);
        }

        return $object;
    }

    /**
     * 批量转对象
     * @param $object
     * @param object|array|null|AB $data
     * @throws Exception
     */
    public function toObjects($object, &$data = [])
    {
        foreach ($data as $key => $datum) {
            $data[$key] = $this->toObject($object, $datum);
        }
    }

    /**
     * 对象转数组
     * @param $object
     * @param $filter
     * @return array|null
     * @throws Exception
     */
    public function toArray($object, $filter = null): ?array
    {
        if (is_array($object)) {
            foreach ($object as &$datum) {
                if (is_array($datum) || is_object($datum)) {
                    $datum = $this->toArray($datum);
                }
            }

            return $object;
        }

        if (!is_object($object)) return null;

        $classify = Classify::getInstance($object);

        $properties = $classify->getProperties($filter);

        $result = [];

        foreach ($properties as $property) {

            $name = $property->getName();

            $value = $property->getValue($object);

            if (is_array($value)) {
                foreach ($value as $index => $item) {
                    if (is_object($item)) {
                        $value[$index] = $this->toArray($item);
                    }
                }
            } else if (is_object($value)) {
                if ($value instanceof Options) {
                    $value = $value->getValue();
                } else if ($value instanceof Enum) {
                    $value = $value->getRawValue();
                } else {
                    $value = $this->toArray($value);
                }
            }

            $result[$name] = $value;
        }

        return $result;
    }


    /**
     * 查找type 的class
     * @param $type
     * @param Classify|null $classify
     * @return mixed|string|null
     */
    public function findTypeClass($type, ?Classify $classify): ?string
    {
        if (empty($type)) {
            return null;
        } else if (Variable::isSetType($type)) {
            return $type;
        } else if ($type === Variable::MIXED) {
            return $type;
        } else {
            try {
                return Classify::getInstance($type)->getName();
            } catch (Exception $e) {
                $importPackages = $classify->getImportPackage();

                if (isset($importPackages[$type])) {
                    return $importPackages[$type];
                } else {
                    try {
                        return Classify::getInstance($classify->getNamespaceName() . '\\' . $type)->getName();
                    } catch (Exception $e) {
                        return $type;
                    }
                }
            }
        }
    }
}
