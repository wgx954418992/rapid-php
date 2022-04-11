<?php


namespace apps\core\classier\wrapper;

use apps\core\classier\model\AppNotifyModel;
use function rapidPHP\B;

class NotifyWrapper extends AppNotifyModel
{

    /**
     * 发送者 options
     * @var UserWrapper|object|array|null
     */
    private $sender;

    /**
     * 相关
     * @var array|UserWrapper[]|null
     */
    private $relevant;

    /**
     * @return UserWrapper|array|object|null
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param UserWrapper|array|object|null $sender
     */
    public function setSender($sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @return UserWrapper[]|array|null
     */
    public function getRelevant(): ?array
    {
        return $this->relevant;
    }

    /**
     * @param UserWrapper[]|array|null $relevant
     */
    public function setRelevant(?array $relevant): void
    {
        $this->relevant = $relevant;
    }

    /**
     * options to array
     * @return array
     */
    public function optionsToArray()
    {
        $options = parent::getOptions();

        if (is_string($options)) $options = B()->jsonDecode($options);

        return (array)$options;
    }

}
