<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 用户企业信息表
 * @table user_company
 * rapidPHP auto generate Model 2021-01-05 00:02:37
 */
class UserCompanyModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'user_company';
        
    
    /**
     *  企业id
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
     * 企业名称
     * @length 50
     * @typed varchar
     */
    private $company_name;    
    
    /**
     * 企业组织机构代码
     * @length 100
     * @typed varchar
     */
    private $organization_code;    
    
    /**
     * 企业税号
     * @length 18
     * @typed varchar
     */
    private $tax_no;    
    
    /**
     * 营业执照对应的文件Id
     * @length 
     * @typed bigint
     */
    private $business_fid;    
    
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
     * 获取  企业id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * 设置  企业id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * 效验  企业id
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
     * 获取 企业组织机构代码
     * @return string
     */
    public function getOrganizationCode(): ?string
    {
        return $this->organization_code;
    }
    
    /**
     * 设置 企业组织机构代码
     * @param string|null $organization_code
     */
    public function setOrganizationCode(?string $organization_code)
    {
        $this->organization_code = $organization_code;
    }
    
    /**
     * 效验 企业组织机构代码
     * @param string $msg
     * @throws Exception
     */
    public function validOrganizationCode(string $msg = 'organization_code Cannot be empty!')
    {
        if(empty($this->organization_code)) throw new Exception($msg);
    }
    
    /**
     * 获取 企业税号
     * @return string
     */
    public function getTaxNo(): ?string
    {
        return $this->tax_no;
    }
    
    /**
     * 设置 企业税号
     * @param string|null $tax_no
     */
    public function setTaxNo(?string $tax_no)
    {
        $this->tax_no = $tax_no;
    }
    
    /**
     * 效验 企业税号
     * @param string $msg
     * @throws Exception
     */
    public function validTaxNo(string $msg = 'tax_no Cannot be empty!')
    {
        if(empty($this->tax_no)) throw new Exception($msg);
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