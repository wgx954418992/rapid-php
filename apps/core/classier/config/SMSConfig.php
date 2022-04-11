<?php


namespace apps\core\classier\config;

class SMSConfig
{

    /**
     * Configure
     */
    use Configure;

    /**
     * service
     * @var string
     * @config sms.service
     */
    protected $service;

    /**
     * limit
     * @var int
     * @config sms.limit
     */
    protected $limit;

    /**
     * valida
     * @var int
     * @config sms.valida
     */
    protected $valida;

    /**
     * 万能码
     * @var string|int|null
     * @config sms.universal
     */
    protected $universal;

    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getValida(): int
    {
        return $this->valida;
    }

    /**
     * @return int|string|null
     */
    public function getUniversal()
    {
        return $this->universal;
    }
}
