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
     * 登录次数
     * @var int
     */
    private $login_count = 0;

    /**
     * 用户性别
     * @var string|null
     */
    public $gender_text;


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
     * @return UserWrapper
     */
    public function setHeadPic(?string $head_pic): self
    {
        $this->head_pic = $head_pic;

        return $this;
    }

    /**
     * @param int|null $gender
     */
    public function setGender(?int $gender)
    {
        // TODO: Change the autogenerated stub
        $this->gender_text = UserConfig::getGenderTypeText($gender);

        parent::setGender($gender);
    }

    /**
     * @return string
     */
    public function getGenderText(): ?string
    {
        return $this->gender_text;
    }

}