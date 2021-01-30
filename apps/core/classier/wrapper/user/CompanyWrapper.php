<?php


namespace apps\core\classier\wrapper\user;


use apps\core\classier\model\UserCompanyModel;

class CompanyWrapper extends UserCompanyModel
{

    /**
     * 营业执照图片url
     * @var string|null
     */
    private $business_pic;

    /**
     * @return string|null
     */
    public function getBusinessPic(): ?string
    {
        return $this->business_pic;
    }

    /**
     * @param string|null $business_pic
     */
    public function setBusinessPic(?string $business_pic): void
    {
        $this->business_pic = $business_pic;
    }


}