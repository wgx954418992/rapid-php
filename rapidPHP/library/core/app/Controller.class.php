<?php

namespace rapidPHP\library\core\app;

use rapid\library\rapid;
use rapidPHP\library\core\server\Request;
use rapidPHP\library\core\server\Response;

class Controller
{

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Response
     */
    private $response;

    /**
     * Controller constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * @param Response $response
     */
    public function setResponse(Response $response): void
    {
        $this->response = $response;
    }

    /**
     * 获取当前访问的网站Url
     * @param bool|false $meter
     * @param bool $isDecode
     * @return string
     */
    public function getUrl($meter = false, $isDecode = true): string
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
}