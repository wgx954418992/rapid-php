<?php


namespace apps\queue\classier\service;


use apps\core\classier\model\AppQueueModel;
use apps\queue\classier\event\FollowEvent;
use apps\queue\classier\event\integral\ChangeEvent;
use apps\queue\classier\event\QueueEvent;
use apps\queue\classier\event\SMSNotifyEvent;
use Exception;
use rapidPHP\modules\common\classier\Instances;

class EventService
{

    /**
     * 使用单例模式
     */
    use Instances;

    /**
     * 不存在创建
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * 添加队列event
     * @param QueueEvent $event
     * @return AppQueueModel
     * @throws Exception
     */
    public function addQueueEvent(QueueEvent $event)
    {
        return QueueService::getInstance()->addQueue(
            $event::NAME,
            $event->toSelfData(),
            $event->getBindId(),
            $event->getTriggerTime(),
            $event->getCreatedId(),
            $event->getParentId()
        );
    }


    /**
     * 添加短信模板通知事件 单条或者多条
     * @param $telephones
     * @param SMSNotifyEvent $event
     * @throws Exception
     */
    public function addSMSNotifyEvent($telephones, SMSNotifyEvent $event)
    {
        if (empty($telephones)) throw new Exception('手机号码错误错误!');

        if (empty($event->getCT())) throw new Exception('templateId错误!');

        if (!is_array($telephones)) $telephones = [$telephones];

        foreach ($telephones as $telephone) {

            $event->setT($telephone);

            if (empty($event->getBindId())) {
                $event->setBindId($event->getT());
            }

            $this->addQueueEvent($event);
        }
    }


    /**
     * 添加关注事件
     * @param $followId
     * @throws Exception
     */
    public function addFollowEvent($followId)
    {
        $event = new FollowEvent();

        $event->setFID($followId);

        $event->setBindId($followId);

        $event->setTriggerTime(time());

        $this->addQueueEvent($event);
    }

    /**
     * 积分更改事件
     * @param $integralId
     * @param $detailId
     * @throws Exception
     */
    public function addIntegralChangeEvent($integralId, $detailId)
    {
        $event = new ChangeEvent();

        $event->setIID($integralId);

        $event->setDID($detailId);

        $event->setBindId($detailId);

        $event->setTriggerTime(time());

        $this->addQueueEvent($event);
    }

}
