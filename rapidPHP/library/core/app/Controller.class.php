<?php

namespace rapidPHP\library\core\app;

use rapid\library\rapid;
use rapidPHP\library\core\Language;
use rapidPHP\library\core\server\Request;
use rapidPHP\library\core\server\Response;
use rapidPHP\library\ViewTemplate;

class Controller
{

    /**
     * 默认语言
     * @var string
     */
    private $defaultLang = 'zh';

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
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * @return string
     */
    public function getDefaultLang(): string
    {
        return $this->defaultLang;
    }

    /**
     * @param string $defaultLang
     */
    public function setDefaultLang(string $defaultLang): void
    {
        $this->defaultLang = $defaultLang;
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

    /**
     * 预先生成view模板
     * @param $name
     * @return ViewTemplate
     */
    public function display($name)
    {
        return View::display($this, $name);
    }

    /**
     * 翻译
     * @param $word
     * @param array $arg
     * @param string $lang
     * @return mixed|string|string[]
     */
    public function t($word, $arg = [], $lang = '')
    {
        if (empty($lang)) $lang = $this->defaultLang;

        return Language::translate($word, $lang, $arg);
    }
}