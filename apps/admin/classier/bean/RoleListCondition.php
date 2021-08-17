<?php

namespace apps\admin\classier\bean;


use apps\core\classier\bean\PageListCondition;

class RoleListCondition extends PageListCondition
{
    /**
     * @var string|int|null
     */
    private $adminId;

    /**
     * @return int|string|null
     */
    public function getAdminId()
    {
        return $this->adminId;
    }

    /**
     * @param int|string|null $adminId
     */
    public function setAdminId($adminId): void
    {
        $this->adminId = $adminId;
    }

    /**
     * @param string|null $order_name
     */
    public function setOrderName(?string $order_name)
    {
        parent::setOrderName($order_name ? $order_name : 'id');
    }

    /**
     * @param string|null $order_type
     */
    public function setOrderType(?string $order_type)
    {
        parent::setOrderType($order_type ? $order_type : 'ASC');
    }
}