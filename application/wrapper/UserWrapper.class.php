<?php

namespace application\wrapper;

use application\model\AppUserModel;

class UserWrapper extends AppUserModel
{

    public $head_pic;

    /**
     * @return mixed
     */
    public function getHeadPic()
    {
        return $this->head_pic;
    }

    /**
     * @param mixed $head_pic
     */
    public function setHeadPic($head_pic): void
    {
        $this->head_pic = $head_pic;
    }
}