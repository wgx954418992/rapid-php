<?php


namespace script\convert\classier;

class Property
{

    /**
     * 字段名称
     * @var string|null
     */
    private $name;

    /**
     * 字段类型
     * @var string|null
     */
    private $type;

    /**
     * 是否常量
     * @var bool|null
     */
    private $is_const;

    /**
     * 是否可选类型
     * @var bool|null
     */
    private $is_option;

    /**
     * 能否为null
     * @var bool|null
     */
    private $allow_null;


    /**
     * 是否静态
     * @var bool|null
     */
    private $is_static;

    /**
     * 访问权限
     * @var string|null
     */
    private $access;

    /**
     * 默认值
     * @var mixed
     */
    private $default;

    /**
     * 注解
     * @var string|null
     */
    private $doc;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return bool|null
     */
    public function getIsConst(): ?bool
    {
        return $this->is_const;
    }

    /**
     * @param bool|null $is_const
     */
    public function setIsConst(?bool $is_const): void
    {
        $this->is_const = $is_const;
    }

    /**
     * @return bool|null
     */
    public function getIsOption(): ?bool
    {
        return $this->is_option;
    }

    /**
     * @param bool|null $is_option
     */
    public function setIsOption(?bool $is_option): void
    {
        $this->is_option = $is_option;
    }

    /**
     * @return bool|null
     */
    public function getAllowNull(): ?bool
    {
        return $this->allow_null;
    }

    /**
     * @param bool|null $allow_null
     */
    public function setAllowNull(?bool $allow_null): void
    {
        $this->allow_null = $allow_null;
    }

    /**
     * @return bool|null
     */
    public function getIsStatic(): ?bool
    {
        return $this->is_static;
    }

    /**
     * @param bool|null $is_static
     */
    public function setIsStatic(?bool $is_static): void
    {
        $this->is_static = $is_static;
    }

    /**
     * @return string|null
     */
    public function getAccess(): ?string
    {
        return $this->access;
    }

    /**
     * @param string|null $access
     */
    public function setAccess(?string $access): void
    {
        $this->access = $access;
    }

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param mixed $default
     */
    public function setDefault($default): void
    {
        $this->default = $default;
    }

    /**
     * @return string|null
     */
    public function getDoc(): ?string
    {
        return $this->doc;
    }

    /**
     * @param string|null $doc
     */
    public function setDoc(?string $doc): void
    {
        $this->doc = $doc;
    }

}