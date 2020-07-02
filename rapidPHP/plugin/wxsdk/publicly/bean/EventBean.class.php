<?php

namespace rapidPHP\plugin\wxsdk\publicly\bean;

/**
 * 事件
 * Class SubscribeBean
 * @package rapidPHP\plugin\wxsdk\publicly\bean
 */
class EventBean extends BaseBean
{

    /**
     * 事件类型
     * @var string
     */
    public $Event;

    /**
     * 事件key
     * @var array|string
     */
    public $EventKey;

    /**
     * @return string
     */
    public function getEvent(): string
    {
        return $this->Event;
    }

    /**
     * @param string $Event
     * @return self
     */
    public function setEvent(string $Event): self
    {
        $this->Event = $Event;
        return $this;
    }

    /**
     * @return array|string
     */
    public function getEventKey()
    {
        return $this->EventKey;
    }

    /**
     * @param  $EventKey
     * @return self
     */
    public function setEventKey($EventKey): self
    {
        $this->EventKey = $EventKey;
        return $this;
    }
}