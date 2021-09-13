<?php

namespace rapidPHP\modules\router\classier;


use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use rapidPHP\modules\common\classier\Xml;
use rapidPHP\modules\core\classier\Controller;
use rapidPHP\modules\core\classier\web\View;
use rapidPHP\modules\core\classier\web\ViewTemplate;
use rapidPHP\modules\reflection\classier\Utils;
use rapidPHP\modules\router\classier\handler\ApiHandler;
use rapidPHP\modules\router\classier\handler\AutoHandler;
use rapidPHP\modules\router\classier\handler\HandlerInterface;
use rapidPHP\modules\router\classier\handler\RawHandler;
use rapidPHP\modules\router\classier\handler\ViewHandler;
use rapidPHP\modules\router\config\ActionConfig;

class Handler
{
    /**
     * service view
     */
    const SERVER_VIEW = 'view';

    /**
     * service auto
     */
    const SERVER_AUTO = 'auto';

    /**
     * service api
     */
    const SERVER_API = 'api';

    /**
     * service raw
     */
    const SERVER_RAW = 'raw';

    /**
     * @var HandlerInterface[]
     */
    private $service = [
        self::SERVER_RAW => RawHandler::class,
        self::SERVER_VIEW => ViewHandler::class,
        self::SERVER_AUTO => AutoHandler::class,
        self::SERVER_API => ApiHandler::class,
        View::class => ViewHandler::class,
        ViewTemplate::class => ViewHandler::class,
        RESTFulApi::class => ApiHandler::class,
    ];

    /**
     * @var static[]
     */
    protected static $instances;

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (isset(self::$instances[static::class])) {
            return self::$instances[static::class];
        } else {
            return self::$instances[static::class] = new static();
        }
    }

    /**
     * 注册服务
     * @param $type
     * @param $service
     * @throws Exception
     */
    public function registerService($type, $service)
    {
        if (!is_subclass_of($service, HandlerInterface::class)) throw new Exception('service error!');

        $this->service[strtolower($type)] = $service;
    }

    /**
     * @param $result
     * @param string|null $type
     * @return HandlerInterface|ApiHandler|AutoHandler|RawHandler|ViewHandler
     */
    public function getService($result, ?string $type = null)
    {
        if (isset($this->service[$type])) {

            $service = $this->service[$type];

            return call_user_func([$service, 'getInstance']);
        } else if (is_object($result)) {
            $class = get_class($result);

            foreach ($this->service as $support => $handler) {
                if ($support === $class) {
                    return call_user_func([$handler, 'getInstance']);
                } else if (is_subclass_of($support, $class)) {
                    return call_user_func([$handler, 'getInstance']);
                }
            }
        }

        $service = $this->service[self::SERVER_AUTO];

        return call_user_func([$service, 'getInstance']);
    }


    /**
     * @param Controller $controller
     * @param $service
     * @param $result
     * @param array $options
     * @return null
     */
    public function handler(Controller $controller, $service, $result, array $options = [])
    {
        if ($service instanceof HandlerInterface) {
            return $service->onResult($controller, $result, $options);
        }

        return $result;
    }

    /**
     * 编码
     * @param $result
     * @param $encode
     * @return false|mixed|string|null
     * @throws Exception
     */
    public function encode($result, $encode)
    {
        if ($result === null) return null;

        if (is_object($result)) {
            $result = Utils::getInstance()->toArray($result);
        }

        switch ($encode) {
            case ActionConfig::ENCODE_TYPE_XML:
                return Xml::getInstance()->encode($result);
            case ActionConfig::ENCODE_TYPE_JSON:
                return json_encode($result);
            default:
                if (empty($encode)) {
                    if (!is_string($result) && !is_numeric($result)) {
                        return json_encode($result);
                    } else {
                        return $result;
                    }
                } else if (is_callable($encode)) {
                    return call_user_func($encode, $result);
                }
                return $result;
        }
    }
}
