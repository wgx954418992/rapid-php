<?php

namespace script\convert\classier\config;


use ReflectionException;
use script\convert\classier\enum\Optional;

class JavaHandlerConfig implements IHandlerConfig
{

    /**
     * Configure
     */
    use Configure;

    /**
     * @var string[]
     * @config input
     */
    protected $input;

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
     * @config package
     */
    protected $package;

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
     * @var string
     * @config templates.class
     */
    protected $templateClass;

    /**
     * @var string
     * @config templates.const
     */
    protected $templateConst;

    /**
     * @var string
     * @config templates.property
     */
    protected $templateProperty;

    /**
     * @var string
     * @config templates.property_static
     */
    protected $templateStaticProperty;

    /**
     * @return string[]
     */
    public function getInput(): array
    {
        return $this->input;
    }

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
    public function getPackage(): ?string
    {
        return $this->package;
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
    public function getTemplateConst(): string
    {
        if (is_file($this->templateConst)) {
            $this->templateConst = file_get_contents($this->templateConst);
        }

        return $this->templateConst;
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
    public function getTemplateStaticProperty(): string
    {
        if (is_file($this->templateStaticProperty)) {
            $this->templateStaticProperty = file_get_contents($this->templateStaticProperty);
        }

        return $this->templateStaticProperty;
    }
}
