<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 用户表
 * @table app_user
 * rapidPHP auto generate Model 2021-01-25 21:19:27
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
    private $id;    
    
    /**
     * 区号+手机号
     * @length 16
     * @typed varchar
     */
    private $telephone;    
    
    /**
     * 名称
     * @length 100
     * @typed varchar
     */
    private $nickname;    
    
    /**
     * 密码
     * @length 40
     * @typed varchar
     */
    private $password;    
    
    /**
     * 头像文件Id
     * @length 
     * @typed bigint
     */
    private $head_fid;    
    
    /**
     * 性别 1男人 2 女人
     * @length 
     * @typed tinyint
     */
    private $gender;    
    
    /**
     * 出生日期
     * @length 
     * @typed date
     */
    private $birthday;    
    
    /**
     * 注册Ip
     * @length 18
     * @typed varchar
     */
    private $register_ip;    
    
    /**
     * 邮箱
     * @length 28
     * @typed varchar
     */
    private $email;    
    
    /**
     * 来源
     * @length 20
     * @typed varchar
     */
    private $source;    
    
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
     * 获取 邮箱
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }
    
    /**
     * 设置 邮箱
     * @param string|null $email
     */
    public function setEmail(?string $email)
    {
        $this->email = $email;
    }
    
    /**
     * 效验 邮箱
     * @param string $msg
     * @throws Exception
     */
    public function validEmail(string $msg = 'email Cannot be empty!')
    {
        if(empty($this->email)) throw new Exception($msg);
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