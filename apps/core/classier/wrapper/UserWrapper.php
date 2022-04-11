<?php

namespace apps\core\classier\wrapper;

use apps\core\classier\bean\SpecificMajorBean;
use apps\core\classier\model\AppMajorModel;
use apps\core\classier\model\AppPointModel;
use apps\core\classier\model\AppUserModel;
use apps\core\classier\wrapper\user\FollowWrapper;
use apps\core\classier\wrapper\user\MemberWrapper;

class UserWrapper extends AppUserModel
{

    /**
     * 用户头像
     * @var string|null
     */
    protected $avatar;

    /**
     * 年龄
     * @var int
     */
    protected $age;

    /**
     * 专业
     * @var AppMajorModel|null
     */
    protected $major;

    /**
     * 顶级专业
     * @var AppMajorModel|null
     */
    protected $top_major;

    /**
     * 专业
     * @var SpecificMajorBean|null
     */
    protected $specific_major;

    /**
     * 会员
     * @var MemberWrapper|null
     */
    protected $member;

    /**
     * 余额
     * @var AppPointModel|null
     */
    protected $wallet;

    /**
     * 积分
     * @var AppPointModel|null
     */
    protected $integral;

    /**
     * 获取该用户与当前用户的关注信息，可以为null
     * @var FollowWrapper|null
     */
    protected $follow;

    /**
     * @return string|null
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    /**
     * @param string|null $avatar
     */
    public function setAvatar(?string $avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    /**
     * @return AppMajorModel|null
     */
    public function getMajor(): ?AppMajorModel
    {
        return $this->major;
    }

    /**
     * @param AppMajorModel|null $major
     */
    public function setMajor(?AppMajorModel $major): void
    {
        $this->major = $major;
    }

    /**
     * @return AppMajorModel|null
     */
    public function getTopMajor(): ?AppMajorModel
    {
        return $this->top_major;
    }

    /**
     * @param AppMajorModel|null $top_major
     */
    public function setTopMajor(?AppMajorModel $top_major): void
    {
        $this->top_major = $top_major;
    }


    /**
     * @return SpecificMajorBean|null
     */
    public function getSpecificMajor(): ?SpecificMajorBean
    {
        return $this->specific_major;
    }

    /**
     * @param SpecificMajorBean|null $specific_major
     */
    public function setSpecificMajor(?SpecificMajorBean $specific_major): void
    {
        $this->specific_major = $specific_major;
    }


    /**
     * @return MemberWrapper|null
     */
    public function getMember(): ?MemberWrapper
    {
        return $this->member;
    }

    /**
     * @param MemberWrapper|null $member
     */
    public function setMember(?MemberWrapper $member): void
    {
        $this->member = $member;
    }

    /**
     * @return AppPointModel|null
     */
    public function getWallet(): ?AppPointModel
    {
        return $this->wallet;
    }

    /**
     * @param AppPointModel|null $wallet
     */
    public function setWallet(?AppPointModel $wallet): void
    {
        $this->wallet = $wallet;
    }

    /**
     * @return AppPointModel|null
     */
    public function getIntegral(): ?AppPointModel
    {
        return $this->integral;
    }

    /**
     * @param AppPointModel|null $integral
     */
    public function setIntegral(?AppPointModel $integral): void
    {
        $this->integral = $integral;
    }

    /**
     * @return FollowWrapper|null
     */
    public function getFollow(): ?FollowWrapper
    {
        return $this->follow;
    }

    /**
     * @param FollowWrapper|null $follow
     */
    public function setFollow(?FollowWrapper $follow): void
    {
        $this->follow = $follow;
    }

    /**
     * 获取display name
     * @return string|null
     */
    public function getDisplayName(): ?string
    {
        if (!empty($this->getNickname())) {
            return $this->getNickname();
        } else {
            return $this->getUsername();
        }
    }

}
