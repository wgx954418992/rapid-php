<?php


namespace apps\admin\classier\wrapper;


use apps\core\classier\config\CompanyConfig;
use apps\core\classier\model\ViewCompanyModel;

class ViewCompanyWrapper extends ViewCompanyModel
{

    /**
     * 用户头像
     * @var string|null
     */
    private $head_pic;

    /**
     * 登录次数
     * @var int|null
     */
    private $login_count = 0;

    /**
     * 营业执照图片url
     * @var string|null
     */
    private $business_pic;

    /**
     * 状态文本
     * @var string|null
     */
    private $status_text;

    /**
     * @return int
     */
    public function getLoginCount(): int
    {
        return $this->login_count;
    }

    /**
     * @param int $login_count
     */
    public function setLoginCount(int $login_count): void
    {
        $this->login_count = $login_count;
    }

    /**
     * @return string
     */
    public function getHeadPic(): ?string
    {
        return $this->head_pic;
    }

    /**
     * @param string|null $head_pic
     * @return ViewCompanyWrapper
     */
    public function setHeadPic(?string $head_pic): self
    {
        $this->head_pic = $head_pic;

        return $this;
    }

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

    /**
     * @return string|null
     */
    public function getStatusText(): ?string
    {
        return $this->status_text;
    }

    public function setStatus(?int $status)
    {
        parent::setStatus($status);

        $this->status_text = CompanyConfig::getStatusText($status);
    }
}