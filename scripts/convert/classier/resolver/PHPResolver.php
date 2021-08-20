<?php

namespace script\convert\classier\resolver;

use Exception;
use Generator;
use rapidPHP\modules\common\classier\File;
use rapidPHP\modules\common\classier\Path;
use rapidPHP\modules\reflection\classier\Classify;
use rapidPHP\modules\reflection\classier\Utils;
use ReflectionException;
use script\convert\classier\model\PropertyModel;

class PHPResolver implements IResolver
{

    /**
     * instance
     * @param $paths
     * @return Generator
     * @throws Exception
     */
    public static function getInstance($paths)
    {
        if (empty($paths)) throw new Exception('path empty');

        foreach ($paths as $path) {
            $inputPath = $path;

            if (is_file($path)) {
                $files = [$path];

                $inputPath = dirname($path);
            } else {
                $files = File::getInstance()->readDirFiles($path, File::OPTIONS_SUBDIRECTORY);
            }

            foreach ($files as $file) {

                $className = Utils::getInstance()->getClassFullNameByFile($file);

                $classify = Classify::getInstance($className);

                yield new static($classify, $inputPath);
            }
        }
    }

    /**
     * @var Classify
     */
    protected $classify;

    /**
     * @var string
     */
    protected $path;

    /**
     * PHPResolver constructor.
     * @param $classify
     * @param string $path
     */
    public function __construct($classify, string $path)
    {
        $this->classify = $classify;

        $this->path = rtrim(Path::getInstance()->formatPath($path), '/*') . '/';
    }

    /**
     * 格式化class name
     * @param string $className
     * @return string
     */
    private function formatClassName(string $className): string
    {
        return ltrim($className, '\\');
    }

    /**
     * diff name
     * @return string
     */
    public function getDiffPath(): string
    {
        return str_replace($this->path, '', dirname($this->getFilename()) . '/');
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->classify->getFileName();
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->formatClassName($this->classify->getName());
    }

    /**
     * @return string
     */
    public function getShortName(): string
    {
        return $this->classify->getReflectionClass()->getShortName();
    }

    /**
     * parent short name
     * @return array|null
     */
    public function getExtendsNames(): ?array
    {
        $classify = $this->classify->getReflectionClass()->getParentClass();

        if (!$classify) return null;

        return [$this->formatClassName($classify->getName()) => $classify->getShortName()];
    }

    /**
     * @return array|null
     */
    public function getImplementsNames(): ?array
    {
        $classify = $this->classify->getReflectionClass();

        if (!$classify) return null;

        $result = [];

        $interfaces = $classify->getInterfaces();

        foreach ($interfaces as $class) {
            $result[$this->formatClassName($class->getName())] = $class->getShortName();
        }

        return $result;
    }

    /**
     * comment
     * @return string
     */
    public function getComment(): string
    {
        return $this->classify->getDocComment()->getDoc();
    }

    /**
     * 获取常量
     * @return PropertyModel[]
     * @throws Exception
     */
    public function getConstants(): array
    {
        $result = [];

        $constants = $this->classify->getReflectionClass()->getReflectionConstants();

        foreach ($constants as $constant) {

            $className = $constant->getDeclaringClass()->getName();

            if ($className !== $this->classify->getName()) {
                continue;
            }

            $property = new PropertyModel();

            $property->setClassName($this->formatClassName($className));

            $property->setName($constant->getName());

            $property->setType(gettype($constant->getValue()));

            $property->setOptions(PropertyModel::OPTIONS_CONST);

            $property->setDefault($constant->getValue());

            $property->setComment($constant->getDocComment());

            $result[] = $property;
        }

        return $result;
    }

    /**
     * 获取属性
     * @return PropertyModel[]
     * @throws ReflectionException
     * @throws Exception
     */
    public function getProperties(): array
    {
        $result = [];

        $instance = $this->classify
            ->getReflectionClass()
            ->newInstanceWithoutConstructor();

        $attributes = $this->classify->getProperties();

        foreach ($attributes as $attribute) {

            $className = $attribute->getDeclaringClass()->getName();

            if ($className !== $this->classify->getName()) {
                continue;
            }

            $property = new PropertyModel();

            $property->setClassName($this->formatClassName($className));

            $property->setName($attribute->getName());

            try {
                $property->setType($attribute->getType());

                if (in_array('null', $attribute->getTypeToArray())) {
                    $property->setOptions(PropertyModel::OPTIONS_ALLOW_NULL);
                }
            } catch (Exception $e) {
            }

            if ($attribute->getProperty()->isStatic()) {
                $property->setOptions($property->getOptions() | PropertyModel::OPTIONS_STATIC);
            }

            $property->setDefault($attribute->getValue($instance));

            $property->setComment($attribute->getDocComment()->getDoc());

            $result[] = $property;
        }

        return $result;
    }
}
