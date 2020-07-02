<?php

namespace application\controller;

use application\model\AppUserModel;
use application\view\IndexView;
use rapidPHP\library\core\server\SWebSocketServer;
use rapidPHP\library\RESTFullApi;
use Swoole\Timer;

/**
 * Class WebSocketController
 * @url /websocket
 * @package application\controller
 */
class WebSocketController extends BaseController
{

    /**
     * @url /hello
     * @param $id
     * @param $callback
     * @return RESTFullApi
     */
    public function hello($id, $callback)
    {
        Timer::tick(2000, function () {

            $this->getResponse()->write(RESTFullApi::success("延迟回复")->toJson());
        });

        return RESTFullApi::success('收到-' . $id, $callback);
    }
}