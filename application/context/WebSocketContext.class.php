<?php

namespace application\context;


use application\controller\exception\WebSocketExceptionController;
use rapidPHP\library\core\server\Request;
use rapidPHP\library\core\server\Response;

class WebSocketContext extends WebContext
{

    /**
     * WebSocketContext constructor.
     * @param Request $request
     * @param Response $response
     * @param mixed ...$options
     */
    public function __construct(Request $request, Response $response, ...$options)
    {
        parent::__construct($request, $response, $options);

        $this->setExController(new WebSocketExceptionController($request, $response));
    }

}