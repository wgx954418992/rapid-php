<?php

namespace apps\core\classier\bean;

use rapidPHP\modules\core\classier\Model;

class AreaAddressBean extends Model
{

    /**
     * 最后一级id
     * @var int|null
     */
    protected $last_id;

    /**
     * 最后一级地区名称
     * @var string|null
     */
    protected $last_name;

    /**
     * 地区id
     * @var int|null
     */
    protected $area_id;

    /**
     * 地区名称
     * @var string|null
     */
    protected $area_name;

    /**
     * 城市id
     * @var int|null
     */
    protected $city_id;

    /**
     * 城市id
     * @var string|null
     */
    protected $city_name;

    /**
     * 省id
     * @var int|null
     */
    protected $province_id;

    /**
     * 省名称
     * @var string|null
     */
    protected $province_name;

    /**
     * 详细地址
     * @var string|null
     */
    protected $address;

    /**
     * @return int|null
     */
    public function getLastId(): ?int
    {
        return $this->last_id;
    }

    /**
     * @param int|null $last_id
     * @return AreaAddressBean
     */
    public function setLastId(?int $last_id)
    {
        $this->last_id = $last_id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    /**
     * @param string|null $last_name
     * @return AreaAddressBean
     */
    public function setLastName(?string $last_name)
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * @return int
     */
    public function getAreaId(): ?int
    {
        return $this->area_id;
    }

    /**
     * @param int|null $area_id
     * @return self
     */
    public function setAreaId(?int $area_id): self
    {
        $this->area_id = $area_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getAreaName(): string
    {
        return $this->area_name;
    }

    /**
     * @param string|null $area_name
     * @return self
     */
    public function setAreaName(?string $area_name): self
    {
        $this->area_name = $area_name;
        return $this;
    }

    /**
     * @return int
     */
    public function getCityId(): ?int
    {
        return $this->city_id;
    }

    /**
     * @param int|null $city_id
     * @return self
     */
    public function setCityId(?int $city_id): self
    {
        $this->city_id = $city_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCityName(): string
    {
        return $this->city_name;
    }

    /**
     * @param string|null $city_name
     * @return self
     */
    public function setCityName(?string $city_name): self
    {
        $this->city_name = $city_name;
        return $this;
    }

    /**
     * @return int
     */
    public function getProvinceId(): ?int
    {
        return $this->province_id;
    }

    /**
     * @param int|null $province_id
     * @return self
     */
    public function setProvinceId(?int $province_id): self
    {
        $this->province_id = $province_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getProvinceName(): string
    {
        return $this->province_name;
    }

    /**
     * @param string|null $province_name
     * @return self
     */
    public function setProvinceName(?string $province_name): self
    {
        $this->province_name = $province_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     * @return self
     */
    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->address;
    }
}
