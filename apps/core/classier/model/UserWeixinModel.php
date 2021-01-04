<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 微信用户表
 * @table user_weixin
 * rapidPHP auto generate Model 2021-01-05 00:02:37
 */
class UserWeixinModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'user_weixin';
        
    
    /**
     * id
     * @length 
     * @typed bigint
     */
    private $id;    
    
    /**
     * 用户id
     * @length 
     * @typed bigint
     */
    private $user_id;    
    
    /**
     * unionid
     * @length 28
     * @typed varchar
     */
    private $union_id;    
    
    /**
     * openid
     * @length 28
     * @typed varchar
     */
    private $open_id;    
    
    /**
     * 微信名
     * @length 256
     * @typed varchar
     */
    private $nickname;    
    
    /**
     * 微信头像
     * @length 1024
     * @typed varchar
     */
    private $headimgurl;    
    
    /**
     * 性别 1 男 2 女
     * @length 
     * @typed tinyint
     */
    private $gender;    
    
    /**
     * 语言
     * @length 50
     * @typed varchar
     */
    private $language;    
    
    /**
     * 国家
     * @length 50
     * @typed varchar
     */
    private $country;    
    
    /**
     * 省
     * @length 50
     * @typed varchar
     */
    private $province;    
    
    /**
     * 城市
     * @length 50
     * @typed varchar
     */
    private $city;    
    
    /**
     * 是否删除
     * @length 
     * @typed bit
     */
    private $is_delete;    
    
    /**
     * 创建人Id
     * @length 
     * @typed bigint
     */
    private $created_id;    
    
    /**
     * 创建时间
     * @length 
     * @typed datetime
     */
    private $created_time;    
    
    /**
     * 修改人Id
     * @length 
     * @typed bigint
     */
    private $updated_id;    
    
    /**
     * 修改时间
     * @length 
     * @typed datetime
     */
    private $updated_time;    
    /**
     * 获取 id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * 设置 id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * 效验 id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if(empty($this->id)) throw new Exception($msg);
    }
    
    /**
     * 获取 用户id
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }
    
    /**
     * 设置 用户id
     * @param $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    
    /**
     * 效验 用户id
     * @param string $msg
     * @throws Exception
     */
    public function validUserId(string $msg = 'user_id Cannot be empty!')
    {
        if(empty($this->user_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 unionid
     * @return string
     */
    public function getUnionId(): ?string
    {
        return $this->union_id;
    }
    
    /**
     * 设置 unionid
     * @param string|null $union_id
     */
    public function setUnionId(?string $union_id)
    {
        $this->union_id = $union_id;
    }
    
    /**
     * 效验 unionid
     * @param string $msg
     * @throws Exception
     */
    public function validUnionId(string $msg = 'union_id Cannot be empty!')
    {
        if(empty($this->union_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 openid
     * @return string
     */
    public function getOpenId(): ?string
    {
        return $this->open_id;
    }
    
    /**
     * 设置 openid
     * @param string|null $open_id
     */
    public function setOpenId(?string $open_id)
    {
        $this->open_id = $open_id;
    }
    
    /**
     * 效验 openid
     * @param string $msg
     * @throws Exception
     */
    public function validOpenId(string $msg = 'open_id Cannot be empty!')
    {
        if(empty($this->open_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 微信名
     * @return string
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }
    
    /**
     * 设置 微信名
     * @param string|null $nickname
     */
    public function setNickname(?string $nickname)
    {
        $this->nickname = $nickname;
    }
    
    /**
     * 效验 微信名
     * @param string $msg
     * @throws Exception
     */
    public function validNickname(string $msg = 'nickname Cannot be empty!')
    {
        if(empty($this->nickname)) throw new Exception($msg);
    }
    
    /**
     * 获取 微信头像
     * @return string
     */
    public function getHeadimgurl(): ?string
    {
        return $this->headimgurl;
    }
    
    /**
     * 设置 微信头像
     * @param string|null $headimgurl
     */
    public function setHeadimgurl(?string $headimgurl)
    {
        $this->headimgurl = $headimgurl;
    }
    
    /**
     * 效验 微信头像
     * @param string $msg
     * @throws Exception
     */
    public function validHeadimgurl(string $msg = 'headimgurl Cannot be empty!')
    {
        if(empty($this->headimgurl)) throw new Exception($msg);
    }
    
    /**
     * 获取 性别 1 男 2 女
     * @return int
     */
    public function getGender(): ?int
    {
        return $this->gender;
    }
    
    /**
     * 设置 性别 1 男 2 女
     * @param int|null $gender
     */
    public function setGender(?int $gender)
    {
        $this->gender = $gender;
    }
    
    /**
     * 效验 性别 1 男 2 女
     * @param string $msg
     * @throws Exception
     */
    public function validGender(string $msg = 'gender Cannot be empty!')
    {
        if(empty($this->gender)) throw new Exception($msg);
    }
    
    /**
     * 获取 语言
     * @return string
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }
    
    /**
     * 设置 语言
     * @param string|null $language
     */
    public function setLanguage(?string $language)
    {
        $this->language = $language;
    }
    
    /**
     * 效验 语言
     * @param string $msg
     * @throws Exception
     */
    public function validLanguage(string $msg = 'language Cannot be empty!')
    {
        if(empty($this->language)) throw new Exception($msg);
    }
    
    /**
     * 获取 国家
     * @return string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }
    
    /**
     * 设置 国家
     * @param string|null $country
     */
    public function setCountry(?string $country)
    {
        $this->country = $country;
    }
    
    /**
     * 效验 国家
     * @param string $msg
     * @throws Exception
     */
    public function validCountry(string $msg = 'country Cannot be empty!')
    {
        if(empty($this->country)) throw new Exception($msg);
    }
    
    /**
     * 获取 省
     * @return string
     */
    public function getProvince(): ?string
    {
        return $this->province;
    }
    
    /**
     * 设置 省
     * @param string|null $province
     */
    public function setProvince(?string $province)
    {
        $this->province = $province;
    }
    
    /**
     * 效验 省
     * @param string $msg
     * @throws Exception
     */
    public function validProvince(string $msg = 'province Cannot be empty!')
    {
        if(empty($this->province)) throw new Exception($msg);
    }
    
    /**
     * 获取 城市
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }
    
    /**
     * 设置 城市
     * @param string|null $city
     */
    public function setCity(?string $city)
    {
        $this->city = $city;
    }
    
    /**
     * 效验 城市
     * @param string $msg
     * @throws Exception
     */
    public function validCity(string $msg = 'city Cannot be empty!')
    {
        if(empty($this->city)) throw new Exception($msg);
    }
    
    /**
     * 获取 是否删除
     * @return bool
     */
    public function getIsDelete(): ?bool
    {
        return $this->is_delete;
    }
    
    /**
     * 设置 是否删除
     * @param bool|null $is_delete
     */
    public function setIsDelete(?bool $is_delete)
    {
        $this->is_delete = $is_delete;
    }
    
    /**
     * 效验 是否删除
     * @param string $msg
     * @throws Exception
     */
    public function validIsDelete(string $msg = 'is_delete Cannot be empty!')
    {
        if(empty($this->is_delete)) throw new Exception($msg);
    }
    
    /**
     * 获取 创建人Id
     * @return mixed
     */
    public function getCreatedId()
    {
        return $this->created_id;
    }
    
    /**
     * 设置 创建人Id
     * @param $created_id
     */
    public function setCreatedId($created_id)
    {
        $this->created_id = $created_id;
    }
    
    /**
     * 效验 创建人Id
     * @param string $msg
     * @throws Exception
     */
    public function validCreatedId(string $msg = 'created_id Cannot be empty!')
    {
        if(empty($this->created_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 创建时间
     * @return string
     */
    public function getCreatedTime(): ?string
    {
        return $this->created_time;
    }
    
    /**
     * 设置 创建时间
     * @param string|null $created_time
     */
    public function setCreatedTime(?string $created_time)
    {
        $this->created_time = $created_time;
    }
    
    /**
     * 效验 创建时间
     * @param string $msg
     * @throws Exception
     */
    public function validCreatedTime(string $msg = 'created_time Cannot be empty!')
    {
        if(empty($this->created_time)) throw new Exception($msg);
    }
    
    /**
     * 获取 修改人Id
     * @return mixed
     */
    public function getUpdatedId()
    {
        return $this->updated_id;
    }
    
    /**
     * 设置 修改人Id
     * @param $updated_id
     */
    public function setUpdatedId($updated_id)
    {
        $this->updated_id = $updated_id;
    }
    
    /**
     * 效验 修改人Id
     * @param string $msg
     * @throws Exception
     */
    public function validUpdatedId(string $msg = 'updated_id Cannot be empty!')
    {
        if(empty($this->updated_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 修改时间
     * @return string
     */
    public function getUpdatedTime(): ?string
    {
        return $this->updated_time;
    }
    
    /**
     * 设置 修改时间
     * @param string|null $updated_time
     */
    public function setUpdatedTime(?string $updated_time)
    {
        $this->updated_time = $updated_time;
    }
    
    /**
     * 效验 修改时间
     * @param string $msg
     * @throws Exception
     */
    public function validUpdatedTime(string $msg = 'updated_time Cannot be empty!')
    {
        if(empty($this->updated_time)) throw new Exception($msg);
    }
}