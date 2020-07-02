<?php

namespace rapidPHP\plugin\model;


class WXOAuth2UserInfoModel extends BaseOAuth2UserModel
{
    /**
     * 是否关注
     * @var bool|null
     */
    public $isSubscribe = false;

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
     * @return bool
     */
    public function isSubscribe(): ?bool
    {
        return $this->isSubscribe;
    }

    /**
     * @param bool $isSubscribe
     * @return self
     */
    public function setIsSubscribe(bool $isSubscribe): self
    {
        $this->isSubscribe = $isSubscribe;
        return $this;
    }

    /**
     * @return int
     */
    public function getSubscribeTime(): ?int
    {
        return $this->subscribe_time;
    }

    /**
     * @param int $subscribe_time
     * @return self
     */
    public function setSubscribeTime(?int $subscribe_time): self
    {
        $this->subscribe_time = $subscribe_time;
        return $this;
    }

    /**
     * @return string
     */
    public function getRemark(): ?string
    {
        return $this->remark;
    }

    /**
     * @param string $remark
     * @return self
     */
    public function setRemark(?string $remark): self
    {
        $this->remark = $remark;
        return $this;
    }

    /**
     * @return int
     */
    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    /**
     * @param int $groupId
     * @return self
     */
    public function setGroupId(?int $groupId): self
    {
        $this->groupId = $groupId;
        return $this;
    }

    /**
     * @return array
     */
    public function getTagIdList(): array
    {
        return $this->tagIdList;
    }

    /**
     * @param array $tagIdList
     * @return self
     */
    public function setTagIdList(?array $tagIdList): self
    {
        $this->tagIdList = $tagIdList;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubscribeScene(): ?string
    {
        return $this->subscribeScene;
    }

    /**
     * @param string $subscribeScene
     * @return self
     */
    public function setSubscribeScene(?string $subscribeScene): self
    {
        $this->subscribeScene = $subscribeScene;
        return $this;
    }

    /**
     * @return string
     */
    public function getQrScene(): ?string
    {
        return $this->qrScene;
    }

    /**
     * @param string $qrScene
     * @return self
     */
    public function setQrScene(?string $qrScene): self
    {
        $this->qrScene = $qrScene;
        return $this;
    }

    /**
     * @return string
     */
    public function getQrSceneStr(): ?string
    {
        return $this->qrSceneStr;
    }

    /**
     * @param string $qrSceneStr
     * @return self
     */
    public function setQrSceneStr(?string $qrSceneStr): self
    {
        $this->qrSceneStr = $qrSceneStr;
        return $this;
    }

}