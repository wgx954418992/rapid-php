<?php


namespace apps\queue\classier\event\notify;

use apps\queue\classier\enum\Type;
use apps\queue\classier\event\QueueEvent;

class EmailNotifyEvent extends QueueEvent
{

    /**
     * 邮件通知
     */
    const NAME = Type::NOTIFY_EMAIL;

    /**
     * 接收者
     * @var string|null
     */
    private $REV;

    /**
     * title
     * @var string|null
     */
    private $T;

    /**
     * body
     * @var string|null
     */
    private $B;

    /**
     * 附件
     * @var string[]|null
     */
    private $A = [];

    /**
     * @return string|null
     */
    public function getREV(): ?string
    {
        return $this->REV;
    }

    /**
     * @param string|null $REV
     */
    public function setREV(?string $REV): void
    {
        $this->REV = $REV;
    }

    /**
     * @return string|null
     */
    public function getT(): ?string
    {
        return $this->T;
    }

    /**
     * @param string|null $T
     */
    public function setT(?string $T): void
    {
        $this->T = $T;
    }

    /**
     * @return string|null
     */
    public function getB(): ?string
    {
        return $this->B;
    }

    /**
     * @param string|null $B
     */
    public function setB(?string $B): void
    {
        $this->B = $B;
    }

    /**
     * @return string[]|null
     */
    public function getA(): ?array
    {
        return $this->A;
    }

    /**
     * @param string[]|null $A
     */
    public function setA(?array $A): void
    {
        $this->A = $A;
    }
}