<?php

namespace apps\core\classier\bean;


use apps\core\classier\options\user\MajorOptions;

class MajorListCondition extends BaseListCondition
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
     * 资质类型
     * @var int|null
     */
    protected $type;

    /**
     * 资质状态
     * @var int|null
     */
    protected $status;

    /**
     * @var MajorOptions|null
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
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     */
    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return MajorOptions|null
     */
    public function getOptions(): ?MajorOptions
    {
        return $this->options;
    }

    /**
     * @param $options
     */
    public function setOptions($options): void
    {
        if (is_numeric($options)) $options = MajorOptions::i($options);

        $this->options = $options;
    }
}
