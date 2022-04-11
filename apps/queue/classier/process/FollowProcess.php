<?php


namespace apps\queue\classier\process;

use apps\core\classier\enum\notify\Event;
use apps\core\classier\enum\notify\SenderType;
use apps\core\classier\service\FollowService;
use apps\core\classier\service\NotifyService;
use apps\core\classier\wrapper\NotifyWrapper;
use apps\queue\classier\event\FollowEvent;
use apps\queue\classier\helper\ProcessHelper;
use Exception;

class FollowProcess extends PipeProcess
{

    /**
     * @param $data
     * @return void
     * @throws Exception
     */
    public function onHandler($data)
    {
        /** @var FollowEvent $event */
        $event = ProcessHelper::toQueueEvent($data, FollowEvent::class);

        if (empty($event->getFID())) throw new Exception('关注id错误!');

        $followModel = FollowService::getInstance()->getFollow($event->getFID());

        $notify = new NotifyWrapper();

        $notify->setEvent(Event::FOLLOW);

        $notify->setFromId($followModel->getId());

        $notify->setSenderId($followModel->getFromId());

        $notify->setSenderType(SenderType::USER);

        $notify->setReceiverId($followModel->getToId());

        NotifyService::getInstance()->addedNotify($notify);

        $parentProcess = parent::getParentProcess();

        if ($parentProcess instanceof PipeProcess) $parentProcess->onHandler($data);
    }


}
