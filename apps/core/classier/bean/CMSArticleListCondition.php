<?php

namespace apps\core\classier\bean;

class CMSArticleListCondition extends BaseListCondition
{
    /**
     * pager
     */
    use PageListCondition;

    /**
     * 栏目id
     * @var int|null
     */
    public $column_id;

    /**
     * @return int|null
     */
    public function getColumnId(): ?int
    {
        return $this->column_id;
    }

    /**
     * @param int|null $column_id
     */
    public function setColumnId(?int $column_id): void
    {
        $this->column_id = $column_id;
    }
}
