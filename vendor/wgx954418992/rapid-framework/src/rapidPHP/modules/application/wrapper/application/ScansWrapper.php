<?php


namespace rapidPHP\modules\application\wrapper\application;

class ScansWrapper
{

    /**
     * controller路径
     * @var array|null
     */
    private $controller;

    /**
     * @return array|null
     */
    public function getController(): ?array
    {
        return $this->controller;
    }

    /**
     * @param array|null $controller
     */
    public function setController(?array $controller): void
    {
        $this->controller = $controller;
    }
}