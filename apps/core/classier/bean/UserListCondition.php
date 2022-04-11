<?php

namespace apps\core\classier\bean;

use apps\core\classier\options\UserOptions;

class UserListCondition extends BaseListCondition
{
    /**
     * pager
     */
    use PageListCondition;

    /**
     * 用户id
     * @var string|int|null
     */
    protected $user_id;

    /**
     * 用户类型
     * @var int|null
     */
    protected $type;

    /**
     * 用户来源
     * @var int|null
     */
    protected $source = null;

    /**
     * @var UserOptions|null
     */
    protected $options;

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
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int|null $type
     */
    public function setType(?int $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int|null
     */
    public function getSource(): ?int
    {
        return $this->source;
    }

    /**
     * @param int|null $source
     */
    public function setSource(?int $source): void
    {
        $this->source = $source;
    }

    /**
     * @return UserOptions|null
     */
    public function getOptions(): ?UserOptions
    {
        return $this->options;
    }

    /**
     * @param $options
     */
    public function setOptions($options): void
    {
        if (is_numeric($options)) $options = UserOptions::i($options);

        $this->options = $options;
    }
}
