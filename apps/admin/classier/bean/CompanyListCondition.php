<?php

namespace apps\admin\classier\bean;

use apps\core\classier\bean\PageListCondition;

class CompanyListCondition extends PageListCondition
{

    /**
     * @var int|null
     */
    private $status;

    /**
     * 用户来源
     * @var int|null
     */
    private $source = null;

    /**
     * 是否已经删除的
     * @var bool
     */
    private $is_delete;

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
     * @return bool
     */
    public function getIsDelete(): bool
    {
        return $this->is_delete;
    }

    /**
     * @param bool $is_delete
     */
    public function setIsDelete(bool $is_delete = false): void
    {
        $this->is_delete = $is_delete;
    }
}