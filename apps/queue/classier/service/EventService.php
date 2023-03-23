<?php


namespace apps\queue\classier\service;


use apps\core\classier\model\AppQueueModel;
use apps\queue\classier\event\notify\EmailNotifyEvent;
use apps\queue\classier\event\notify\SMSNotifyEvent;
use apps\queue\classier\event\QueueEvent;
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
     * 添加邮件通知
     * @param $emails
     * @param EmailNotifyEvent $event
     * @throws Exception
     */
    public function addEmailNotifyEvent($emails, EmailNotifyEvent $event)
    {
        if (empty($emails)) throw new Exception('邮箱错误!');

        if (!is_array($emails)) $emails = [$emails];

        foreach ($emails as $email) {

            $event->setREV($email);

            if (empty($event->getBindId())) {
                $event->setBindId($event->getT());
            }

            $this->addQueueEvent($event);
        }
    }
}
