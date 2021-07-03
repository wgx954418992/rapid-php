<?php

namespace rapidPHP\modules\application\classier\apps;

use Exception;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\reflection\classier\Classify;
use rapidPHP\modules\router\classier\router\WebRouter;
use rapidPHP\modules\server\classier\http\cgi\Request;
use rapidPHP\modules\server\classier\http\cgi\Response;
use rapidPHP\modules\server\config\SessionConfig;
use rapidPHP\modules\server\config\HttpConfig as BaseHttpConfig;
use function rapidPHP\formatException;

class CGIApplication extends WebApplication
{

    /**
     * run
     * @throws Exception
     */
    public function run()
    {
        try {
            $startTime = microtime(true);

            $cigConfig = $this->getConfig()->getServer()->getCgi();

            $sessionConfig = $cigConfig->getSession();

            $this->setSessionId($sessionConfig, $_COOKIE, $sessionId, $isSetSessionId);

            $request = new Request($_COOKIE, $sessionConfig, $sessionId);

            $response = new Response($sessionConfig, $request->getSessionId());

            if ($isSetSessionId && $sessionId) {
                $response->cookie($sessionConfig->getKey(), $sessionId);
            }

            $context = parent::newWebContext($request, $response, $cigConfig->getContext());

            WebRouter::getInstance()->run($this, $context);

            $endTime = microtime(true);

            $requestTime = $endTime - $startTime;

            $this->logger(self::LOGGER_ACCESS)
                ->info("-{$request->getIp()} -{$request->getMethod()} -{$request->getUrl(true)} -{$requestTime}");
        } catch (Exception $e) {
            $this->logger(self::LOGGER_ACCESS)->error(formatException($e));

            throw $e;
        }
    }

    /**
     * 设置客户端sessionId
     * @param SessionConfig|null $sessionConfig
     * @param $cookie
     * @param $sessionId
     * @param bool $isSetSessionId
     */
    protected function setSessionId(?SessionConfig $sessionConfig, &$cookie, &$sessionId, &$isSetSessionId = false)
    {
        if (empty($sessionConfig)) return;

        $sessionId = Build::getInstance()->getData($cookie, $sessionConfig->getKey());

        if (strlen($sessionId) != 32) $sessionId = null;

        if (!empty($sessionId)) return;

        $cookie[$sessionConfig->getKey()] = $sessionId = BaseHttpConfig::getSessionId();

        $isSetSessionId = true;
    }
}
