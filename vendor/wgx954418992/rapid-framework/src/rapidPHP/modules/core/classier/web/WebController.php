<?php

namespace rapidPHP\modules\core\classier\web;

use rapidPHP\modules\application\classier\Context;
use rapidPHP\modules\application\classier\context\WebContext;
use rapidPHP\modules\common\classier\Verify;
use rapidPHP\modules\core\classier\Controller;
use rapidPHP\modules\server\classier\http\cgi\Request as CGIRequest;
use rapidPHP\modules\server\classier\http\cgi\Response as CGIResponse;
use rapidPHP\modules\server\classier\http\swoole\Request as SwooleHttpRequest;
use rapidPHP\modules\server\classier\http\swoole\Response as SwooleHttpResponse;
use rapidPHP\modules\server\classier\interfaces\Request;
use rapidPHP\modules\server\classier\interfaces\Response;
use rapidPHP\modules\server\classier\websocket\swoole\Request as SwooleWebsocketRequest;
use rapidPHP\modules\server\classier\websocket\swoole\Response as SwooleWebSocketResponse;

class WebController extends Controller
{

    /**
     * WebController constructor.
     * @param WebContext $context
     */
    public function __construct(WebContext $context)
    {
        parent::__construct($context);
    }

    /**
     * @return Context|WebContext
     */
    public function getContext()
    {
        return parent::getContext();
    }

    /**
     * @return Request|CGIRequest|SwooleHttpRequest|SwooleWebsocketRequest
     */
    public function getRequest()
    {
        return $this->getContext()->getRequest();
    }

    /**
     * @return  Response|CGIResponse|SwooleHttpResponse|SwooleWebSocketResponse
     */
    public function getResponse()
    {
        return $this->getContext()->getResponse();
    }

    /**
     * 获取客户端Ip
     * @return mixed
     */
    public function getIp(): string
    {
        return $this->getRequest()->getIp();
    }

    /**
     * 获取当前访问的网站Url
     * @param bool|false $meter
     * @param bool $isDecode
     * @return string
     */
    public function getUrl(bool $meter = false, bool $isDecode = true): string
    {
        return $this->getRequest()->getUrl($meter, $isDecode);
    }

    /**
     * 获取网站根url
     * @return string
     */
    public function getHostUrl(): string
    {
        return $this->getRequest()->getHostUrl();
    }

    /**
     * 通过参数生成url
     * @return string
     */
    public function toUrl(): string
    {
        return call_user_func_array([$this->getRequest(), 'toUrl'], func_get_args());
    }

    /**
     * 预先生成view模板
     * @param $name
     * @return ViewTemplate
     */
    public function display($name): ViewTemplate
    {
        return View::display($this, $name);
    }

    /**
     * 跳转
     * @param $url
     */
    public function location($url)
    {
        if (!Verify::getInstance()->website($url)) $url = $this->getHostUrl() . $url;

        $this->getResponse()->redirect($url);

        $this->getResponse()->end();
    }
}
