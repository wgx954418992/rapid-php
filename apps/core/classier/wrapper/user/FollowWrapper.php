<?php


namespace apps\core\classier\wrapper\user;

use apps\core\classier\model\UserFollowModel;

class FollowWrapper extends UserFollowModel
{

    /**
     * type
     * @var int
     */
    private $type;

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }
}