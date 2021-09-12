<?php

namespace script\convert\classier\handler;

use Exception;
use script\convert\classier\config\IHandlerConfig;
use script\convert\classier\config\JavaHandlerConfig;
use script\convert\classier\enum\Optional;
use script\convert\classier\helper\CommonHelper;
use script\convert\classier\model\PropertyModel;
use function rapidPHP\B;
use function rapidPHP\Cal;

class JavaIHandler extends IHandler
{

    /**
     * 把数据库字段类型转换成 java类型
     * @param JavaHandlerConfig $config
     * @param $customKey
     * @param $propertyType
     * @return string
     */
    private function getCType(JavaHandlerConfig $config, $customKey, $propertyType): ?string
    {
        $realType = 'String';

        $isArray = is_int(strpos($propertyType, '[')) || $propertyType == 'array';

        $customMapping = (array)$config->getMappingCustom();

        if (isset($customMapping[$customKey])) {
            $realType = $customMapping[$customKey];
        } else {
            $systemMapping = (array)$config->getMappingSystem();

            foreach ($systemMapping as $type => $list) {
                foreach ($list as $item) {
                    if ($propertyType == $item) $realType = $type;
                }
            }
        }

        if ($isArray && !is_int(strpos($realType, '<'))) {

            $realType = str_replace(['[', ']'], '', $realType);

            $realType = "List<{$realType}>";
        }

        return $realType;
    }

    /**
     * 获取 imports
     * @param JavaHandlerConfig $config
     * @return string
     */
    private function getImports(JavaHandlerConfig $config): string
    {
        $imports = (array)$config->getImports();

        if (empty($imports)) return '';

        $result = '';

        foreach ($imports as $import) {
            $result .= "import {$import};\n";
        }

        return $result;
    }

    /**
     * 获取继承
     * @param JavaHandlerConfig $config
     * @param array $options
     * @return string
     */
    private function getExtends(JavaHandlerConfig $config, array $options = []): string
    {
        $extends = (array)$config->getExtends();

        $extends = array_merge($extends, (array)$options['extendsNames']);

        if (empty($extends)) return '';

        return 'extends ' . join(',', $extends);
    }

    /**
     * 获取接口
     * @param JavaHandlerConfig $config
     * @param array $options
     * @return string
     */
    private function getImplements(JavaHandlerConfig $config, array $options = []): string
    {
        $implements = (array)$config->getImplements();

        $implements = array_merge($implements, (array)$options['implementsNames']);

        if (empty($implements)) return '';

        return 'implements ' . join(',', $implements);
    }


    /**
     * 获取Class 注解
     * @param JavaHandlerConfig $config
     * @return string
     */
    private function getClassAnnotation(JavaHandlerConfig $config): string
    {
        $annotations = (array)$config->getAnnotationClass();

        if (empty($annotations)) return '';

        $result = '';

        foreach ($annotations as $annotation) {
            $result .= "@{$annotation}\n";
        }

        return $result;
    }

    /**
     * handler
     * @param JavaHandlerConfig $config
     * @param PropertyModel[] $properties
     * @param array $options
     * @return string
     * @throws Exception
     */
    public function onHandler(IHandlerConfig $config, array $properties, array $options = []): string
    {
        if (!($config instanceof JavaHandlerConfig)) {
            throw new Exception('config error');
        }

        $package = $config->getPackage();

        $imports = $this->getImports($config);

        $extends = $this->getExtends($config, $options);

        $implements = $this->getImplements($config, $options);

        $classAnnotation = $this->getClassAnnotation($config);

        $templateClass = $config->getTemplateClass();

        $templateConst = $config->getTemplateConst();

        $templateProperty = $config->getTemplateProperty();

        $templateStaticProperty = $config->getTemplateStaticProperty();

        $propertiesString = '';

        foreach ($properties as $property) {

            $template = $templateProperty;

            if ($property->getOptions() & PropertyModel::OPTIONS_CONST) {
                $template = $templateConst;
            } elseif ($property->getOptions() & PropertyModel::OPTIONS_STATIC) {
                $template = $templateStaticProperty;
            }

            $value = null;

            $CType = $this->getCType($config, $property->getClassName() . '.' . $property->getName(), $property->getType());

            if (!is_null($property->getDefault())) {
                if ($CType == "String") {
                    $value = "\"{$property->getDefault()}\"";
                } else if (strtolower($CType) === 'bool') {
                    $value = $property->getDefault() ? 'true' : 'false';
                } else {
                    $value = $property->getDefault();
                }
            }

            $config->getOptional()
                ->then(Optional::Auto, function () use (&$CType, &$value, $property) {
                    if ($property->getOptions() & PropertyModel::OPTIONS_ALLOW_NULL) {
                        $CType = "Optional<{$CType}>";

                        if (is_null($value)) {
                            $value = 'Optional.empty()';
                        } else {
                            $value = "Optional.ofNullable({$value})";
                        }
                    }
                })
                ->then(Optional::All, function () use (&$CType, &$value, $property) {
                    $CType = "Optional<{$CType}>";

                    if (is_null($value)) {
                        $value = 'Optional.empty()';
                    } else {
                        $value = "Optional.ofNullable({$value})";
                    }
                })
                ->fetch();

            $propertiesString .= CommonHelper::parseVariable($template, [
                'comment' => $property->getComment(),
                'type' => $property->getType(),
                'name' => $property->getName(),
                'value' => $value,
                'EValue' => is_null($value) ? '' : ' = ' . $value,
                'CType' => $CType
            ]);
        }

        if ($package) {
            if ($options['diffPath']) {
                $diffPath = '/' . rtrim($options['diffPath'], '/*');
            }

            $package = CommonHelper::parseVariable($package, [
                'diffPath' => str_replace('/', '.', $diffPath ?? '')
            ]);
        }

        return CommonHelper::parseVariable($templateClass, [
            'date' => Cal()->getDate(),
            'package' => empty($package) ? '' : "package {$package};",
            'imports' => $imports,
            'comment' => B()->getData($options, 'comment'),
            'classAnnotation' => $classAnnotation,
            'className' => CommonHelper::parseVariable(
                $config->getClassName(),
                [
                    'shortName' => B()->getData($options, 'shortName'),
                    'className' => B()->getData($options, 'className')
                ]
            ), 'extends' => $extends,
            'implements' => $implements,
            'properties' => $propertiesString,
        ]);
    }
}
