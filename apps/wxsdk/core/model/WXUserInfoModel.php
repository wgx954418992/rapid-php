<?php

namespace wxsdk\core\model;


use function rapidPHP\B;

class WXUserInfoModel
{

    /**
     * @var string|null
     */
    public $openId;

    /**
     * @var string|null
     */
    public $unionId;

    /**
     * @var string|null
     */
    public $nickname;

    /**
     * @var string|null
     */
    public $header;

    /**
     * @var int|string|null
     */
    public $gender;

    /**
     * @var string|null
     */
    public $language;

    /**
     * @var string|null
     */
    public $country;

    /**
     * @var string|null
     */
    public $province;

    /**
     * @var string|null
     */
    public $city;

    /**
     * 是否关注
     * @var bool|null
     */
    public $is_subscribe;

    /**
     * 关注时间戳
     * @var int|null
     */
    public $subscribe_time;

    /**
     * 备注
     * @var string|null
     */
    public $remark;

    /**
     * groupid
     * @var int|null
     */
    public $groupId;

    /**
     * tagId_list
     * @var array|null
     */
    public $tagIdList = [];

    /**
     * 关注场景
     * @var string|null
     */
    public $subscribeScene;

    /**
     * 扫码场景
     * @var string|null
     */
    public $qrScene;

    /**
     * 扫码参数
     * @var string|null
     */
    public $qrSceneStr;

    /**
     * @return string|null
     */
    public function getOpenId(): ?string
    {
        return $this->openId;
    }

    /**
     * @param string|null $openId
     */
    public function setOpenId(?string $openId): void
    {
        $this->openId = $openId;
    }

    /**
     * @return string|null
     */
    public function getUnionId(): ?string
    {
        return $this->unionId;
    }

    /**
     * @param string|null $unionId
     */
    public function setUnionId(?string $unionId): void
    {
        $this->unionId = $unionId;
    }

    /**
     * @return string|null
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * @param string|null $nickname
     */
    public function setNickname(?string $nickname): void
    {
        $this->nickname = $nickname;
    }

    /**
     * @return string|null
     */
    public function getHeader(): ?string
    {
        return $this->header;
    }

    /**
     * @param string|null $header
     */
    public function setHeader(?string $header): void
    {
        $this->header = $header;
    }

    /**
     * @return int|null
     */
    public function getGender(): ?int
    {
        return $this->gender;
    }

    /**
     * @param int|string|null $gender
     */
    public function setGender($gender): void
    {
        if (!is_numeric($gender)) $gender = B()->getData(['男' => 1, '女' => 2], (string)$gender);

        $this->gender = $gender;
    }

    /**
     * @return string|null
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * @param string|null $language
     */
    public function setLanguage(?string $language = 'zh_CN'): void
    {
        $this->language = $language;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     */
    public function setCountry(?string $country = '中国'): void
    {
        $this->country = $country;
    }

    /**
     * @return string|null
     */
    public function getProvince(): ?string
    {
        return $this->province;
    }

    /**
     * @param string|null $province
     */
    public function setProvince(?string $province): void
    {
        $this->province = $province;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return bool|null
     */
    public function getIsSubscribe(): ?bool
    {
        return $this->is_subscribe;
    }

    /**
     * @param bool|null $is_subscribe
     */
    public function setIsSubscribe(?bool $is_subscribe = false): void
    {
        $this->is_subscribe = $is_subscribe;
    }

    /**
     * @return int|null
     */
    public function getSubscribeTime(): ?int
    {
        return $this->subscribe_time;
    }

    /**
     * @param int|null $subscribe_time
     */
    public function setSubscribeTime(?int $subscribe_time): void
    {
        $this->subscribe_time = $subscribe_time;
    }

    /**
     * @return string|null
     */
    public function getRemark(): ?string
    {
        return $this->remark;
    }

    /**
     * @param string|null $remark
     */
    public function setRemark(?string $remark): void
    {
        $this->remark = $remark;
    }

    /**
     * @return int|null
     */
    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    /**
     * @param int|null $groupId
     */
    public function setGroupId(?int $groupId): void
    {
        $this->groupId = $groupId;
    }

    /**
     * @return array|null
     */
    public function getTagIdList(): ?array
    {
        return $this->tagIdList;
    }

    /**
     * @param array|null $tagIdList
     */
    public function setTagIdList(?array $tagIdList): void
    {
        $this->tagIdList = $tagIdList;
    }

    /**
     * @return string|null
     */
    public function getSubscribeScene(): ?string
    {
        return $this->subscribeScene;
    }

    /**
     * @param string|null $subscribeScene
     */
    public function setSubscribeScene(?string $subscribeScene): void
    {
        $this->subscribeScene = $subscribeScene;
    }

    /**
     * @return string|null
     */
    public function getQrScene(): ?string
    {
        return $this->qrScene;
    }

    /**
     * @param string|null $qrScene
     */
    public function setQrScene(?string $qrScene): void
    {
        $this->qrScene = $qrScene;
    }

    /**
     * @return string|null
     */
    public function getQrSceneStr(): ?string
    {
        return $this->qrSceneStr;
    }

    /**
     * @param string|null $qrSceneStr
     */
    public function setQrSceneStr(?string $qrSceneStr): void
    {
        $this->qrSceneStr = $qrSceneStr;
    }

}