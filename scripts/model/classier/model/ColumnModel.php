<?php

namespace script\model\classier\model;

class ColumnModel
{
    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $comment;

    /**
     * @var string|null
     */
    protected $type;

    /**
     * @var string|null
     */
    protected $length;

    /**
     * 是否可以为null
     * @var bool
     */
    protected $is_nullable;

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
     * @return string|null
     */
    public function getLength(): ?string
    {
        return $this->length;
    }

    /**
     * @param string|null $length
     */
    public function setLength(?string $length): void
    {
        $this->length = $length;
    }

    /**
     * @return bool
     */
    public function isIsNullable(): bool
    {
        return $this->is_nullable;
    }

    /**
     * @param bool $is_nullable
     */
    public function setIsNullable(bool $is_nullable = true): void
    {
        $this->is_nullable = $is_nullable;
    }
}
