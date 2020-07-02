<?php


namespace rapidPHP\plugin\wxsdk\publicly;


use rapidPHP\plugin\wxsdk\publicly\bean\EventBean;
use rapidPHP\plugin\wxsdk\publicly\bean\MsgBean;

/**
 * 本应该是个接口，但是为了可以移除不需要的时间监听，才写成类，开发时候大家继承这个类，重新下面需要的方法就可以了
 * Class WXServerInterface
 * @package rapidPHP\plugin\wxsdk\publicly
 */
class WXServerInterface
{
    /**
     * 被关注事件
     * @param EventBean $event
     * @return mixed
     */
    public function onSubscribe(EventBean $event)
    {
        //TODO 用户基础该类之后需要重写该方法，如果有返回数据则会返回到微信服务器
        return null;
    }

    /**
     * 取消关注事件
     * @param EventBean $event
     * @return mixed
     */
    public function onUnSubscribe(EventBean $event)
    {
        //TODO 用户基础该类之后需要重写该方法，如果有返回数据则会返回到微信服务器
        return null;
    }

    /**
     * 点击菜单事件
     * @param EventBean $event
     * @return mixed
     */
    public function onClick(EventBean $event)
    {
        //TODO 用户基础该类之后需要重写该方法，如果有返回数据则会返回到微信服务器
        return null;
    }

    /**
     * 文本消息事件
     * @param MsgBean $msgBean
     * @return mixed
     */
    public function onMsg(MsgBean $msgBean)
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