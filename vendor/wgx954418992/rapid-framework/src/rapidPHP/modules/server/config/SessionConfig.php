<?php


namespace rapidPHP\modules\server\config;

use Exception;
use rapidPHP\modules\cache\classier\CacheInterface;
use rapidPHP\modules\reflection\classier\Classify;

class SessionConfig
{

    /**
     * @var string|null
     */
    private $key;

    /**
     * @var CacheInterface|string|null
     */
    private $service;

    /**
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @param string|null $key
     */
    public function setKey(?string $key): void
    {
        $this->key = $key;
    }

    /**
     * @return CacheInterface|null
     * @throws Exception
     */
    public function getService(): ?CacheInterface
    {
        if (!$this->service) return null;

        if ($this->service instanceof CacheInterface) return $this->service;

        $classify = Classify::getInstance($this->service);

        if (in_array(CacheInterface::class, $classify->getInterfaceNames())) {

            return $this->service = call_user_func("{$this->service}::getInstance");
        }

        return null;
    }

    /**
     * @param string|null $service
     */
    public function setService(?string $service): void
    {
        $this->service = $service;
    }
}