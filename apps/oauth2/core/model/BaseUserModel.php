<?php

namespace oauth2\core\model;


use rapidPHP\modules\common\classier\Build;
use function rapidPHP\B;

class BaseUserModel
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
     * @var int|string|null
     */
    public $userId;

    /**
     * @var int|string|null
     */
    public $bindId;

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


    # 下面代码属于用户自己项目，可以删掉，但建议研究研究，用的到可以拉过去用

    /**
     * 设置自生成userId，设置用户根绝自己需要锁设立的，如果项目中用不到可以删除
     * @param $userId
     */
    public function setGenerationUserId($userId)
    {
        $this->userId = $userId;
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
     */
    public function setGenerationBindId(?int $bindId)
    {
        $this->bindId = $bindId;
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