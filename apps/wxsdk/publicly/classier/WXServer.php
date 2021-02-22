<?php


namespace wxsdk\publicly\classier;

use Exception;
use rapidPHP\modules\reflection\classier\Utils;
use wxsdk\publicly\classier\server\crypt\WXBizMsgCrypt;
use wxsdk\publicly\classier\server\notify\EventNotify;
use wxsdk\publicly\classier\server\notify\MsgNotify;
use wxsdk\publicly\classier\server\NoticeInterface;
use wxsdk\publicly\config\CryptErrorConfig;
use function rapidPHP\B;
use function rapidPHP\X;

class WXServer
{
    /**
     * @var
     */
    private $token;

    /**
     * @var
     */
    private $appId;

    /**
     * @var mixed|null
     */
    private $encodingAESKey;

    /**
     * msg type text
     */
    const MSG_TYPE_TEXT = 'text';

    /**
     * msg type event
     */
    const MSG_TYPE_EVENT = 'event';

    /**
     * event subscribe
     */
    const EVENT_TYPE_SUBSCRIBE = 'subscribe';

    /**
     * event unsubscribe
     */
    const EVENT_TYPE_UNSUBSCRIBE = 'unsubscribe';

    /**
     * event click
     */
    const EVENT_TYPE_CLICK = 'CLICK';

    /**
     * WXServer constructor.
     * @param $token
     * @param $appId
     * @param null $encodingAESKey
     */
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
    public function validServer($echoStr, $signature, $timestamp, $nonce): string
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
    public function checkSignature($signature, $timestamp, $nonce): bool
    {
        $tmpArr = [$this->token, $timestamp, $nonce];

        sort($tmpArr, SORT_STRING);

        $tmpStr = implode($tmpArr);

        $tmpStr = sha1($tmpStr);

        return $tmpStr == $signature;
    }


    /**
     * 处理事件
     * @param NoticeInterface $server
     * @param $input
     * @param $msgSignature
     * @param $timestamp
     * @param $nonce
     * @return mixed|string|null
     * 如果有返回消息，则在controller里面直接输出返回值
     * @throws Exception
     */
    public function handleEvent(NoticeInterface $server, ?string $input, ?string $msgSignature, $timestamp, ?string $nonce): ?string
    {
        if (empty($input)) throw new Exception('input Error!');

        if (empty($msgSignature)) throw new Exception('msgSignature Error');

        if (empty($timestamp)) throw new Exception('timestamp Error');

        if (empty($nonce)) throw new Exception('nonce Error');

        $bizMsgCrypt = new WXBizMsgCrypt($this->token, $this->appId, $this->encodingAESKey);

        if ($this->encodingAESKey) {

            $deErrCode = $bizMsgCrypt->decryptMsg($msgSignature, $timestamp, $nonce, $input, $msg);

            if ($deErrCode != CryptErrorConfig::$OK) throw new Exception('decryptMsg Error!');
        } else {
            $msg = X()->decode($input);
        }

        $msgType = B()->getData($msg, 'MsgType');

        $beanTypes = [self::MSG_TYPE_TEXT => MsgNotify::class, self::MSG_TYPE_EVENT => EventNotify::class];

        $bean = B()->getData($beanTypes, $msgType);

        if (empty($bean)) throw new Exception('undefined msgType ' . $msgType);

        $instance = Utils::getInstance()->toObject($bean, $msg);

        if ($instance instanceof MsgNotify) {
            $result = $server->onMsg($instance);
        } else if ($instance instanceof EventNotify) {
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

            if ($enErrCode != CryptErrorConfig::$OK) throw new Exception('encryptMsg Error!');

            return $encryptMsg;
        } else {
            return $result;
        }
    }
}