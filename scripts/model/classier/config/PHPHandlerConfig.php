<?php

namespace script\model\classier\config;


use script\model\classier\enum\Optional;

class PHPHandlerConfig implements IHandlerConfig
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
     * @var string|null
     * @config namespace
     */
    protected $namespace;

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
     * @var string[]|null
     * @config implements
     */
    protected $implements;

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
     * @var bool
     * @config is_getter
     */
    protected $isGetter;

    /**
     * @var bool
     * @config is_setter
     */
    protected $isSetter;

    /**
     * @var bool
     * @config is_valida
     */
    protected $isValida;

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
     * @var string
     * @config templates.getter
     */
    protected $templateGetter;

    /**
     * @var string
     * @config templates.setter
     */
    protected $templateSetter;

    /**
     * @var string
     * @config templates.valida
     */
    protected $templateValida;

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
     * @return string|null
     */
    public function getNamespace(): ?string
    {
        return $this->namespace;
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
     * @return string[]|null
     */
    public function getImplements(): ?array
    {
        return $this->implements;
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
     * @return bool
     */
    public function isGetter(): bool
    {
        return $this->isGetter;
    }

    /**
     * @return bool
     */
    public function isSetter(): bool
    {
        return $this->isSetter;
    }

    /**
     * @return bool
     */
    public function isValida(): bool
    {
        return $this->isValida;
    }


    /**
     * @return string
     */
    public function getTemplateClass(): string
    {
        if (is_file($this->templateClass)) {
            $this->templateClass = file_get_contents($this->templateClass);
        }

        return $this->templateClass;
    }

    /**
     * @return string
     */
    public function getTemplateProperty(): string
    {
        if (is_file($this->templateProperty)) {
            $this->templateProperty = file_get_contents($this->templateProperty);
        }

        return $this->templateProperty;
    }

    /**
     * @return string
     */
    public function getTemplateGetter(): string
    {
        if (is_file($this->templateGetter)) {
            $this->templateGetter = file_get_contents($this->templateGetter);
        }

        return $this->templateGetter;
    }

    /**
     * @return string
     */
    public function getTemplateSetter(): string
    {
        if (is_file($this->templateSetter)) {
            $this->templateSetter = file_get_contents($this->templateSetter);
        }

        return $this->templateSetter;
    }

    /**
     * @return string
     */
    public function getTemplateValida(): string
    {
        if (is_file($this->templateValida)) {
            $this->templateValida = file_get_contents($this->templateValida);
        }

        return $this->templateValida;
    }
}
