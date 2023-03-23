<?php

namespace script\model\classier\config;


use ReflectionException;
use script\model\classier\enum\Optional;

class SwiftHandlerConfig implements IHandlerConfig
{

    /**
     * Configure
     */
    use Configure;

    /**
     * @var string
     * @config output
     */
    protected $output;

    /**
     * @var array|null
     * @config mapping.system
     */
    protected $mappingSystem;

    /**
     * @var array|null
     * @config mapping.custom
     */
    protected $mappingCustom;

    /**
     * @var string[]|null
     * @config imports
     */
    protected $imports;

    /**
     * @var string[]|null
     * @config annotations.class
     */
    protected $annotationClass;

    /**
     * @var string
     * @config class_name
     */
    protected $className;

    /**
     * @var string[]|null
     * @config extends
     */
    protected $extends;

    /**
     * @var string|Optional|null
     * @config optional
     */
    protected $optional;

    /**
     * @var string|null
     * @config property.modifiers
     */
    protected $propertyModifiers;

    /**
     * @var array|null
     * @config name_rules
     */
    protected $nameRules;

    /**
     * @var string
     * @config templates.class
     */
    protected $templateClass;

    /**
     * @var string
     * @config templates.property
     */
    protected $templateProperty;

    /**
     * @return string
     */
    public function getOutput(): string
    {
        return $this->output;
    }

    /**
     * @return array|null
     */
    public function getMappingSystem(): ?array
    {
        return $this->mappingSystem;
    }

    /**
     * @return array|null
     */
    public function getMappingCustom(): ?array
    {
        return $this->mappingCustom;
    }

    /**
     * @return string[]|null
     */
    public function getImports(): ?array
    {
        return $this->imports;
    }

    /**
     * @return array|null
     */
    public function getAnnotationClass(): ?array
    {
        return $this->annotationClass;
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->className;
    }

    /**
     * @return string[]|null
     */
    public function getExtends(): ?array
    {
        return $this->extends;
    }

    /**
     * @return Optional
     * @throws ReflectionException
     */
    public function getOptional(): Optional
    {
        if ($this->optional instanceof Optional) {
            return $this->optional;
        }

        return $this->optional = Optional::i($this->optional ?? Optional::Auto);
    }

    /**
     * @return string|null
     */
    public function getPropertyModifiers(): ?string
    {
        return $this->propertyModifiers;
    }

    /**
     * @return array|null
     */
    public function getNameRules(): ?array
    {
        return $this->nameRules;
    }

    /**
     * @return string
     */
    public function getTemplateClass(): string
    {
        if (is_file($this->templateClass)){
            $this->templateClass = file_get_contents($this->templateClass);
        }

        return $this->templateClass;
    }

    /**
     * @return string
     */
    public function getTemplateProperty(): string
    {
        if (is_file($this->templateProperty)){
            $this->templateProperty = file_get_contents($this->templateProperty);
        }

        return $this->templateProperty;
    }
}
