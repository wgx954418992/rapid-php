<?php

namespace apps\core\classier\bean;

class CashOutListCondition extends BaseListCondition
{

    /**
     * pager
     */
    use PageListCondition;

    /**
     * bind_id
     * @var string|int|null
     */
    protected $bind_id;

    /**
     * 状态
     * @var array|null
     */
    protected $status;


    /**
     * @return int|string|null
     */
    public function getBindId()
    {
        return $this->bind_id;
    }

    /**
     * @param int|string|null $bind_id
     */
    public function setBindId($bind_id): void
    {
        $this->bind_id = $bind_id;
    }


    /**
     * @return array|null
     */
    public function getStatus(): ?array
    {
        return $this->status;
    }

    /**
     * @param $status
     */
    public function setStatus($status)
    {
        $this->status = $this->parseArray($status);
    }

}
