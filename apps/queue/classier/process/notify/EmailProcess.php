<?php


namespace apps\queue\classier\process\notify;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\sender\email\IEmailSender;
use apps\queue\classier\event\notify\EmailNotifyEvent;
use apps\queue\classier\helper\ProcessHelper;
use apps\queue\classier\process\PipeProcess;
use Exception;
use function rapidPHP\DI;

class EmailProcess extends PipeProcess
{

    /**
     * @param $pid
     * @param $data
     * @return void
     * @throws Exception
     */
    public function onHandler($pid, $data)
    {
        /** @var EmailNotifyEvent $event */
        $event = ProcessHelper::toQueueEvent($data, EmailNotifyEvent::class);

        if (empty($event->getREV())) throw new Exception('接收者 错误');

        if (empty($event->getT())) throw new Exception('title 错误');

        if (empty($event->getB())) throw new Exception('body 错误');

        /** @var IEmailSender $sender */
        $sender = DI(IEmailSender::class);

        $sender->send($event->getT(), $event->getB(), $event->getREV());

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