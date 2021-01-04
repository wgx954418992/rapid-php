<?php

namespace wxsdk\publicly\classier\server\notify;

/**
 * 收到文本消息事件
 * Class MsgNotify
 * @package wxsdk\publicly\classier\server\notify
 */
class MsgNotify extends BaseNotify
{

    /**
     * 消息内容
     * @var string
     */
    public $Content;

    /**
     * 消息id
     * @var int
     */
    public $MsgId;

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->Content;
    }

    /**
     * @param string $Content
     * @return self
     */
    public function setContent(string $Content): self
    {
        $this->Content = $Content;
        return $this;
    }

    /**
     * @return int
     */
    public function getMsgId(): int
    {
        return $this->MsgId;
    }

    /**
     * @param int $MsgId
     * @return self
     */
    public function setMsgId(int $MsgId): self
    {
        $this->MsgId = $MsgId;
        return $this;
    }
}