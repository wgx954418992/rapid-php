<?php

namespace rapidPHP\modules\router\classier\action;

use Exception;
use rapidPHP\modules\reflection\classier\Utils;
use rapidPHP\modules\router\config\ActionConfig;

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
     * 获取编码类型
     * @return string|null
     */
    public function getEncodeType(): ?string
    {
        return ActionConfig::getEncodeType($this->getRemark());
    }

    /**
     * 转array
     *
     * @return array|null
     * @throws Exception
     */
    public function toArray(): ?array
    {
        return Utils::getInstance()->toArray($this);
    }
}