<?php


namespace apps\core\classier\service\sms;


use apps\core\classier\config\sms\ALSMSConfig;
use apps\core\classier\config\sms\TCSMSConfig;
use apps\core\classier\config\SMSConfig;

abstract class SMSInterface
{
    /**
     * @var ALSMSConfig|TCSMSConfig
     */
    protected $config;

    /**
     * @return ALSMSConfig|TCSMSConfig
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param SMSConfig $config
     */
    public function setConfig(SMSConfig $config)
    {
        $this->config = $config;
    }

    /**
     * SMSService constructor.
     * @param SMSConfig $smsConfig
     */
    public function __construct(SMSConfig $smsConfig)
    {
        $this->setConfig($smsConfig);
    }

    /**
     * @param $templateCode
     * @param $phoneNumber
     * @param null $param
     * @return mixed
     */
    abstract public function send($templateCode, $phoneNumber, $param = null);
}