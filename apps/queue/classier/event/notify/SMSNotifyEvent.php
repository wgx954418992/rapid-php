<?php


namespace apps\queue\classier\event\notify;


use apps\queue\classier\enum\Type;
use apps\queue\classier\event\QueueEvent;

class SMSNotifyEvent extends QueueEvent
{

    /**
     * 短信通知
     */
    const NAME = Type::NOTIFY_SMS;

    /**
     * 手机号码 telephone
     * @var string|array|null
     */
    private $T;

    /**
     * CodeType
     * @var string|null
     */
    private $CT;

    /**
     * 短信参数 param
     * @var array|null
     */
    private $TP;

    /**
     * @return string|null
     */
    public function getT(): ?string
    {
        return $this->T;
    }

    /**
     * @param string|array|null $T
     */
    public function setT(?string $T): void
    {
        $this->T = $T;
    }

    /**
     * @return string|null
     */
    public function getCT(): ?string
    {
        return $this->CT;
    }

    /**
     * @param string|null $CT
     */
    public function setCT(?string $CT): void
    {
        $this->CT = $CT;
    }

    /**
     * @return array|null
     */
    public function getTP(): ?array
    {
        return $this->TP;
    }

    /**
     * @param array|null $TP
     */
    public function setTP(?array $TP): void
    {
        $this->TP = $TP;
    }
}
