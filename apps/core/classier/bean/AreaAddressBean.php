<?php

namespace apps\core\classier\bean;

class AreaAddressBean
{

    /**
     * 省id
     * @var int|null
     */
    private $province_id;

    /**
     * 省名称
     * @var string|null
     */
    private $province_name;

    /**
     * 省名称（英文）
     * @var string|null
     */
    private $province_en;

    /**
     * 省code
     * @var string|null
     */
    private $province_code;

    /**
     * 国家id
     * @var int|null
     */
    private $country_id;

    /**
     * 国家名称
     * @var string|null
     */
    private $country_name;

    /**
     * 国家名称（英文）
     * @var string|null
     */
    private $country_en;

    /**
     * 国家code
     * @var string|null
     */
    private $country_code;

    /**
     * 州id
     * @var int|null
     */
    private $state_id;

    /**
     * 州名称
     * @var string|null
     */
    private $state_name;

    /**
     * 州名称（英文）
     * @var string|null
     */
    private $state_en;

    /**
     * 州code
     * @var string|null
     */
    private $state_code;

    /**
     * 详细地址
     * @var string|null
     */
    private $address;

    /**
     * @return int|null
     */
    public function getProvinceId(): ?int
    {
        return $this->province_id;
    }

    /**
     * @param int|null $province_id
     * @return  self
     */
    public function setProvinceId(?int $province_id): self
    {
        $this->province_id = $province_id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getProvinceName(): ?string
    {
        return $this->province_name;
    }

    /**
     * @param string|null $province_name
     * @return  self
     */
    public function setProvinceName(?string $province_name): self
    {
        $this->province_name = $province_name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getProvinceEn(): ?string
    {
        return $this->province_en;
    }

    /**
     * @param string|null $province_en
     * @return  self
     */
    public function setProvinceEn(?string $province_en): self
    {
        $this->province_en = $province_en;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getProvinceCode(): ?string
    {
        return $this->province_code;
    }

    /**
     * @param string|null $province_code
     * @return AreaAddressBean
     */
    public function setProvinceCode(?string $province_code): self
    {
        $this->province_code = $province_code;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->country_code;
    }

    /**
     * @param string|null $country_code
     * @return AreaAddressBean
     */
    public function setCountryCode(?string $country_code): self
    {
        $this->country_code = $country_code;

        return $this;
    }


    /**
     * @return int|null
     */
    public function getCountryId(): ?int
    {
        return $this->country_id;
    }

    /**
     * @param int|null $country_id
     * @return  self
     */
    public function setCountryId(?int $country_id): self
    {
        $this->country_id = $country_id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountryName(): ?string
    {
        return $this->country_name;
    }

    /**
     * @param string|null $country_name
     * @return  self
     */
    public function setCountryName(?string $country_name): self
    {
        $this->country_name = $country_name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountryEn(): ?string
    {
        return $this->country_en;
    }

    /**
     * @param string|null $country_en
     * @return  self
     */
    public function setCountryEn(?string $country_en): self
    {
        $this->country_en = $country_en;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getStateId(): ?int
    {
        return $this->state_id;
    }

    /**
     * @param int|null $state_id
     * @return  self
     */
    public function setStateId(?int $state_id): self
    {
        $this->state_id = $state_id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStateName(): ?string
    {
        return $this->state_name;
    }

    /**
     * @param string|null $state_name
     * @return  self
     */
    public function setStateName(?string $state_name): self
    {
        $this->state_name = $state_name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStateEn(): ?string
    {
        return $this->state_en;
    }

    /**
     * @param string|null $state_en
     * @return  self
     */
    public function setStateEn(?string $state_en): self
    {
        $this->state_en = $state_en;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStateCode(): ?string
    {
        return $this->state_code;
    }

    /**
     * @param string|null $state_code
     * @return AreaAddressBean
     */
    public function setStateCode(?string $state_code): self
    {
        $this->state_code = $state_code;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     * @return  self
     */
    public function setAddress(?string $address): self
    {
        $this->address = $address;
        return $this;
    }

}