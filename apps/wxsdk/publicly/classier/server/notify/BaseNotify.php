<?php

namespace wxsdk\publicly\classier\server\notify;

/**
 * Class BaseNotify
 * @package wxsdk\publicly\classier\server\notify
 */
class BaseNotify
{
    /**
     * 接收者
     * @var string
     */
    public $ToUserName;

    /**
     * 发送者
     * @var string
     */
    public $FromUserName;

    /**
     * 时间
     * @var string
     */
    public $CreateTime;

    /**
     * 消息类型
     * @var string
     */
    public $MsgType;

    /**
     * @return string
     */
    public function getToUserName(): string
    {
        return $this->ToUserName;
    }

    /**
     * @param string $ToUserName
     */
    public function setToUserName(string $ToUserName)
    {
        $this->ToUserName = $ToUserName;
    }

    /**
     * @return string
     */
    public function getFromUserName(): string
    {
        return $this->FromUserName;
    }

    /**
     * @param string $FromUserName
     */
    public function setFromUserName(string $FromUserName)
    {
        $this->FromUserName = $FromUserName;
    }

    /**
     * @return string
     */
    public function getCreateTime(): string
    {
        return $this->CreateTime;
    }

    /**
     * @param string $CreateTime
     */
    public function setCreateTime(string $CreateTime)
    {
        $this->CreateTime = $CreateTime;
    }

    /**
     * @return string
     */
    public function getMsgType(): string
    {
        return $this->MsgType;
    }

    /**
     * @param string $MsgType
     */
    public function setMsgType(string $MsgType)
    {
        $this->MsgType = $MsgType;
    }


}