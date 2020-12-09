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
}
