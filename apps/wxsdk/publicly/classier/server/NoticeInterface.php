<?php


namespace wxsdk\publicly\classier\server;


use wxsdk\publicly\classify\server\notify\EventNotify;
use wxsdk\publicly\classify\server\notify\MsgNotify;

/**
 * 本应该是个接口，但是为了可以移除不需要的时间监听，才写成类，开发时候大家继承这个类，重新下面需要的方法就可以了
 * Class WXServerInterface
 * @package wxsdk\publicly\classier\server
 */
abstract class NoticeInterface
{
    /**
     * 被关注事件
     * @param EventNotify $event
     * @return mixed
     */
    public function onSubscribe(EventNotify $event)
    {
        //TODO 用户基础该类之后需要重写该方法，如果有返回数据则会返回到微信服务器
        return null;
    }

    /**
     * 取消关注事件
     * @param EventNotify $event
     * @return mixed
     */
    public function onUnSubscribe(EventNotify $event)
    {
        //TODO 用户基础该类之后需要重写该方法，如果有返回数据则会返回到微信服务器
        return null;
    }

    /**
     * 点击菜单事件
     * @param EventNotify $event
     * @return mixed
     */
    public function onClick(EventNotify $event)
    {
        //TODO 用户基础该类之后需要重写该方法，如果有返回数据则会返回到微信服务器
        return null;
    }

    /**
     * 文本消息事件
     * @param MsgNotify $msgBean
     * @return mixed
     */
    public function onMsg(MsgNotify $msgBean)
    {
        //TODO 用户基础该类之后需要重写该方法，如果有返回数据则会返回到微信服务器
        return null;
    }

    /**
     * 其他事件
     * @param $msg
     * @return mixed
     */
    public function onOther($msg)
    {
        //TODO 用户基础该类之后需要重写该方法，如果有返回数据则会返回到微信服务器
        return null;
    }
}