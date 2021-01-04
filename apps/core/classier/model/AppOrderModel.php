<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 订单表
 * @table app_order
 * rapidPHP auto generate Model 2021-01-05 00:02:37
 */
class AppOrderModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'app_order';
        
    
    /**
     * 主键
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
     * 联系人名称
     * @length 50
     * @typed varchar
     */
    private $contacts_name;    
    
    /**
     * 联系人电话
     * @length 16
     * @typed varchar
     */
    private $telephone;    
    
    /**
     * 国家id
     * @length 
     * @typed bigint
     */
    private $contry_id;    
    
    /**
     * 城市id
     * @length 
     * @typed bigint
     */
    private $city_id;    
    
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
     * 箱数
     * @length 
     * @typed int
     */
    private $number;    
    
    /**
     * 订单状态 1.等待确认 2.确认订单 3.货物确认⼊库 4.离港 5.到港 6.清关完成 7.到达⽬的地仓库，等待取货 8.已签收 9.订单取消
     * @length 
     * @typed tinyint
     */
    private $status;    
    
    /**
     * 支付状态 1.等待⽀付 2.已⽀付 3.⽀付取消
     * @length 
     * @typed tinyint
     */
    private $pay_status;    
    
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
     * 获取 联系人名称
     * @return string
     */
    public function getContactsName(): ?string
    {
        return $this->contacts_name;
    }
    
    /**
     * 设置 联系人名称
     * @param string|null $contacts_name
     */
    public function setContactsName(?string $contacts_name)
    {
        $this->contacts_name = $contacts_name;
    }
    
    /**
     * 效验 联系人名称
     * @param string $msg
     * @throws Exception
     */
    public function validContactsName(string $msg = 'contacts_name Cannot be empty!')
    {
        if(empty($this->contacts_name)) throw new Exception($msg);
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
     * 获取 国家id
     * @return mixed
     */
    public function getContryId()
    {
        return $this->contry_id;
    }
    
    /**
     * 设置 国家id
     * @param $contry_id
     */
    public function setContryId($contry_id)
    {
        $this->contry_id = $contry_id;
    }
    
    /**
     * 效验 国家id
     * @param string $msg
     * @throws Exception
     */
    public function validContryId(string $msg = 'contry_id Cannot be empty!')
    {
        if(empty($this->contry_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 城市id
     * @return mixed
     */
    public function getCityId()
    {
        return $this->city_id;
    }
    
    /**
     * 设置 城市id
     * @param $city_id
     */
    public function setCityId($city_id)
    {
        $this->city_id = $city_id;
    }
    
    /**
     * 效验 城市id
     * @param string $msg
     * @throws Exception
     */
    public function validCityId(string $msg = 'city_id Cannot be empty!')
    {
        if(empty($this->city_id)) throw new Exception($msg);
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
     * 获取 箱数
     * @return int
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }
    
    /**
     * 设置 箱数
     * @param int|null $number
     */
    public function setNumber(?int $number)
    {
        $this->number = $number;
    }
    
    /**
     * 效验 箱数
     * @param string $msg
     * @throws Exception
     */
    public function validNumber(string $msg = 'number Cannot be empty!')
    {
        if(empty($this->number)) throw new Exception($msg);
    }
    
    /**
     * 获取 订单状态 1.等待确认 2.确认订单 3.货物确认⼊库 4.离港 5.到港 6.清关完成 7.到达⽬的地仓库，等待取货 8.已签收 9.订单取消
     * @return int
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }
    
    /**
     * 设置 订单状态 1.等待确认 2.确认订单 3.货物确认⼊库 4.离港 5.到港 6.清关完成 7.到达⽬的地仓库，等待取货 8.已签收 9.订单取消
     * @param int|null $status
     */
    public function setStatus(?int $status)
    {
        $this->status = $status;
    }
    
    /**
     * 效验 订单状态 1.等待确认 2.确认订单 3.货物确认⼊库 4.离港 5.到港 6.清关完成 7.到达⽬的地仓库，等待取货 8.已签收 9.订单取消
     * @param string $msg
     * @throws Exception
     */
    public function validStatus(string $msg = 'status Cannot be empty!')
    {
        if(empty($this->status)) throw new Exception($msg);
    }
    
    /**
     * 获取 支付状态 1.等待⽀付 2.已⽀付 3.⽀付取消
     * @return int
     */
    public function getPayStatus(): ?int
    {
        return $this->pay_status;
    }
    
    /**
     * 设置 支付状态 1.等待⽀付 2.已⽀付 3.⽀付取消
     * @param int|null $pay_status
     */
    public function setPayStatus(?int $pay_status)
    {
        $this->pay_status = $pay_status;
    }
    
    /**
     * 效验 支付状态 1.等待⽀付 2.已⽀付 3.⽀付取消
     * @param string $msg
     * @throws Exception
     */
    public function validPayStatus(string $msg = 'pay_status Cannot be empty!')
    {
        if(empty($this->pay_status)) throw new Exception($msg);
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