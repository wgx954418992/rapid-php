<?php


namespace apps\queue\classier\process\integral;

use apps\queue\classier\event\integral\ChangeEvent;
use apps\queue\classier\helper\ProcessHelper;
use apps\queue\classier\process\PipeProcess;
use Exception;

class ChangeProcess extends PipeProcess
{

    /**
     * @param $data
     * @return void
     * @throws Exception
     */
    public function onHandler($data)
    {
        /** @var ChangeEvent $event */
        $event = ProcessHelper::toQueueEvent($data, ChangeEvent::class);

        if (empty($event->getIID())) throw new Exception('积分id错误!');

        if (empty($event->getDID())) throw new Exception('详情id错误!');

        $parentProcess = parent::getParentProcess();

        if ($parentProcess instanceof PipeProcess) $parentProcess->onHandler($data);
    }


}
