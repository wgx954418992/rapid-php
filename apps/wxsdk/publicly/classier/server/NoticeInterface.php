<?php


namespace wxsdk\publicly\classier\server;


use wxsdk\publicly\classier\server\notify\EventNotify;
use wxsdk\publicly\classier\server\notify\MsgNotify;

/**
 * NoticeInterface
 * Class WXServerInterface
 * @package wxsdk\publicly\classier\server
 */
interface NoticeInterface
{
    /**
     * 被关注事件
     * 用户基础该类之后需要重写该方法，如果有返回数据则会返回到微信服务器
     * @param EventNotify $event
     * @return mixed
     */
    public function onSubscribe(EventNotify $event);

    /**
     * 取消关注事件
     * 用户基础该类之后需要重写该方法，如果有返回数据则会返回到微信服务器
     * @param EventNotify $event
     * @return mixed
     */
    public function onUnSubscribe(EventNotify $event);

    /**
     * 点击菜单事件
     * 用户基础该类之后需要重写该方法，如果有返回数据则会返回到微信服务器
     * @param EventNotify $event
     * @return mixed
     */
    public function onClick(EventNotify $event);

    /**
     * 点击菜单事件
     * 用户基础该类之后需要重写该方法，如果有返回数据则会返回到微信服务器
     * @param EventNotify $event
     * @return mixed
     */
    public function onScan(EventNotify $event);

    /**
     * 文本消息事件
     * 用户基础该类之后需要重写该方法，如果有返回数据则会返回到微信服务器
     * @param MsgNotify $msg
     * @return mixed
     */
    public function onMsg(MsgNotify $msg);

    /**
     * 其他事件
     * 用户基础该类之后需要重写该方法，如果有返回数据则会返回到微信服务器
     * @param $msg
     * @return mixed
     */
    public function onOther($msg);
}
