<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * Autho2 QQ
 * @table app_oauth2qq
 * rapidPHP auto generate Model 2022-04-11 11:39:18
 */

class AppOauth2qqModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'app_oauth2qq';

    
    /**
     * id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $id;

    /**
     * 设置 id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 获取 id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 效验 id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if (empty($this->id)) throw new Exception($msg);
    }

    /**
     * bindid
     * @var 
     * @length 
     * @typed bigint
     */
    protected $bind_id;

    /**
     * 设置 bindid
     * @param $bind_id
     */
    public function setBindId($bind_id)
    {
        $this->bind_id = $bind_id;
    }

    /**
     * 获取 bindid
     * @return mixed
     */
    public function getBindId()
    {
        return $this->bind_id;
    }

    /**
     * 效验 bindid
     * @param string $msg
     * @throws Exception
     */
    public function validBindId(string $msg = 'bind_id Cannot be empty!')
    {
        if (empty($this->bind_id)) throw new Exception($msg);
    }

    /**
     * unionid
     * @var string|null 
     * @length 28
     * @typed varchar
     */
    protected $union_id;

    /**
     * 设置 unionid
     * @param string|null $union_id
     */
    public function setUnionId(?string $union_id)
    {
        $this->union_id = $union_id;
    }

    /**
     * 获取 unionid
     * @return string|null
     */
    public function getUnionId(): ?string
    {
        return $this->union_id;
    }

    /**
     * 效验 unionid
     * @param string $msg
     * @throws Exception
     */
    public function validUnionId(string $msg = 'union_id Cannot be empty!')
    {
        if (empty($this->union_id)) throw new Exception($msg);
    }

    /**
     * openid
     * @var string|null 
     * @length 28
     * @typed varchar
     */
    protected $open_id;

    /**
     * 设置 openid
     * @param string|null $open_id
     */
    public function setOpenId(?string $open_id)
    {
        $this->open_id = $open_id;
    }

    /**
     * 获取 openid
     * @return string|null
     */
    public function getOpenId(): ?string
    {
        return $this->open_id;
    }

    /**
     * 效验 openid
     * @param string $msg
     * @throws Exception
     */
    public function validOpenId(string $msg = 'open_id Cannot be empty!')
    {
        if (empty($this->open_id)) throw new Exception($msg);
    }

    /**
     * QQ名
     * @var string|null 
     * @length 256
     * @typed varchar
     */
    protected $nickname;

    /**
     * 设置 QQ名
     * @param string|null $nickname
     */
    public function setNickname(?string $nickname)
    {
        $this->nickname = $nickname;
    }

    /**
     * 获取 QQ名
     * @return string|null
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * 效验 QQ名
     * @param string $msg
     * @throws Exception
     */
    public function validNickname(string $msg = 'nickname Cannot be empty!')
    {
        if (empty($this->nickname)) throw new Exception($msg);
    }

    /**
     * QQ头像
     * @var string|null 
     * @length 1024
     * @typed varchar
     */
    protected $headimgurl;

    /**
     * 设置 QQ头像
     * @param string|null $headimgurl
     */
    public function setHeadimgurl(?string $headimgurl)
    {
        $this->headimgurl = $headimgurl;
    }

    /**
     * 获取 QQ头像
     * @return string|null
     */
    public function getHeadimgurl(): ?string
    {
        return $this->headimgurl;
    }

    /**
     * 效验 QQ头像
     * @param string $msg
     * @throws Exception
     */
    public function validHeadimgurl(string $msg = 'headimgurl Cannot be empty!')
    {
        if (empty($this->headimgurl)) throw new Exception($msg);
    }

    /**
     * 性别 1 男 2 女
     * @var int|null 
     * @length 
     * @typed tinyint
     */
    protected $gender;

    /**
     * 设置 性别 1 男 2 女
     * @param int|null $gender
     */
    public function setGender(?int $gender)
    {
        $this->gender = $gender;
    }

    /**
     * 获取 性别 1 男 2 女
     * @return int|null
     */
    public function getGender(): ?int
    {
        return $this->gender;
    }

    /**
     * 效验 性别 1 男 2 女
     * @param string $msg
     * @throws Exception
     */
    public function validGender(string $msg = 'gender Cannot be empty!')
    {
        if (empty($this->gender)) throw new Exception($msg);
    }

    /**
     * 省
     * @var string|null 
     * @length 50
     * @typed varchar
     */
    protected $province;

    /**
     * 设置 省
     * @param string|null $province
     */
    public function setProvince(?string $province)
    {
        $this->province = $province;
    }

    /**
     * 获取 省
     * @return string|null
     */
    public function getProvince(): ?string
    {
        return $this->province;
    }

    /**
     * 效验 省
     * @param string $msg
     * @throws Exception
     */
    public function validProvince(string $msg = 'province Cannot be empty!')
    {
        if (empty($this->province)) throw new Exception($msg);
    }

    /**
     * 城市
     * @var string|null 
     * @length 50
     * @typed varchar
     */
    protected $city;

    /**
     * 设置 城市
     * @param string|null $city
     */
    public function setCity(?string $city)
    {
        $this->city = $city;
    }

    /**
     * 获取 城市
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * 效验 城市
     * @param string $msg
     * @throws Exception
     */
    public function validCity(string $msg = 'city Cannot be empty!')
    {
        if (empty($this->city)) throw new Exception($msg);
    }

    /**
     * 出生年
     * @var int|null 
     * @length 
     * @typed int
     */
    protected $year;

    /**
     * 设置 出生年
     * @param int|null $year
     */
    public function setYear(?int $year)
    {
        $this->year = $year;
    }

    /**
     * 获取 出生年
     * @return int|null
     */
    public function getYear(): ?int
    {
        return $this->year;
    }

    /**
     * 效验 出生年
     * @param string $msg
     * @throws Exception
     */
    public function validYear(string $msg = 'year Cannot be empty!')
    {
        if (empty($this->year)) throw new Exception($msg);
    }

    /**
     * 会员信息
     * @var 
     * @length 
     * @typed json
     */
    protected $vip_info;

    /**
     * 设置 会员信息
     * @param $vip_info
     */
    public function setVipInfo($vip_info)
    {
        $this->vip_info = $vip_info;
    }

    /**
     * 获取 会员信息
     * @return mixed
     */
    public function getVipInfo()
    {
        return $this->vip_info;
    }

    /**
     * 效验 会员信息
     * @param string $msg
     * @throws Exception
     */
    public function validVipInfo(string $msg = 'vip_info Cannot be empty!')
    {
        if (empty($this->vip_info)) throw new Exception($msg);
    }

    /**
     * 是否删除
     * @var bool|null 
     * @length 
     * @typed bit
     */
    protected $is_delete;

    /**
     * 设置 是否删除
     * @param bool|null $is_delete
     */
    public function setIsDelete(?bool $is_delete)
    {
        $this->is_delete = $is_delete;
    }

    /**
     * 获取 是否删除
     * @return bool|null
     */
    public function getIsDelete(): ?bool
    {
        return $this->is_delete;
    }

    /**
     * 效验 是否删除
     * @param string $msg
     * @throws Exception
     */
    public function validIsDelete(string $msg = 'is_delete Cannot be empty!')
    {
        if (empty($this->is_delete)) throw new Exception($msg);
    }

    /**
     * 创建人Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $created_id;

    /**
     * 设置 创建人Id
     * @param $created_id
     */
    public function setCreatedId($created_id)
    {
        $this->created_id = $created_id;
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
     * 效验 创建人Id
     * @param string $msg
     * @throws Exception
     */
    public function validCreatedId(string $msg = 'created_id Cannot be empty!')
    {
        if (empty($this->created_id)) throw new Exception($msg);
    }

    /**
     * 创建时间
     * @var string|null 
     * @length 
     * @typed datetime
     */
    protected $created_time;

    /**
     * 设置 创建时间
     * @param string|null $created_time
     */
    public function setCreatedTime(?string $created_time)
    {
        $this->created_time = $created_time;
    }

    /**
     * 获取 创建时间
     * @return string|null
     */
    public function getCreatedTime(): ?string
    {
        return $this->created_time;
    }

    /**
     * 效验 创建时间
     * @param string $msg
     * @throws Exception
     */
    public function validCreatedTime(string $msg = 'created_time Cannot be empty!')
    {
        if (empty($this->created_time)) throw new Exception($msg);
    }

    /**
     * 修改人Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $updated_id;

    /**
     * 设置 修改人Id
     * @param $updated_id
     */
    public function setUpdatedId($updated_id)
    {
        $this->updated_id = $updated_id;
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
     * 效验 修改人Id
     * @param string $msg
     * @throws Exception
     */
    public function validUpdatedId(string $msg = 'updated_id Cannot be empty!')
    {
        if (empty($this->updated_id)) throw new Exception($msg);
    }

    /**
     * 修改时间
     * @var string|null 
     * @length 
     * @typed datetime
     */
    protected $updated_time;

    /**
     * 设置 修改时间
     * @param string|null $updated_time
     */
    public function setUpdatedTime(?string $updated_time)
    {
        $this->updated_time = $updated_time;
    }

    /**
     * 获取 修改时间
     * @return string|null
     */
    public function getUpdatedTime(): ?string
    {
        return $this->updated_time;
    }

    /**
     * 效验 修改时间
     * @param string $msg
     * @throws Exception
     */
    public function validUpdatedTime(string $msg = 'updated_time Cannot be empty!')
    {
        if (empty($this->updated_time)) throw new Exception($msg);
    }

}
