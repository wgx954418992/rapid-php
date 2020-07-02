<?php

namespace rapidPHP\plugin\model;


class QQOAuth2UserModel extends BaseOAuth2UserModel
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
     * @param int $year
     * @return self
     */
    public function setYear(?int $year): self
    {
        $this->year = $year;
        return $this;
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
     * @param array $vipInfo
     * @return self
     */
    public function setQQVipInfo(?array $vipInfo): self
    {
        $this->vipInfo = $vipInfo;
        return $this;
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