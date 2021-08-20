<?php

namespace script\convert\classier\handler;

use Exception;
use script\convert\classier\config\IHandlerConfig;
use script\convert\classier\config\SwiftHandlerConfig;
use script\convert\classier\enum\Optional;
use script\convert\classier\helper\CommonHelper;
use script\convert\classier\model\PropertyModel;
use function rapidPHP\B;
use function rapidPHP\Cal;

class SwiftIHandler extends IHandler
{

    /**
     * 把数据库字段类型转换成 java类型
     * @param SwiftHandlerConfig $config
     * @param PropertyModel $property
     * @return string
     */
    private function getCType(SwiftHandlerConfig $config, PropertyModel $property): ?string
    {
        $realType = 'String';

        $propertyType = $property->getType();

        $isArray = is_int(strpos($propertyType, '[')) || $propertyType == 'array';

        $customMapping = (array)$config->getMappingCustom();

        $customName = $property->getClassName() . '.' . $property->getName();

        if (isset($customMapping[$customName])) {
            $realType = $customMapping[$customName];
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

            $realType = "[{$realType}]";
        }

        return $realType;
    }

    /**
     * 获取 imports
     * @param SwiftHandlerConfig $config
     * @return string
     */
    private function getImports(SwiftHandlerConfig $config): string
    {
        $imports = (array)$config->getImports();

        if (empty($imports)) return '';

        $result = '';

        foreach ($imports as $import) {
            $result .= "import {$import}\n";
        }

        return $result;
    }

    /**
     * 获取继承
     * @param SwiftHandlerConfig $config
     * @param array|null $options
     * @return string
     */
    private function getExtends(SwiftHandlerConfig $config, ?array $options = []): string
    {
        $extends = (array)$config->getExtends();

        $extends = array_merge($extends,
            (array)$options['extendsNames'],
            (array)$options['implementsNames']
        );

        if (empty($extends)) return '';

        return ': ' . join(',', $extends);
    }


    /**
     * 获取Class 注解
     * @param SwiftHandlerConfig $config
     * @return string
     */
    private function getClassAnnotation(SwiftHandlerConfig $config): string
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
     * @param SwiftHandlerConfig $config
     * @param PropertyModel[] $properties
     * @param array $options
     * @return string
     * @throws Exception
     */
    public function onHandler(IHandlerConfig $config, array $properties, array $options = []): string
    {
        if (!($config instanceof SwiftHandlerConfig)) {
            throw new Exception('config error');
        }

        $imports = $this->getImports($config);

        $extends = $this->getExtends($config, $options);

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

            $CType = $this->getCType($config, $property);

            if (!is_null($property->getDefault())) {
                if ($CType == "String") {
                    $value = "\"{$property->getDefault()}\"";
                } else if ($CType === 'Bool') {
                    $value = $property->getDefault() ? 'true' : 'false';
                } else {
                    $value = $property->getDefault();
                }
            }

            $config->getOptional()
                ->then(Optional::Auto, function () use (&$CType, &$value, $property) {
                    if ($property->getOptions() & PropertyModel::OPTIONS_ALLOW_NULL) {
                        $CType = "{$CType}?";

                        if (is_null($value)) $value = 'nil';
                    } else {
                        if (is_null($value)) $value = "{$CType}()";
                    }
                })
                ->then(Optional::All, function () use (&$CType, &$value, $property) {
                    $CType = "{$CType}?";

                    if (is_null($value)) $value = 'nil';
                })
                ->then(Optional::Never, function () use (&$value, $CType) {

                    if (is_null($value)) $value = "{$CType}()";
                })
                ->fetch();

            $propertiesString .= CommonHelper::parseVariable($template, [
                'comment' => $property->getComment(),
                'type' => $property->getType(),
                'name' => $property->getName(),
                'value' => $value,
                'CType' => $CType
            ]);
        }

        return CommonHelper::parseVariable($templateClass, [
            'date' => Cal()->getDate(),
            'imports' => $imports,
            'comment' => B()->getData($options, 'comment'),
            'classAnnotation' => $classAnnotation,
            'className' => CommonHelper::parseVariable(
                $config->getClassName(),
                [
                    'shortName' => B()->getData($options, 'shortName'),
                    'className' => B()->getData($options, 'className')
                ]
            ),
            'extends' => $extends,
            'properties' => $propertiesString,
        ]);
    }
}
