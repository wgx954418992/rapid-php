<?php

namespace wxsdk\publicly\classier\server\notify;

/**
 * 事件
 * Class EventNotify
 * @package wxsdk\publicly\classier\server\notify
 */
class EventNotify extends BaseNotify
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
     */
    public function setEvent(string $Event)
    {
        $this->Event = $Event;
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
     */
    public function setEventKey($EventKey)
    {
        $this->EventKey = $EventKey;
    }
}