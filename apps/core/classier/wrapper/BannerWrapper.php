<?php


namespace apps\core\classier\wrapper;


use apps\core\classier\model\AppBannerModel;

class BannerWrapper extends AppBannerModel
{

    /**
     * 图片地址
     * @var string|null
     */
    protected $pic_url;

    /**
     * @return string|null
     */
    public function getPicUrl(): ?string
    {
        return $this->pic_url;
    }

    /**
     * @param string|null $pic_url
     */
    public function setPicUrl(?string $pic_url): void
    {
        $this->pic_url = $pic_url;
    }
}
