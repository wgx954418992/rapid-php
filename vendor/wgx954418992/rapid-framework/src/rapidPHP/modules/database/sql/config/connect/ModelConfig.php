<?php

namespace rapidPHP\modules\database\sql\config\connect;

class ModelConfig
{

    /**
     * 生成model的路径
     * @var string
     */
    private $path = '';

    /**
     * model的命名空间
     * @var string
     */
    private $namespace = '';

    /**
     * 生成model名称的前缀
     * @var string
     */
    private $first = '';

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     */
    public function setNamespace(string $namespace): void
    {
        $this->namespace = $namespace;
    }

    /**
     * @return string
     */
    public function getFirst(): string
    {
        return $this->first;
    }

    /**
     * @param string $first
     */
    public function setFirst(string $first): void
    {
        $this->first = $first;
    }
}
