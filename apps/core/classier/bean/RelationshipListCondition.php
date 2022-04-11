<?php

namespace apps\core\classier\bean;

use apps\core\classier\options\UserOptions;
use function rapidPHP\B;

class RelationshipListCondition extends BaseListCondition
{

    /**
     * pager
     */
    use PageListCondition;

    /**
     * 关注
     */
    const MODE_FOLLOW = 1;

    /**
     * 粉丝
     */
    const MODE_FANS = 2;

    /**
     * 类型 单向关注或者双向关注
     * @var int[]|null
     */
    protected $type;

    /**
     * 模式 1 关注 2 粉丝
     * @var int
     */
    protected $mode;

    /**
     * 用户id
     * @var string|int|null
     */
    protected $user_id;

    /**
     * 自身id
     * @var string|int|null
     */
    protected $self_uid;

    /**
     * user options
     * @var UserOptions|null
     */
    protected $user_options;

    /**
     * @return int[]
     */
    public function getType(): array
    {
        return $this->type ?? [];
    }

    /**
     * @param string|array|null $type
     */
    public function setType($type): void
    {
        if (!empty($type)) {
            if (is_string($type)) {
                $type = explode(',', $type);
            } else if (is_numeric($type)) {
                $type = [$type];
            }
        } else {
            $type = null;
        }

        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getMode(): int
    {
        return $this->mode;
    }

    /**
     * @param int $mode
     */
    public function setMode(int $mode): void
    {
        $this->mode = $mode;
    }

    /**
     * @return int|string|null
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param int|string|null $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }


    /**
     * @return int|string|null
     */
    public function getSelfUid()
    {
        return $this->self_uid;
    }

    /**
     * @param int|string|null $self_uid
     */
    public function setSelfUid($self_uid): void
    {
        $this->self_uid = $self_uid;
    }


    /**
     * @return UserOptions|null
     */
    public function getUserOptions(): ?UserOptions
    {
        return $this->user_options;
    }

    /**
     * @param  $user_options
     */
    public function setUserOptions($user_options): void
    {
        if (is_numeric($user_options)) $user_options = UserOptions::i($user_options);

        $this->user_options = $user_options;
    }

    /**
     * @return string
     */
    public function getOrderName(): string
    {
        return B()->contrast($this->order_name, 'apply_time');
    }
}
