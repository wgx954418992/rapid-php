<?php


namespace apps\core\classier\wrapper;


use apps\core\classier\bean\AreaAddressBean;
use apps\core\classier\model\AppAddressModel;

class AddressWrapper extends AppAddressModel
{

    /**
     * @var string|null
     */
    private $tcode;

    /**
     * 地址详情
     * @var AreaAddressBean|null
     */
    private $address_detail;

    /**
     * @return string|null
     */
    public function getTcode(): ?string
    {
        return $this->tcode;
    }

    /**
     * @param string|null $tcode
     */
    public function setTcode(?string $tcode): void
    {
        $this->tcode = ($tcode && substr($tcode, 0, 1) !== '+') ? '+' . $tcode : $tcode;
    }

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