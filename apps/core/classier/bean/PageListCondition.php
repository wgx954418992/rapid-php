<?php

namespace apps\core\classier\bean;

use function rapidPHP\B;

class PageListCondition
{

    /**
     * 指定id
     * @var array|null
     */
    private $ids;

    /**
     * 关键字
     * @var string
     */
    private $keyword = '';

    /**
     * 加载页数
     * @var int
     */
    private $page = 1;

    /**
     * 排序类型
     * @var string
     */
    private $order_type = '';

    /**
     * 排序名称
     * @var string
     */
    private $order_name = '';

    /**
     * 开始时间
     * @var string
     */
    private $start_time = '';

    /**
     * 结束时间
     * @var string
     */
    private $end_time = '';
    
    /**
     * @return array
     */
    public function getIds(): ?array
    {
        return $this->ids;
    }

    /**
     * @param array $ids
     */
    public function setIds(array $ids): void
    {
        $this->ids = $ids;
    }

    /**
     * @return string
     */
    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    /**
     * @param string|null $keyword
     */
    public function setKeyword(?string $keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * @return int
     */
    public function getPage(): ?int
    {
        return B()->contrast($this->page, 1);
    }

    /**
     * @param int|null $page
     */
    public function setPage(?int $page)
    {
        $this->page = $page;
    }

    /**
     * @return string
     */
    public function getOrderType(): ?string
    {
        $orderType = strtoupper($this->order_type);

        if (empty($orderType)) $orderType = 'DESC';

        if ($orderType != 'DESC' && $orderType != 'ASC') return 'DESC';

        return $orderType;
    }

    /**
     * @param string|null $order_type
     */
    public function setOrderType(?string $order_type)
    {
        $this->order_type = $order_type;


    }

    /**
     * @return string
     */
    public function getOrderName(): ?string
    {
        return B()->contrast($this->order_name, 'created_time');
    }

    /**
     * @param string|null $order_name
     */
    public function setOrderName(?string $order_name)
    {
        $this->order_name = $order_name;
    }

    /**
     * @return string
     */
    public function getStartTime(): ?string
    {
        return $this->start_time;
    }

    /**
     * @param string|null $start_time
     */
    public function setStartTime(?string $start_time)
    {
        $this->start_time = $start_time;
    }

    /**
     * @return string
     */
    public function getEndTime(): ?string
    {
        return $this->end_time;
    }

    /**
     * @param string|null $end_time
     */
    public function setEndTime(?string $end_time)
    {
        $this->end_time = $end_time;
    }
}