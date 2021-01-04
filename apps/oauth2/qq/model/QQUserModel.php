<?php

namespace oauth2\qq\model;

use oauth2\core\model\BaseUserModel;

class QQUserModel extends BaseUserModel
{
    /**
     * @var int|null
     */
    public $year;

    /**
     * @var array|null
     */
    public $vipInfo;

    /**
     * 设置出生年
     * @param int|null $year
     */
    public function setYear(?int $year)
    {
        $this->year = $year;
    }

    /**
     * 获取获取出生年
     * @return int
     */
    public function getYear(): ?int
    {
        return $this->year;
    }


    /**
     * 设置qq会员信息
     * @param array|null $vipInfo
     */
    public function setQQVipInfo(?array $vipInfo)
    {
        $this->vipInfo = $vipInfo;
    }

    /**
     * 获取qq会员信息
     * @return array
     */
    public function getQQVipInfo(): ?array
    {
        return $this->vipInfo;
    }
}