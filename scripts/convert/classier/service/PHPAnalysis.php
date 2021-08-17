<?php


namespace script\convert\classier\service;


use Exception;
use rapidPHP\modules\reflection\classier\Classify;
use rapidPHP\modules\reflection\classier\Utils as ReflectionUtils;
use ReflectionException;
use script\convert\classier\AnalysisInterface;
use script\convert\classier\Property;

class PHPAnalysis extends AnalysisInterface
{

    /**
     * 解析 properties
     * @param Classify $classify
     * @return array
     * @throws ReflectionException
     * @throws Exception
     */
    private function parseProperties(Classify $classify): array
    {
        $result = [];

        $instance = $classify->newInstance();

        $properties = $classify->getProperties();

        foreach ($properties as $property) {

            if ($property->getDeclaringClass()->getName() !== $classify->getName()) {
                continue;
            }

            $convertProperty = new Property();

            $convertProperty->setName($property->getName());

            try {
                $convertProperty->setType($property->getType());

                if (in_array('null', $property->getTypeToArray())) {
                    $convertProperty->setIsOption(true);
                }
            } catch (Exception $e) {
            }

            $convertProperty->setIsStatic($property->getProperty()->isStatic());

            $convertProperty->setAllowNull($property->getProperty()->isDefault());

            $convertProperty->setDoc($property->getDocComment()->getDoc());

            $convertProperty->setDefault($property->getValue($instance));

            if ($property->getProperty()->isPrivate()) {
                $convertProperty->setAccess('private');
            } else if ($property->getProperty()->isProtected()) {
                $convertProperty->setAccess('protected');
            } elseif ($property->getProperty()->isPublic()) {
                $convertProperty->setAccess('public');
            }

            $result[] = $convertProperty;
        }

        return $result;
    }

    public function parseConst(Classify $classify)
    {
        $result = [];

        $constants = $classify->getReflectionClass()->getConstants();

        foreach ($constants as $name => $value) {
            $convertProperty = new Property();

            $convertProperty->setName($name);

            $convertProperty->setType(gettype($value));

            $convertProperty->setIsConst(true);

            $convertProperty->setIsStatic(true);

            $convertProperty->setDefault($value);

            $convertProperty->setAccess('public');

            $result[] = $convertProperty;
        }

        return $result;
    }

    /**
     * 获取字段
     * @param string $filename
     * @return Property[]
     * @throws Exception
     */
    public function getProperties(string $filename): array
    {
        $className = ReflectionUtils::getInstance()->getClassFullNameByFile($filename);

        $classify = Classify::getInstance($className);

        return array_merge($this->parseConst($classify), $this->parseProperties($classify));
    }
}