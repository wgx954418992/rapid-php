<?php

namespace rapidPHP\modules\application\classier\apps;


use Exception;
use rapidPHP\modules\application\classier\Application;
use rapidPHP\modules\application\classier\Context;
use rapidPHP\modules\application\classier\context\WebContext;
use rapidPHP\modules\reflection\classier\Classify;
use rapidPHP\modules\server\classier\interfaces\Request;
use rapidPHP\modules\server\classier\interfaces\Response;

abstract class WebApplication extends Application
{

    /**
     * 创建web context
     * @param Request $request
     * @param Response $response
     * @param string|null $context
     * @return WebContext|Context|null|mixed
     * @throws Exception
     */
    public function newWebContext(Request $request, Response $response, ?string $context)
    {
        if (empty($context)) $context = WebContext::class;

        /** @var WebContext $instance */
        $instance = Classify::getInstance($context)
            ->newInstance($request, $response);

        return $instance;
    }
}