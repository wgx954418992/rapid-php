<?php

namespace rapidPHP\modules\core\classier;

use rapidPHP\modules\application\classier\Context;
use rapidPHP\modules\application\classier\context\ConsoleContext;
use rapidPHP\modules\application\classier\context\WebContext;
use rapidPHP\modules\common\classier\Language;

class Controller
{

    /**
     * @var Context
     */
    protected $context;

    /**
     * 默认语言
     * @var string
     */
    protected $defaultLang = 'zh';

    /**
     * Controller constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * @return Context|WebContext|ConsoleContext
     */
    public function getContext()
    {
        return $this->context;
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
     * 翻译
     * @param $word
     * @param array $arg
     * @param string $lang
     * @return string|string[]
     */
    public function t($word, array $arg = [], string $lang = '')
    {
        if (empty($lang)) $lang = $this->getDefaultLang();

        return Language::translate($word, $lang, $arg);
    }
}
