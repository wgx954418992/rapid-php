<?php


namespace apps\queue\classier\process\notify;

use apps\core\classier\config\wechat\MiniConfig;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\wechat\mini\TemplateType;
use apps\core\classier\service\CacheFactoryService;
use apps\queue\classier\event\notify\MiniNotifyEvent;
use apps\queue\classier\helper\ProcessHelper;
use apps\queue\classier\process\PipeProcess;
use Exception;
use ReflectionException;
use wxsdk\mini\classier\Mini;

class MiniProcess extends PipeProcess
{

    /**
     * @var Mini
     */
    private $mini;

    /**
     * MiniProcess
     * @param $mainProcess
     */
    public function __construct($mainProcess = null)
    {
        parent::__construct($mainProcess);

        $config = MiniConfig::getInstance();

        $this->mini = new Mini(CacheFactoryService::getICache(), $config->getAppid(), $config->getSecret());
    }

    /**
     * onHandler
     * @param $pid
     * @param $data
     * @return void
     * @throws ReflectionException
     * @throws Exception
     */
    public function onHandler($pid, $data)
    {
        /** @var MiniNotifyEvent $event */
        $event = ProcessHelper::toQueueEvent($data, MiniNotifyEvent::class);

        if (empty($event->getTID())) throw new Exception('模版id 错误');

        if (empty($event->getOID())) throw new Exception('open id 错误');

        $templateData = MiniConfig::getInstance()
            ->getTemplate(TemplateType::i($event->getTID()), $event->getD());

        $this->mini->sendSubScribeMsg($event->getTID(), $event->getOID(), $event->getP(), $templateData);

        $this->onComplete($pid, $data);
    }

    /**
     * @param $pid
     * @param $data
     * @return void
     */
    public function onComplete($pid, $data)
    {
        parent::onComplete($pid, $data);

        try {
            MasterDao::getSQLDB()->close();
        } catch (Exception $e) {

        }
    }

    /**
     * @param $pid
     * @param Exception $e
     * @param $data
     * @return void
     */
    public function onException($pid, Exception $e, $data)
    {
        parent::onException($pid, $e, $data);

        try {
            MasterDao::getSQLDB()->close();
        } catch (Exception $e) {

        }
    }
}