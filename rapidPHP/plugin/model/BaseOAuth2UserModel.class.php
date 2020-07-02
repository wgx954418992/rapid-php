<?php

namespace rapidPHP\plugin\model;


class BaseOAuth2UserModel
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
     * @var int|null
     */
    public $sex = 1;

    /**
     * @var string|null
     */
    public $language = 'zh_CN';

    /**
     * @var string|null
     */
    public $country = '中国';

    /**
     * @var string|null
     */
    public $province;

    /**
     * @var string|null
     */
    public $city;

    /**
     * @var int|null
     */
    public $userId;

    /**
     * @var int|null
     */
    public $bindId;

    /**
     * 设置openId
     * @param string $openId
     * @return self
     */
    public function setOpenId(?string $openId): self
    {
        $this->openId = $openId;
        return $this;
    }

    /**
     * 获取openId
     * @return string
     */
    public function getOpenId(): ?string
    {
        return $this->openId;
    }

    /**
     * 设置unionId
     * @param string $unionId
     * @return self
     */
    public function setUnionId(?string $unionId): self
    {
        $this->unionId = $unionId;
        return $this;
    }

    /**
     * 获取unionId
     * @return string
     */
    public function getUnionId(): ?string
    {
        return $this->unionId;
    }

    /**
     * 设置名称
     * @param string $nickname
     * @return self
     */
    public function setNickname(?string $nickname): self
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * 获取名称
     * @return string
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * 设置头像链接
     * @param string $header
     * @return self
     */
    public function setHeader(?string $header): self
    {
        $this->header = $header;
        return $this;
    }

    /**
     * 获取头像链接
     * @return string
     */
    public function getHeader(): ?string
    {
        return $this->header;
    }

    /**
     * 设置性别
     * @param string|int $sex
     * @return self
     */
    public function setSex($sex): self
    {
        if (!is_numeric($sex)) $sex = B()->getData(['男' => 1, '女' => 2], (string)$sex);

        $this->sex = $sex;

        return $this;
    }

    /**
     * 获取性别
     * @return int
     */
    public function getSex(): ?int
    {
        return $this->sex;
    }

    /**
     * 设置所在国家
     * @param string $language
     * @return self
     */
    public function setLanguage(?string $language): self
    {
        $this->language = $language;
        return $this;
    }

    /**
     * 获取
     * @return string
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * 设置所在国家
     * @param string $country
     * @return self
     */
    public function setCountry(?string $country): self
    {
        $this->country = $country;
        return $this;
    }

    /**
     * 获取所在国家
     * @return string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * 设置所在省
     * @param string $province
     * @return self
     */
    public function setProvince(?string $province): self
    {
        $this->province = $province;
        return $this;
    }


    /**
     * 获取所在省
     * @return string
     */
    public function getProvince(): ?string
    {
        return $this->province;
    }

    /**
     * 设置所在城市
     * @param string $city
     * @return self
     */
    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    /**
     * 获取所在城市
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }


    # 下面代码属于用户自己项目，可以删掉，但建议研究研究，用的到可以拉过去用

    /**
     * 设置自生成userId，设置用户根绝自己需要锁设立的，如果项目中用不到可以删除
     * @param $userId
     * @return self
     */
    public function setGenerationUserId($userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * 获取自生成userId
     * @return mixed
     */
    public function getGenerationUserId()
    {
        return $this->userId;
    }

    /**
     * 设置自生成bindId，设置用户根绝自己需要锁设立的，如果项目中用不到可以删除
     * @param $bindId
     * @return self
     */
    public function setGenerationBindId(?int $bindId): self
    {
        $this->bindId = $bindId;
        return $this;
    }

    /**
     * 获取自生成bindId
     * @return mixed
     */
    public function getGenerationBindId()
    {
        return $this->bindId;
    }

}