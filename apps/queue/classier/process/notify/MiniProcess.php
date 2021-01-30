<?php


namespace apps\queue\classier\process\notify;

use apps\core\classier\config\MiniConfig;
use apps\core\classier\model\AppQueueModel;
use apps\core\classier\service\BaseService;
use apps\core\classier\service\RedisCacheService;
use apps\queue\classier\config\QueueConfig;
use Exception;
use rapidPHP\modules\process\classier\swoole\PipeProcess;
use wxsdk\mini\classier\Mini;
use function rapidPHP\B;

class MiniProcess extends PipeProcess
{

    /**
     * @var Mini
     */
    private $mini;

    /**
     * MiniProcess constructor.
     * @param $sleep
     * @param null $mainProcess
     */
    public function __construct($sleep, $mainProcess = null)
    {
        parent::__construct($sleep, $mainProcess);

        $this->mini = new Mini(RedisCacheService::getInstance(), MiniConfig::APPID, MiniConfig::SECRET);
    }

    /**
     * @param $data
     * @return mixed|void
     * @throws Exception
     */
    public function onHandler($data)
    {
        /** @var AppQueueModel $queueModel */
        $queueModel = unserialize($data);

        $param = B()->jsonDecode($queueModel->getParam());

        try {
            $templateId = B()->getData($param, QueueConfig::PARAM_KEY_MINI_TEMPLATE_ID);

            if (empty($templateId)) throw new Exception('templateId 错误');

            $openId = B()->getData($param, QueueConfig::PARAM_KEY_MINI_OPEN_ID);

            if (empty($openId)) throw new Exception('openId 错误');

            $page = B()->getData($param, QueueConfig::PARAM_KEY_MINI_PAGE);

            $templateData = B()->getData($param, QueueConfig::PARAM_KEY_MINI_DATA);

            $this->mini->sendSubScribeMsg($templateId, $openId, $page, $templateData);
        } catch (Exception $e) {
            BaseService::getInstance()->addLog($e->getMessage(), $e);
        }

        $parentProcess = $this->getParentProcess();

        if ($parentProcess instanceof PipeProcess) $parentProcess->onHandler($data);
    }
}