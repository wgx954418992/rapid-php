<?php


namespace apps\queue\classier\event\integral;

use apps\queue\classier\enum\Type;
use apps\queue\classier\event\QueueEvent;

class ChangeEvent extends QueueEvent
{

    /**
     * 积分更改
     */
    const NAME = Type::INTEGRAL_CHANGE;

    /**
     * 积分 id
     * @var int|string|null
     */
    protected $IID;

    /**
     * 详情 id
     * @var int|string|null
     */
    protected $DID;

    /**
     * @return int|string|null
     */
    public function getIID()
    {
        return $this->IID;
    }

    /**
     * @param int|string|null $IID
     */
    public function setIID($IID): void
    {
        $this->IID = $IID;
    }

    /**
     * @return int|string|null
     */
    public function getDID()
    {
        return $this->DID;
    }

    /**
     * @param int|string|null $DID
     */
    public function setDID($DID): void
    {
        $this->DID = $DID;
    }
}
