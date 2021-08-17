<?php


namespace apps\admin\classier\bean;


use apps\core\classier\bean\PageListCondition;

class RouteListCondition extends PageListCondition
{
    /**
     * @var bool|null
     */
    private $isCache;

    /**
     * 管理员类型
     * @var int|null
     */
    private $type;

    /**
     * @return bool|null
     */
    public function getIsCache(): ?bool
    {
        return $this->isCache;
    }

    /**
     * @param bool|null $isCache
     */
    public function setIsCache(?bool $isCache): void
    {
        $this->isCache = $isCache;
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
     * @param string|null $order_name
     */
    public function setOrderName(?string $order_name)
    {
        parent::setOrderName($order_name ? $order_name : 'rank');
    }

    /**
     * @param string|null $order_type
     */
    public function setOrderType(?string $order_type)
    {
        parent::setOrderType(!empty($order_type) ? $order_type : 'ASC');
    }
}
