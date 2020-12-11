<?php

namespace rapidPHP\modules\router\classier\action;

use Exception;
use rapidPHP\modules\reflection\classier\Utils;

class Returned
{

    /**
     * @var string|null
     */
    private $type;

    /**
     * @var Property[]|null
     */
    private $properties;

    /**
     * ReturnBean constructor.
     * @param string|null $type
     * @param Property[]|null $properties
     */
    public function __construct(?string $type, ?array $properties)
    {
        $this->type = $type;
        $this->properties = $properties;
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
     * @return Property[]|null
     */
    public function getProperties(): ?array
    {
        return $this->properties;
    }

    /**
     * @param Property[]|null $properties
     */
    public function setProperties(?array $properties): void
    {
        $this->properties = $properties;
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