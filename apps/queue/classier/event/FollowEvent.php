<?php


namespace apps\queue\classier\event;

use apps\queue\classier\enum\Type;

class FollowEvent extends QueueEvent
{

    /**
     * 关注事件
     */
    const NAME = Type::FOLLOW;

    /**
     * 关注id
     * @var int|string|null
     */
    private $FID;

    /**
     * @return int|string|null
     */
    public function getFID()
    {
        return $this->FID;
    }

    /**
     * @param int|string|null $FID
     */
    public function setFID($FID): void
    {
        $this->FID = $FID;
    }
}
