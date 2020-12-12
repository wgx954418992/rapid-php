<?php

namespace apps\app\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 用户表
 * @table app_user
 * rapidPHP auto generate Model 2020-12-13 00:03:17
 */
class AppUserModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'app_user';
        
    
    /**
     * 主键
     * @length 
     * @typed bigint
     */
    public $id;    
    
    /**
     * 用户名称（刚注册需要自动生成）
     * @length 50
     * @typed varchar
     */
    public $username;    
    
    /**
     * 名称
     * @length 100
     * @typed varchar
     */
    public $nickname;    
    
    /**
     * 区号+手机号
     * @length 16
     * @typed varchar
     */
    public $telephone;    
    
    /**
     * 密码
     * @length 40
     * @typed varchar
     */
    public $password;    
    
    /**
     * 签名
     * @length 255
     * @typed varchar
     */
    public $explain;    
    
    /**
     * 头像文件Id
     * @length 
     * @typed bigint
     */
    public $head_fid;    
    
    /**
     * 性别 1男人 2 女人
     * @length 
     * @typed tinyint
     */
    public $gender;    
    
    /**
     * 出生日期
     * @length 
     * @typed date
     */
    public $birthday;    
    
    /**
     * 注册Ip
     * @length 18
     * @typed varchar
     */
    public $register_ip;    
    
    /**
     * 来源
     * @length 20
     * @typed varchar
     */
    public $source;    
    
    /**
     * 当前状态 0 待激活 1 正常
     * @length 
     * @typed tinyint
     */
    public $status;    
    
    /**
     * 账户隐私类型 1 公开，2私密账户
     * @length 
     * @typed tinyint
     */
    public $privacy_type;    
    
    /**
     * 用户位置信息
     * @length 
     * @typed point
     */
    public $location;    
    
    /**
     * 当前的pushid，用于推送
     * @length 50
     * @typed varchar
     */
    public $push_id;    
    
    /**
     * 是否删除
     * @length 
     * @typed bit
     */
    public $is_delete;    
    
    /**
     * 创建人Id
     * @length 
     * @typed bigint
     */
    public $created_id;    
    
    /**
     * 创建时间
     * @length 
     * @typed datetime
     */
    public $created_time;    
    
    /**
     * 修改人Id
     * @length 
     * @typed bigint
     */
    public $updated_id;    
    
    /**
     * 修改时间
     * @length 
     * @typed datetime
     */
    public $updated_time;    
    /**
     * 获取 主键
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * 设置 主键
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * 效验 主键
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if(empty($this->id)) throw new Exception($msg);
    }
    
    /**
     * 获取 用户名称（刚注册需要自动生成）
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }
    
    /**
     * 设置 用户名称（刚注册需要自动生成）
     * @param string|null $username
     */
    public function setUsername(?string $username)
    {
        $this->username = $username;
    }
    
    /**
     * 效验 用户名称（刚注册需要自动生成）
     * @param string $msg
     * @throws Exception
     */
    public function validUsername(string $msg = 'username Cannot be empty!')
    {
        if(empty($this->username)) throw new Exception($msg);
    }
    
    /**
     * 获取 名称
     * @return string
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }
    
    /**
     * 设置 名称
     * @param string|null $nickname
     */
    public function setNickname(?string $nickname)
    {
        $this->nickname = $nickname;
    }
    
    /**
     * 效验 名称
     * @param string $msg
     * @throws Exception
     */
    public function validNickname(string $msg = 'nickname Cannot be empty!')
    {
        if(empty($this->nickname)) throw new Exception($msg);
    }
    
    /**
     * 获取 区号+手机号
     * @return string
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }
    
    /**
     * 设置 区号+手机号
     * @param string|null $telephone
     */
    public function setTelephone(?string $telephone)
    {
        $this->telephone = $telephone;
    }
    
    /**
     * 效验 区号+手机号
     * @param string $msg
     * @throws Exception
     */
    public function validTelephone(string $msg = 'telephone Cannot be empty!')
    {
        if(empty($this->telephone)) throw new Exception($msg);
    }
    
    /**
     * 获取 密码
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }
    
    /**
     * 设置 密码
     * @param string|null $password
     */
    public function setPassword(?string $password)
    {
        $this->password = $password;
    }
    
    /**
     * 效验 密码
     * @param string $msg
     * @throws Exception
     */
    public function validPassword(string $msg = 'password Cannot be empty!')
    {
        if(empty($this->password)) throw new Exception($msg);
    }
    
    /**
     * 获取 签名
     * @return string
     */
    public function getExplain(): ?string
    {
        return $this->explain;
    }
    
    /**
     * 设置 签名
     * @param string|null $explain
     */
    public function setExplain(?string $explain)
    {
        $this->explain = $explain;
    }
    
    /**
     * 效验 签名
     * @param string $msg
     * @throws Exception
     */
    public function validExplain(string $msg = 'explain Cannot be empty!')
    {
        if(empty($this->explain)) throw new Exception($msg);
    }
    
    /**
     * 获取 头像文件Id
     * @return mixed
     */
    public function getHeadFid()
    {
        return $this->head_fid;
    }
    
    /**
     * 设置 头像文件Id
     * @param $head_fid
     */
    public function setHeadFid($head_fid)
    {
        $this->head_fid = $head_fid;
    }
    
    /**
     * 效验 头像文件Id
     * @param string $msg
     * @throws Exception
     */
    public function validHeadFid(string $msg = 'head_fid Cannot be empty!')
    {
        if(empty($this->head_fid)) throw new Exception($msg);
    }
    
    /**
     * 获取 性别 1男人 2 女人
     * @return int
     */
    public function getGender(): ?int
    {
        return $this->gender;
    }
    
    /**
     * 设置 性别 1男人 2 女人
     * @param int|null $gender
     */
    public function setGender(?int $gender)
    {
        $this->gender = $gender;
    }
    
    /**
     * 效验 性别 1男人 2 女人
     * @param string $msg
     * @throws Exception
     */
    public function validGender(string $msg = 'gender Cannot be empty!')
    {
        if(empty($this->gender)) throw new Exception($msg);
    }
    
    /**
     * 获取 出生日期
     * @return string
     */
    public function getBirthday(): ?string
    {
        return $this->birthday;
    }
    
    /**
     * 设置 出生日期
     * @param string|null $birthday
     */
    public function setBirthday(?string $birthday)
    {
        $this->birthday = $birthday;
    }
    
    /**
     * 效验 出生日期
     * @param string $msg
     * @throws Exception
     */
    public function validBirthday(string $msg = 'birthday Cannot be empty!')
    {
        if(empty($this->birthday)) throw new Exception($msg);
    }
    
    /**
     * 获取 注册Ip
     * @return string
     */
    public function getRegisterIp(): ?string
    {
        return $this->register_ip;
    }
    
    /**
     * 设置 注册Ip
     * @param string|null $register_ip
     */
    public function setRegisterIp(?string $register_ip)
    {
        $this->register_ip = $register_ip;
    }
    
    /**
     * 效验 注册Ip
     * @param string $msg
     * @throws Exception
     */
    public function validRegisterIp(string $msg = 'register_ip Cannot be empty!')
    {
        if(empty($this->register_ip)) throw new Exception($msg);
    }
    
    /**
     * 获取 来源
     * @return string
     */
    public function getSource(): ?string
    {
        return $this->source;
    }
    
    /**
     * 设置 来源
     * @param string|null $source
     */
    public function setSource(?string $source)
    {
        $this->source = $source;
    }
    
    /**
     * 效验 来源
     * @param string $msg
     * @throws Exception
     */
    public function validSource(string $msg = 'source Cannot be empty!')
    {
        if(empty($this->source)) throw new Exception($msg);
    }
    
    /**
     * 获取 当前状态 0 待激活 1 正常
     * @return int
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }
    
    /**
     * 设置 当前状态 0 待激活 1 正常
     * @param int|null $status
     */
    public function setStatus(?int $status)
    {
        $this->status = $status;
    }
    
    /**
     * 效验 当前状态 0 待激活 1 正常
     * @param string $msg
     * @throws Exception
     */
    public function validStatus(string $msg = 'status Cannot be empty!')
    {
        if(empty($this->status)) throw new Exception($msg);
    }
    
    /**
     * 获取 账户隐私类型 1 公开，2私密账户
     * @return int
     */
    public function getPrivacyType(): ?int
    {
        return $this->privacy_type;
    }
    
    /**
     * 设置 账户隐私类型 1 公开，2私密账户
     * @param int|null $privacy_type
     */
    public function setPrivacyType(?int $privacy_type)
    {
        $this->privacy_type = $privacy_type;
    }
    
    /**
     * 效验 账户隐私类型 1 公开，2私密账户
     * @param string $msg
     * @throws Exception
     */
    public function validPrivacyType(string $msg = 'privacy_type Cannot be empty!')
    {
        if(empty($this->privacy_type)) throw new Exception($msg);
    }
    
    /**
     * 获取 用户位置信息
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }
    
    /**
     * 设置 用户位置信息
     * @param $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }
    
    /**
     * 效验 用户位置信息
     * @param string $msg
     * @throws Exception
     */
    public function validLocation(string $msg = 'location Cannot be empty!')
    {
        if(empty($this->location)) throw new Exception($msg);
    }
    
    /**
     * 获取 当前的pushid，用于推送
     * @return string
     */
    public function getPushId(): ?string
    {
        return $this->push_id;
    }
    
    /**
     * 设置 当前的pushid，用于推送
     * @param string|null $push_id
     */
    public function setPushId(?string $push_id)
    {
        $this->push_id = $push_id;
    }
    
    /**
     * 效验 当前的pushid，用于推送
     * @param string $msg
     * @throws Exception
     */
    public function validPushId(string $msg = 'push_id Cannot be empty!')
    {
        if(empty($this->push_id)) throw new Exception($msg);
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