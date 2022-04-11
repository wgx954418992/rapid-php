<?php

namespace apps\core\classier\bean;

class LogListCondition extends BaseListCondition
{

    /**
     * pager
     */
    use PageListCondition;

    /**
     * 日志类型
     * @var array|null
     */
    protected $type;

    /**
     * bind id
     * @var array|null
     */
    protected $bind_id;

    /**
     * @return array|null
     */
    public function getType(): ?array
    {
        return $this->type;
    }

    /**
     * @param $type
     */
    public function setType($type)
    {
        $this->type = $this->parseArray($type);
    }

    /**
     * @return array|null
     */
    public function getBindId(): ?array
    {
        return $this->bind_id;
    }

    /**
     * @param array|null $bind_id
     */
    public function setBindId(?array $bind_id): void
    {
        $this->bind_id = $bind_id;
    }


    /**
     * 获取 排序名称
     * @return string
     */
    public function getOrderName(): string
    {
        return 'add_time';
    }
}
