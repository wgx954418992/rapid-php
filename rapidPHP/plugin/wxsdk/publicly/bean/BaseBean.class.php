<?php

namespace rapidPHP\plugin\wxsdk\publicly\bean;

class BaseBean
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
     * @return self
     */
    public function setToUserName(string $ToUserName): self
    {
        $this->ToUserName = $ToUserName;
        return $this;
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
     * @return self
     */
    public function setFromUserName(string $FromUserName): self
    {
        $this->FromUserName = $FromUserName;
        return $this;
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
     * @return self
     */
    public function setCreateTime(string $CreateTime): self
    {
        $this->CreateTime = $CreateTime;
        return $this;
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
     * @return self
     */
    public function setMsgType(string $MsgType): self
    {
        $this->MsgType = $MsgType;
        return $this;
    }


}