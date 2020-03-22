<?php

namespace rapidPHP\plugin\oauth2;


use rapidPHP\library\AB;

class OAuth2UserModel extends AB
{
    /**
     * OAuth2UserBean constructor.
     * @param $openId
     */
    public function __construct($openId)
    {
        if (is_array($openId)) {
            parent::__construct($openId);
        } else {
            parent::__construct(['openId' => $openId, 'unionId' => null, 'nickname' => null, 'header' => null, 'sex' => 0, 'language' => 'zh_CN', 'country' => '中国', 'province' => null, 'city' => null, 'year' => null, 'vipInfo' => []]);
        }
    }

    /**
     * 设置openId
     * @param string $openId
     * @return OAuth2UserModel
     */
    public function setOpenId(string $openId): OAuth2UserModel
    {
        return $this->setValue('openId', $openId);
    }

    /**
     * 获取openId
     * @return string
     */
    public function getOpenId(): string
    {
        return $this->getString('openId');
    }

    /**
     * 设置unionId
     * @param string $unionId
     * @return OAuth2UserModel
     */
    public function setUnionId(string $unionId): OAuth2UserModel
    {
        return $this->setValue('unionId', $unionId);
    }

    /**
     * 获取unionId
     * @return string
     */
    public function getUnionId(): string
    {
        return $this->getString('unionId');
    }

    /**
     * 设置名称
     * @param string $nickname
     * @return OAuth2UserModel
     */
    public function setNickname(string $nickname): OAuth2UserModel
    {
        return $this->setValue('nickname', $nickname);
    }

    /**
     * 获取名称
     * @return string
     */
    public function getNickname(): string
    {
        return $this->getString('nickname');
    }

    /**
     * 设置头像链接
     * @param string $header
     * @return OAuth2UserModel
     */
    public function setHeader(string $header): OAuth2UserModel
    {
        return $this->setValue('header', $header);
    }

    /**
     * 获取头像链接
     * @return string
     */
    public function getHeader(): string
    {
        return $this->getString('header');
    }

    /**
     * 设置性别
     * @param string|int $sex
     * @return OAuth2UserModel
     */
    public function setSex($sex): OAuth2UserModel
    {
        if (is_string($sex)) $sex = B()->getData(['男' => 1, '女' => 2], $sex);

        return $this->setValue('sex', $sex);
    }

    /**
     * 获取性别
     * @return int
     */
    public function getSex(): int
    {
        return $this->getInt('sex');
    }

    /**
     * 设置所在国家
     * @param string $language
     * @return OAuth2UserModel
     */
    public function setLanguage(string $language): OAuth2UserModel
    {
        return $this->setValue('language', $language);
    }

    /**
     * 获取
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->getString('language');
    }

    /**
     * 设置所在国家
     * @param string $country
     * @return OAuth2UserModel
     */
    public function setCountry(string $country): OAuth2UserModel
    {
        return $this->setValue('country', $country);
    }

    /**
     * 获取所在国家
     * @return string
     */
    public function getCountry(): string
    {
        return $this->getString('country');
    }

    /**
     * 设置所在省
     * @param string $province
     * @return OAuth2UserModel
     */
    public function setProvince(string $province): OAuth2UserModel
    {
        return $this->setValue('province', $province);
    }


    /**
     * 获取所在省
     * @return string
     */
    public function getProvince(): string
    {
        return $this->getString('province');
    }

    /**
     * 设置所在城市
     * @param string $city
     * @return OAuth2UserModel
     */
    public function setCity(string $city): OAuth2UserModel
    {
        return $this->setValue('city', $city);
    }

    /**
     * 获取所在城市
     * @return string
     */
    public function getCity(): string
    {
        return $this->getString('city');
    }

    /**
     * 设置出生年
     * @param int $year
     * @return OAuth2UserModel
     */
    public function setYear(int $year): OAuth2UserModel
    {
        return $this->setValue('year', $year);
    }

    /**
     * 获取获取出生年
     * @return int
     */
    public function getYear(): int
    {
        return $this->getInt('year');
    }


    /**
     * 设置qq会员信息
     * @param array $vipInfo
     * @return OAuth2UserModel
     */
    public function setQQVipInfo(array $vipInfo): OAuth2UserModel
    {
        return $this->setValue('vipInfo', $vipInfo);
    }

    /**
     * 获取qq会员信息
     * @return array
     */
    public function getQQVipInfo(): array
    {
        return $this->getArray('vipInfo');
    }


    # 下面代码属于用户自己项目，可以删掉，但建议研究研究，用的到可以拉过去用

    /**
     * 设置自生成userId，设置用户根绝自己需要锁设立的，如果项目中用不到可以删除
     * @param $userId
     * @return OAuth2UserModel
     */
    public function setGenerationUserId($userId): OAuth2UserModel
    {
        return $this->setValue('userId', $userId);
    }

    /**
     * 获取自生成userId
     * @return mixed
     */
    public function getGenerationUserId()
    {
        return $this->getInt('userId');
    }

    /**
     * 设置自生成bindId，设置用户根绝自己需要锁设立的，如果项目中用不到可以删除
     * @param $bindId
     * @return OAuth2UserModel
     */
    public function setGenerationBindId(int $bindId): OAuth2UserModel
    {
        return $this->setValue('bindId', $bindId);
    }

    /**
     * 获取自生成bindId
     * @return mixed
     */
    public function getGenerationBindId()
    {
        return $this->getInt('bindId');
    }

}