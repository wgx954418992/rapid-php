<?php


namespace apps\core\classier\wrapper\user;


use apps\core\classier\bean\AreaAddressBean;
use apps\core\classier\model\UserAddressModel;

class AddressWrapper extends UserAddressModel
{

    /**
     * 地址详情
     * @var AreaAddressBean|null
     */
    private $address_detail;

    /**
     * @return AreaAddressBean|null
     */
    public function getAddressDetail(): ?AreaAddressBean
    {
        return $this->address_detail;
    }

    /**
     * @param AreaAddressBean|null $address_detail
     */
    public function setAddressDetail(?AreaAddressBean $address_detail): void
    {
        $this->address_detail = $address_detail;
    }
}