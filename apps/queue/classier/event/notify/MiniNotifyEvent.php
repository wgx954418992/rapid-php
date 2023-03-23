<?php


namespace apps\queue\classier\event\notify;


use apps\queue\classier\enum\Type;
use apps\queue\classier\event\QueueEvent;

class MiniNotifyEvent extends QueueEvent
{

    /**
     * 短信通知
     */
    const NAME = Type::NOTIFY_MINI;

    /**
     * 模版id
     * @var string|null
     */
    protected $TID;

    /**
     * open id
     * @var string|null
     */
    protected $OID;

    /**
     * page
     * @var string|null
     */
    protected $P;

    /**
     * data
     * @var string|null
     */
    protected $D;

    /**
     * @return string|null
     */
    public function getP(): ?string
    {
        return $this->P;
    }

    /**
     * @param string|null $P
     */
    public function setP(?string $P): void
    {
        $this->P = $P;
    }

    /**
     * @return string|null
     */
    public function getTID(): ?string
    {
        return $this->TID;
    }

    /**
     * @param string|null $TID
     */
    public function setTID(?string $TID): void
    {
        $this->TID = $TID;
    }

    /**
     * @return string|null
     */
    public function getOID(): ?string
    {
        return $this->OID;
    }

    /**
     * @param string|null $OID
     */
    public function setOID(?string $OID): void
    {
        $this->OID = $OID;
    }

    /**
     * @return string|null
     */
    public function getD(): ?string
    {
        return $this->D;
    }

    /**
     * @param string|null $D
     */
    public function setD(?string $D): void
    {
        $this->D = $D;
    }
}
