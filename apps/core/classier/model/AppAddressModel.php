<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 地址表
 * @table app_address
 * rapidPHP auto generate Model 2021-01-25 21:19:26
 */
class AppAddressModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'app_address';
        
    
    /**
     * 企业id
     * @length 
     * @typed bigint
     */
    private $id;    
    
    /**
     * 原始地址id
     * @length 
     * @typed bigint
     */
    private $original_id;    
    
    /**
     * 用户id或者订单id 或者其它唯一的id
     * @length 
     * @typed bigint
     */
    private $bind_id;    
    
    /**
     * 地址名称
     * @length 120
     * @typed varchar
     */
    private $name;    
    
    /**
     * 联系人名称
     * @length 120
     * @typed varchar
     */
    private $contact_name;    
    
    /**
     * 联系人电话
     * @length 16
     * @typed varchar
     */
    private $telephone;    
    
    /**
     * 座机号码
     * @length 16
     * @typed varchar
     */
    private $landline;    
    
    /**
     * 地区id
     * @length 
     * @typed bigint
     */
    private $area_id;    
    
    /**
     * 详细地址
     * @length 120
     * @typed varchar
     */
    private $address;    
    
    /**
     * 邮编
     * @length 20
     * @typed varchar
     */
    private $postcode;    
    
    /**
     * 类型 1欧洲店铺 2 中国工厂 3 仓库
     * @length 
     * @typed tinyint
     */
    private $type;    
    
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
     * 获取 企业id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * 设置 企业id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * 效验 企业id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if(empty($this->id)) throw new Exception($msg);
    }
    
    /**
     * 获取 原始地址id
     * @return mixed
     */
    public function getOriginalId()
    {
        return $this->original_id;
    }
    
    /**
     * 设置 原始地址id
     * @param $original_id
     */
    public function setOriginalId($original_id)
    {
        $this->original_id = $original_id;
    }
    
    /**
     * 效验 原始地址id
     * @param string $msg
     * @throws Exception
     */
    public function validOriginalId(string $msg = 'original_id Cannot be empty!')
    {
        if(empty($this->original_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 用户id或者订单id 或者其它唯一的id
     * @return mixed
     */
    public function getBindId()
    {
        return $this->bind_id;
    }
    
    /**
     * 设置 用户id或者订单id 或者其它唯一的id
     * @param $bind_id
     */
    public function setBindId($bind_id)
    {
        $this->bind_id = $bind_id;
    }
    
    /**
     * 效验 用户id或者订单id 或者其它唯一的id
     * @param string $msg
     * @throws Exception
     */
    public function validBindId(string $msg = 'bind_id Cannot be empty!')
    {
        if(empty($this->bind_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 地址名称
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    
    /**
     * 设置 地址名称
     * @param string|null $name
     */
    public function setName(?string $name)
    {
        $this->name = $name;
    }
    
    /**
     * 效验 地址名称
     * @param string $msg
     * @throws Exception
     */
    public function validName(string $msg = 'name Cannot be empty!')
    {
        if(empty($this->name)) throw new Exception($msg);
    }
    
    /**
     * 获取 联系人名称
     * @return string
     */
    public function getContactName(): ?string
    {
        return $this->contact_name;
    }
    
    /**
     * 设置 联系人名称
     * @param string|null $contact_name
     */
    public function setContactName(?string $contact_name)
    {
        $this->contact_name = $contact_name;
    }
    
    /**
     * 效验 联系人名称
     * @param string $msg
     * @throws Exception
     */
    public function validContactName(string $msg = 'contact_name Cannot be empty!')
    {
        if(empty($this->contact_name)) throw new Exception($msg);
    }
    
    /**
     * 获取 联系人电话
     * @return string
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }
    
    /**
     * 设置 联系人电话
     * @param string|null $telephone
     */
    public function setTelephone(?string $telephone)
    {
        $this->telephone = $telephone;
    }
    
    /**
     * 效验 联系人电话
     * @param string $msg
     * @throws Exception
     */
    public function validTelephone(string $msg = 'telephone Cannot be empty!')
    {
        if(empty($this->telephone)) throw new Exception($msg);
    }
    
    /**
     * 获取 座机号码
     * @return string
     */
    public function getLandline(): ?string
    {
        return $this->landline;
    }
    
    /**
     * 设置 座机号码
     * @param string|null $landline
     */
    public function setLandline(?string $landline)
    {
        $this->landline = $landline;
    }
    
    /**
     * 效验 座机号码
     * @param string $msg
     * @throws Exception
     */
    public function validLandline(string $msg = 'landline Cannot be empty!')
    {
        if(empty($this->landline)) throw new Exception($msg);
    }
    
    /**
     * 获取 地区id
     * @return mixed
     */
    public function getAreaId()
    {
        return $this->area_id;
    }
    
    /**
     * 设置 地区id
     * @param $area_id
     */
    public function setAreaId($area_id)
    {
        $this->area_id = $area_id;
    }
    
    /**
     * 效验 地区id
     * @param string $msg
     * @throws Exception
     */
    public function validAreaId(string $msg = 'area_id Cannot be empty!')
    {
        if(empty($this->area_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 详细地址
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }
    
    /**
     * 设置 详细地址
     * @param string|null $address
     */
    public function setAddress(?string $address)
    {
        $this->address = $address;
    }
    
    /**
     * 效验 详细地址
     * @param string $msg
     * @throws Exception
     */
    public function validAddress(string $msg = 'address Cannot be empty!')
    {
        if(empty($this->address)) throw new Exception($msg);
    }
    
    /**
     * 获取 邮编
     * @return string
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }
    
    /**
     * 设置 邮编
     * @param string|null $postcode
     */
    public function setPostcode(?string $postcode)
    {
        $this->postcode = $postcode;
    }
    
    /**
     * 效验 邮编
     * @param string $msg
     * @throws Exception
     */
    public function validPostcode(string $msg = 'postcode Cannot be empty!')
    {
        if(empty($this->postcode)) throw new Exception($msg);
    }
    
    /**
     * 获取 类型 1欧洲店铺 2 中国工厂 3 仓库
     * @return int
     */
    public function getType(): ?int
    {
        return $this->type;
    }
    
    /**
     * 设置 类型 1欧洲店铺 2 中国工厂 3 仓库
     * @param int|null $type
     */
    public function setType(?int $type)
    {
        $this->type = $type;
    }
    
    /**
     * 效验 类型 1欧洲店铺 2 中国工厂 3 仓库
     * @param string $msg
     * @throws Exception
     */
    public function validType(string $msg = 'type Cannot be empty!')
    {
        if(empty($this->type)) throw new Exception($msg);
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