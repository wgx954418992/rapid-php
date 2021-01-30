<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * VIEW
 * @table view_company
 * rapidPHP auto generate Model 2021-01-25 21:19:27
 */
class ViewCompanyModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'view_company';
        
    
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
     * 邮箱
     * @length 28
     * @typed varchar
     */
    private $email;    
    
    /**
     * 名称
     * @length 100
     * @typed varchar
     */
    private $nickname;    
    
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
     * 创建时间
     * @length 
     * @typed datetime
     */
    private $created_time;    
    
    /**
     * 是否删除
     * @length 
     * @typed bit
     */
    private $is_delete;    
    
    /**
     *  企业id
     * @length 
     * @typed bigint
     */
    private $company_id;    
    
    /**
     * 企业名称
     * @length 50
     * @typed varchar
     */
    private $company_name;    
    
    /**
     * 营业执照对应的文件Id
     * @length 
     * @typed bigint
     */
    private $business_fid;    
    
    /**
     * Eori 号码
     * @length 100
     * @typed varchar
     */
    private $eori;    
    
    /**
     * 欧盟税号 需要⼤写
     * @length 18
     * @typed varchar
     */
    private $tva;    
    
    /**
     * 当前状态 1 正常 2 待审核
     * @length 
     * @typed tinyint
     */
    private $status;    
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
     * 获取  企业id
     * @return mixed
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }
    
    /**
     * 设置  企业id
     * @param $company_id
     */
    public function setCompanyId($company_id)
    {
        $this->company_id = $company_id;
    }
    
    /**
     * 效验  企业id
     * @param string $msg
     * @throws Exception
     */
    public function validCompanyId(string $msg = 'company_id Cannot be empty!')
    {
        if(empty($this->company_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 企业名称
     * @return string
     */
    public function getCompanyName(): ?string
    {
        return $this->company_name;
    }
    
    /**
     * 设置 企业名称
     * @param string|null $company_name
     */
    public function setCompanyName(?string $company_name)
    {
        $this->company_name = $company_name;
    }
    
    /**
     * 效验 企业名称
     * @param string $msg
     * @throws Exception
     */
    public function validCompanyName(string $msg = 'company_name Cannot be empty!')
    {
        if(empty($this->company_name)) throw new Exception($msg);
    }
    
    /**
     * 获取 营业执照对应的文件Id
     * @return mixed
     */
    public function getBusinessFid()
    {
        return $this->business_fid;
    }
    
    /**
     * 设置 营业执照对应的文件Id
     * @param $business_fid
     */
    public function setBusinessFid($business_fid)
    {
        $this->business_fid = $business_fid;
    }
    
    /**
     * 效验 营业执照对应的文件Id
     * @param string $msg
     * @throws Exception
     */
    public function validBusinessFid(string $msg = 'business_fid Cannot be empty!')
    {
        if(empty($this->business_fid)) throw new Exception($msg);
    }
    
    /**
     * 获取 Eori 号码
     * @return string
     */
    public function getEori(): ?string
    {
        return $this->eori;
    }
    
    /**
     * 设置 Eori 号码
     * @param string|null $eori
     */
    public function setEori(?string $eori)
    {
        $this->eori = $eori;
    }
    
    /**
     * 效验 Eori 号码
     * @param string $msg
     * @throws Exception
     */
    public function validEori(string $msg = 'eori Cannot be empty!')
    {
        if(empty($this->eori)) throw new Exception($msg);
    }
    
    /**
     * 获取 欧盟税号 需要⼤写
     * @return string
     */
    public function getTva(): ?string
    {
        return $this->tva;
    }
    
    /**
     * 设置 欧盟税号 需要⼤写
     * @param string|null $tva
     */
    public function setTva(?string $tva)
    {
        $this->tva = $tva;
    }
    
    /**
     * 效验 欧盟税号 需要⼤写
     * @param string $msg
     * @throws Exception
     */
    public function validTva(string $msg = 'tva Cannot be empty!')
    {
        if(empty($this->tva)) throw new Exception($msg);
    }
    
    /**
     * 获取 当前状态 1 正常 2 待审核
     * @return int
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }
    
    /**
     * 设置 当前状态 1 正常 2 待审核
     * @param int|null $status
     */
    public function setStatus(?int $status)
    {
        $this->status = $status;
    }
    
    /**
     * 效验 当前状态 1 正常 2 待审核
     * @param string $msg
     * @throws Exception
     */
    public function validStatus(string $msg = 'status Cannot be empty!')
    {
        if(empty($this->status)) throw new Exception($msg);
    }
}