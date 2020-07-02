<?php


namespace rapidPHP\plugin\wxsdk\publicly;

use Exception;
use rapidPHP\plugin\wxsdk\publicly\bean\EventBean;
use rapidPHP\plugin\wxsdk\publicly\bean\MsgBean;
use ReflectionException;

class WXServer
{
    private $token;

    private $appId;

    private $encodingAESKey;

    const MSG_TYPE_TEXT = 'text';

    const MSG_TYPE_EVENT = 'event';

    const EVENT_TYPE_SUBSCRIBE = 'subscribe';

    const EVENT_TYPE_UNSUBSCRIBE = 'unsubscribe';

    const EVENT_TYPE_CLICK = 'CLICK';

    public function __construct($token, $appId, $encodingAESKey = null)
    {
        $this->token = $token;
        $this->appId = $appId;
        $this->encodingAESKey = $encodingAESKey;
    }

    /**
     * 效验服务器
     * @param  $echoStr
     * @param $signature
     * @param $timestamp
     * @param $nonce
     * @return string
     */
    public function validServer($echoStr, $signature, $timestamp, $nonce)
    {
        if (empty($echoStr)) return '';

        if (!$this->checkSignature($signature, $timestamp, $nonce)) return '';

        return $echoStr;
    }

    /**
     * 检查签名
     * @param $signature
     * @param $timestamp
     * @param $nonce
     * @return bool
     */
    public function checkSignature($signature, $timestamp, $nonce)
    {
        $tmpArr = [$this->token, $timestamp, $nonce];

        sort($tmpArr, SORT_STRING);

        $tmpStr = implode($tmpArr);

        $tmpStr = sha1($tmpStr);

        return $tmpStr == $signature;
    }


    /**
     * 处理事件
     * @param WXServerInterface $server
     * @param $msgSignature
     * @param $timestamp
     * @param $nonce
     * @return mixed|string|null
     * 如果有返回消息，则在controller里面直接输出返回值
     * @throws ReflectionException
     * @throws Exception
     */
    public function handleEvent(WXServerInterface $server, $msgSignature, $timestamp, $nonce)
    {
        if (empty($msgSignature)) throw new Exception('msgSignature Error');

        if (empty($timestamp)) throw new Exception('timestamp Error');

        if (empty($nonce)) throw new Exception('nonce Error');

        $input = file_get_contents('php://input');

        if (empty($input)) throw new Exception('input Error!');

        $bizMsgCrypt = new WXBizMsgCrypt($this->token, $this->appId, $this->encodingAESKey);

        if ($this->encodingAESKey) {

            $deErrCode = $bizMsgCrypt->decryptMsg($msgSignature, $timestamp, $nonce, $input, $msg);

            if ($deErrCode != ErrorCode::$OK) throw new Exception('decryptMsg Error!');
        } else {
            $msg = X()->decode($input);
        }

        $msgType = B()->getData($msg, 'MsgType');

        $beanTypes = [self::MSG_TYPE_TEXT => MsgBean::class, self::MSG_TYPE_EVENT => EventBean::class];

        $bean = B()->getData($beanTypes, $msgType);

        if (empty($bean)) throw new Exception('undefined msgType ' . $msgType);

        $instance = B()->toObject($msg, $bean);

        if ($instance instanceof MsgBean) {
            $result = $server->onMsg($instance);
        } else if ($instance instanceof EventBean) {
            switch ($instance->getEvent()) {
                case self::EVENT_TYPE_SUBSCRIBE:
                    $result = $server->onSubscribe($instance);
                    break;
                case self::EVENT_TYPE_UNSUBSCRIBE:
                    $result = $server->onUnSubscribe($instance);
                    break;
                case self::EVENT_TYPE_CLICK:
                    $result = $server->onClick($instance);
                    break;
                default:
                    $result = $server->onOther($msg);
                    break;
            }
        }

        if (empty($result)) return null;

        if (is_array($result)) $result = X()->encode($result);

        if ($this->encodingAESKey) {
            $enErrCode = $bizMsgCrypt->encryptMsg($result, time(), $nonce, $encryptMsg);

            if ($enErrCode != ErrorCode::$OK) throw new Exception('encryptMsg Error!');

            return $encryptMsg;
        } else {
            return $result;
        }
    }
}