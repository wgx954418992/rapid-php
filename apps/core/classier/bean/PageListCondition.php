<?php

namespace apps\core\classier\bean;

use function rapidPHP\B;

trait PageListCondition
{

    /**
     * 加载页数
     * @var int
     */
    protected $page = 1;

    /**
     * 页数大小
     * @var int
     */
    protected $size = 10;

    /**
     * @return int
     */
    public function getPage(): int
    {
        return B()->contrast($this->page, 1);
    }

    /**
     * @param int $page
     */
    public function setPage(int $page)
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int|null $size
     */
    public function setSize(?int $size): void
    {
        if (is_null($size)) $size = 10;

        $this->size = min(100, max(1, $size));
    }

}
