<?php

namespace apps\openapi\classier;


class Parameter
{
    /**
     * 参数注解类型
     * @var string|null
     */
    private $type;

    /**
     * 名字
     * @var string|null
     */
    private $name;

    /**
     * 来源
     * @var string|null
     */
    private $source;

    /**
     * 说明
     * @var string|null
     */
    private $remark;

    /**
     * @var bool
     */
    private $isDefaultValue;


    /**
     * @var bool
     */
    private $isAllowNull;


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
    public function getSource(): ?string
    {
        return $this->source;
    }

    /**
     * @param string|null $source
     */
    public function setSource(?string $source): void
    {
        $this->source = $source;
    }

    /**
     * @return string|null
     */
    public function getRemark(): ?string
    {
        return $this->remark;
    }

    /**
     * @param string|null $remark
     */
    public function setRemark(?string $remark): void
    {
        $this->remark = $remark;
    }

    /**
     * @return bool
     */
    public function isDefaultValue(): bool
    {
        return $this->isDefaultValue;
    }

    /**
     * @param bool $isDefaultValue
     */
    public function setIsDefaultValue(bool $isDefaultValue): void
    {
        $this->isDefaultValue = $isDefaultValue;
    }

    /**
     * @return bool
     */
    public function isAllowNull(): bool
    {
        return $this->isAllowNull;
    }

    /**
     * @param bool $isAllowNull
     */
    public function setIsAllowNull(bool $isAllowNull): void
    {
        $this->isAllowNull = $isAllowNull;
    }
}