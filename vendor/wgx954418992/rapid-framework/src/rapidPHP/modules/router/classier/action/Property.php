<?php

namespace rapidPHP\modules\router\classier\action;

use Exception;
use rapidPHP\modules\reflection\classier\Utils;

class Property
{

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $type;

    /**
     * PropertyBean constructor.
     * @param string|null $name
     * @param string|null $type
     */
    public function __construct(?string $name, ?string $type)
    {
        $this->name = $name;
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