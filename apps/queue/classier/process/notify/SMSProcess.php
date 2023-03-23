<?php


namespace apps\queue\classier\process\notify;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\CodeType;
use apps\core\classier\helper\CommonHelper;
use apps\core\classier\sender\sms\ISMSSender;
use apps\queue\classier\event\notify\SMSNotifyEvent;
use apps\queue\classier\helper\ProcessHelper;
use apps\queue\classier\process\PipeProcess;
use Exception;
use libphonenumber\PhoneNumber;
use ReflectionException;
use function rapidPHP\DI;

class SMSProcess extends PipeProcess
{

    /**
     * @param $pid
     * @param $data
     * @return void
     * @throws ReflectionException
     * @throws Exception
     */
    public function onHandler($pid, $data)
    {
        /** @var SMSNotifyEvent $event */
        $event = ProcessHelper::toQueueEvent($data, SMSNotifyEvent::class);

        if (empty($event->getT())) throw new Exception('telephone 错误');

        if (empty($event->getCT())) throw new Exception('templateId 错误');

        /** @var PhoneNumber $phoneNumber */
        $telephone = CommonHelper::validTelephone($event->getT(), $phoneNumber);

        /** @var ISMSSender $sender */
        $sender = DI(ISMSSender::class);

        $templateCode = $sender->getTemplateCode(CodeType::i($event->getCT()), $phoneNumber->getCountryCode());

        $sender->send($templateCode, $telephone, $event->getTP());

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
