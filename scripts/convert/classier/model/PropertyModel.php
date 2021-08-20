<?php


namespace script\convert\classier\model;

class PropertyModel
{

    /**
     * options
     */
    const OPTIONS = 1;

    /**
     * options 常量
     */
    const OPTIONS_CONST = self::OPTIONS << 1;

    /**
     * options 静态
     */
    const OPTIONS_STATIC = self::OPTIONS << 2;

    /**
     * options 允许null
     */
    const OPTIONS_ALLOW_NULL = self::OPTIONS << 3;

    /**
     * class name
     * @var string
     */
    protected $className;

    /**
     * 字段名称
     * @var string
     */
    protected $name;

    /**
     * 字段类型
     * @var string|null
     */
    protected $type;

    /**
     * options
     * @var int
     */
    protected $options;

    /**
     * 默认值
     * @var mixed
     */
    protected $default;

    /**
     * 注解
     * @var string|null
     */
    protected $comment;

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->className;
    }

    /**
     * @param string $className
     */
    public function setClassName(string $className): void
    {
        $this->className = $className;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(string $name): void
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
     * @return int|null
     */
    public function getOptions(): ?int
    {
        return $this->options;
    }

    /**
     * @param int $options
     */
    public function setOptions(int $options): void
    {
        $this->options = $options;
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
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string|null $comment
     */
    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }
}
