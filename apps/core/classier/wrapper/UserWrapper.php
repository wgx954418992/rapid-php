<?php


namespace apps\core\classier\wrapper;


use apps\core\classier\config\UserConfig;
use apps\core\classier\model\AppUserModel;

class UserWrapper extends AppUserModel
{

    /**
     * 用户头像
     * @var string|null
     */
    private $head_pic;

    /**
     * @return string
     */
    public function getHeadPic(): ?string
    {
        return $this->head_pic;
    }

    /**
     * @param string|null $head_pic
     * @return UserWrapper
     */
    public function setHeadPic(?string $head_pic): self
    {
        $this->head_pic = $head_pic;

        return $this;
    }


}