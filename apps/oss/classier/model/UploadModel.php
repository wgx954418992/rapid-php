<?php


namespace oss\classier\model;


class UploadModel
{
    /**
     * mime
     * @var string
     */
    protected $mime = '';

    /**
     * path
     * @var string
     */
    protected $path = '';

    /**
     * object
     * @var string
     */
    protected $object = '';

    /**
     * options
     * @var array
     */
    protected $options = [];

    /**
     * 使用 callback
     * @var bool
     */
    protected $useCallback = false;

    /**
     * callback var
     * @var array
     */
    protected $callbackVar = [];

    /**
     * @return string
     */
    public function getMime(): string
    {
        return $this->mime;
    }

    /**
     * @param string $mime
     */
    public function setMime(string $mime): void
    {
        $this->mime = $mime;
    }

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
    public function getObject(): string
    {
        return $this->object;
    }

    /**
     * @param string $object
     */
    public function setObject(string $object): void
    {
        $this->object = $object;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    /**
     * @return bool
     */
    public function isUseCallback(): bool
    {
        return $this->useCallback;
    }

    /**
     * @param bool $useCallback
     */
    public function setUseCallback(bool $useCallback): void
    {
        $this->useCallback = $useCallback;
    }

    /**
     * @return array
     */
    public function getCallbackVar(): array
    {
        return $this->callbackVar;
    }

    /**
     * @param array $callbackVar
     */
    public function setCallbackVar(array $callbackVar): void
    {
        $this->callbackVar = $callbackVar;
    }
}
