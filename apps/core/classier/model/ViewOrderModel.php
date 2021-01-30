<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * VIEW
 * @table view_order
 * rapidPHP auto generate Model 2021-01-25 21:19:27
 */
class ViewOrderModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'view_order';
        
    
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
     * 箱数
     * @length 
     * @typed int
     */
    private $number;    
    
    /**
     * 取货码
     * @length 50
     * @typed varchar
     */
    private $pickup_code;    
    
    /**
     * 入仓时间
     * @length 
     * @typed datetime
     */
    private $in_wtime;    
    
    /**
     * 到仓时间
     * @length 
     * @typed datetime
     */
    private $reach_wtime;    
    
    /**
     * 支付状态 1.等待⽀付 2.已⽀付 3.⽀付取消
     * @length 
     * @typed tinyint
     */
    private $pay_status;    
    
    /**
     * 订单状态 1.等待确认 2.确认订单 3.货物确认⼊库 4.离港 5.到港 6.清关完成 7.到达⽬的地仓库，等待取货 8.已签收 9.订单取消
     * @length 
     * @typed tinyint
     */
    private $status;    
    
    /**
     * 货物类型：1 散货/拼箱 2 整柜
     * @length 
     * @typed tinyint
     */
    private $goods_type;    
    
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
     * 邮箱
     * @length 28
     * @typed varchar
     */
    private $email;    
    
    /**
     * 企业名称
     * @length 50
     * @typed varchar
     */
    private $company_name;    
    
    /**
     *  企业id
     * @length 
     * @typed bigint
     */
    private $company_id;    
    
    /**
     * 地址名称
     * @length 120
     * @typed varchar
     */
    private $factory_name;    
    
    /**
     * 企业id
     * @length 
     * @typed bigint
     */
    private $factory_id;    
    
    /**
     * 原始地址id
     * @length 
     * @typed bigint
     */
    private $factory_oid;    
    
    /**
     * 地区id
     * @length 
     * @typed bigint
     */
    private $factory_aid;    
    
    /**
     * 详细地址
     * @length 120
     * @typed varchar
     */
    private $factory_address;    
    
    /**
     * 联系人名称
     * @length 120
     * @typed varchar
     */
    private $factory_cname;    
    
    /**
     * 联系人电话
     * @length 16
     * @typed varchar
     */
    private $factory_telephone;    
    
    /**
     * 地址名称
     * @length 120
     * @typed varchar
     */
    private $warehouse_name;    
    
    /**
     * 企业id
     * @length 
     * @typed bigint
     */
    private $warehouse_id;    
    
    /**
     * 原始地址id
     * @length 
     * @typed bigint
     */
    private $warehouse_oid;    
    
    /**
     * 地区id
     * @length 
     * @typed bigint
     */
    private $warehouse_aid;    
    
    /**
     * 详细地址
     * @length 120
     * @typed varchar
     */
    private $warehouse_address;    
    
    /**
     * 联系人名称
     * @length 120
     * @typed varchar
     */
    private $warehouse_cname;    
    
    /**
     * 联系人电话
     * @length 16
     * @typed varchar
     */
    private $warehouse_telephone;    
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
     * 获取 取货码
     * @return string
     */
    public function getPickupCode(): ?string
    {
        return $this->pickup_code;
    }
    
    /**
     * 设置 取货码
     * @param string|null $pickup_code
     */
    public function setPickupCode(?string $pickup_code)
    {
        $this->pickup_code = $pickup_code;
    }
    
    /**
     * 效验 取货码
     * @param string $msg
     * @throws Exception
     */
    public function validPickupCode(string $msg = 'pickup_code Cannot be empty!')
    {
        if(empty($this->pickup_code)) throw new Exception($msg);
    }
    
    /**
     * 获取 入仓时间
     * @return string
     */
    public function getInWtime(): ?string
    {
        return $this->in_wtime;
    }
    
    /**
     * 设置 入仓时间
     * @param string|null $in_wtime
     */
    public function setInWtime(?string $in_wtime)
    {
        $this->in_wtime = $in_wtime;
    }
    
    /**
     * 效验 入仓时间
     * @param string $msg
     * @throws Exception
     */
    public function validInWtime(string $msg = 'in_wtime Cannot be empty!')
    {
        if(empty($this->in_wtime)) throw new Exception($msg);
    }
    
    /**
     * 获取 到仓时间
     * @return string
     */
    public function getReachWtime(): ?string
    {
        return $this->reach_wtime;
    }
    
    /**
     * 设置 到仓时间
     * @param string|null $reach_wtime
     */
    public function setReachWtime(?string $reach_wtime)
    {
        $this->reach_wtime = $reach_wtime;
    }
    
    /**
     * 效验 到仓时间
     * @param string $msg
     * @throws Exception
     */
    public function validReachWtime(string $msg = 'reach_wtime Cannot be empty!')
    {
        if(empty($this->reach_wtime)) throw new Exception($msg);
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
     * 获取 货物类型：1 散货/拼箱 2 整柜
     * @return int
     */
    public function getGoodsType(): ?int
    {
        return $this->goods_type;
    }
    
    /**
     * 设置 货物类型：1 散货/拼箱 2 整柜
     * @param int|null $goods_type
     */
    public function setGoodsType(?int $goods_type)
    {
        $this->goods_type = $goods_type;
    }
    
    /**
     * 效验 货物类型：1 散货/拼箱 2 整柜
     * @param string $msg
     * @throws Exception
     */
    public function validGoodsType(string $msg = 'goods_type Cannot be empty!')
    {
        if(empty($this->goods_type)) throw new Exception($msg);
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
     * 获取 地址名称
     * @return string
     */
    public function getFactoryName(): ?string
    {
        return $this->factory_name;
    }
    
    /**
     * 设置 地址名称
     * @param string|null $factory_name
     */
    public function setFactoryName(?string $factory_name)
    {
        $this->factory_name = $factory_name;
    }
    
    /**
     * 效验 地址名称
     * @param string $msg
     * @throws Exception
     */
    public function validFactoryName(string $msg = 'factory_name Cannot be empty!')
    {
        if(empty($this->factory_name)) throw new Exception($msg);
    }
    
    /**
     * 获取 企业id
     * @return mixed
     */
    public function getFactoryId()
    {
        return $this->factory_id;
    }
    
    /**
     * 设置 企业id
     * @param $factory_id
     */
    public function setFactoryId($factory_id)
    {
        $this->factory_id = $factory_id;
    }
    
    /**
     * 效验 企业id
     * @param string $msg
     * @throws Exception
     */
    public function validFactoryId(string $msg = 'factory_id Cannot be empty!')
    {
        if(empty($this->factory_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 原始地址id
     * @return mixed
     */
    public function getFactoryOid()
    {
        return $this->factory_oid;
    }
    
    /**
     * 设置 原始地址id
     * @param $factory_oid
     */
    public function setFactoryOid($factory_oid)
    {
        $this->factory_oid = $factory_oid;
    }
    
    /**
     * 效验 原始地址id
     * @param string $msg
     * @throws Exception
     */
    public function validFactoryOid(string $msg = 'factory_oid Cannot be empty!')
    {
        if(empty($this->factory_oid)) throw new Exception($msg);
    }
    
    /**
     * 获取 地区id
     * @return mixed
     */
    public function getFactoryAid()
    {
        return $this->factory_aid;
    }
    
    /**
     * 设置 地区id
     * @param $factory_aid
     */
    public function setFactoryAid($factory_aid)
    {
        $this->factory_aid = $factory_aid;
    }
    
    /**
     * 效验 地区id
     * @param string $msg
     * @throws Exception
     */
    public function validFactoryAid(string $msg = 'factory_aid Cannot be empty!')
    {
        if(empty($this->factory_aid)) throw new Exception($msg);
    }
    
    /**
     * 获取 详细地址
     * @return string
     */
    public function getFactoryAddress(): ?string
    {
        return $this->factory_address;
    }
    
    /**
     * 设置 详细地址
     * @param string|null $factory_address
     */
    public function setFactoryAddress(?string $factory_address)
    {
        $this->factory_address = $factory_address;
    }
    
    /**
     * 效验 详细地址
     * @param string $msg
     * @throws Exception
     */
    public function validFactoryAddress(string $msg = 'factory_address Cannot be empty!')
    {
        if(empty($this->factory_address)) throw new Exception($msg);
    }
    
    /**
     * 获取 联系人名称
     * @return string
     */
    public function getFactoryCname(): ?string
    {
        return $this->factory_cname;
    }
    
    /**
     * 设置 联系人名称
     * @param string|null $factory_cname
     */
    public function setFactoryCname(?string $factory_cname)
    {
        $this->factory_cname = $factory_cname;
    }
    
    /**
     * 效验 联系人名称
     * @param string $msg
     * @throws Exception
     */
    public function validFactoryCname(string $msg = 'factory_cname Cannot be empty!')
    {
        if(empty($this->factory_cname)) throw new Exception($msg);
    }
    
    /**
     * 获取 联系人电话
     * @return string
     */
    public function getFactoryTelephone(): ?string
    {
        return $this->factory_telephone;
    }
    
    /**
     * 设置 联系人电话
     * @param string|null $factory_telephone
     */
    public function setFactoryTelephone(?string $factory_telephone)
    {
        $this->factory_telephone = $factory_telephone;
    }
    
    /**
     * 效验 联系人电话
     * @param string $msg
     * @throws Exception
     */
    public function validFactoryTelephone(string $msg = 'factory_telephone Cannot be empty!')
    {
        if(empty($this->factory_telephone)) throw new Exception($msg);
    }
    
    /**
     * 获取 地址名称
     * @return string
     */
    public function getWarehouseName(): ?string
    {
        return $this->warehouse_name;
    }
    
    /**
     * 设置 地址名称
     * @param string|null $warehouse_name
     */
    public function setWarehouseName(?string $warehouse_name)
    {
        $this->warehouse_name = $warehouse_name;
    }
    
    /**
     * 效验 地址名称
     * @param string $msg
     * @throws Exception
     */
    public function validWarehouseName(string $msg = 'warehouse_name Cannot be empty!')
    {
        if(empty($this->warehouse_name)) throw new Exception($msg);
    }
    
    /**
     * 获取 企业id
     * @return mixed
     */
    public function getWarehouseId()
    {
        return $this->warehouse_id;
    }
    
    /**
     * 设置 企业id
     * @param $warehouse_id
     */
    public function setWarehouseId($warehouse_id)
    {
        $this->warehouse_id = $warehouse_id;
    }
    
    /**
     * 效验 企业id
     * @param string $msg
     * @throws Exception
     */
    public function validWarehouseId(string $msg = 'warehouse_id Cannot be empty!')
    {
        if(empty($this->warehouse_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 原始地址id
     * @return mixed
     */
    public function getWarehouseOid()
    {
        return $this->warehouse_oid;
    }
    
    /**
     * 设置 原始地址id
     * @param $warehouse_oid
     */
    public function setWarehouseOid($warehouse_oid)
    {
        $this->warehouse_oid = $warehouse_oid;
    }
    
    /**
     * 效验 原始地址id
     * @param string $msg
     * @throws Exception
     */
    public function validWarehouseOid(string $msg = 'warehouse_oid Cannot be empty!')
    {
        if(empty($this->warehouse_oid)) throw new Exception($msg);
    }
    
    /**
     * 获取 地区id
     * @return mixed
     */
    public function getWarehouseAid()
    {
        return $this->warehouse_aid;
    }
    
    /**
     * 设置 地区id
     * @param $warehouse_aid
     */
    public function setWarehouseAid($warehouse_aid)
    {
        $this->warehouse_aid = $warehouse_aid;
    }
    
    /**
     * 效验 地区id
     * @param string $msg
     * @throws Exception
     */
    public function validWarehouseAid(string $msg = 'warehouse_aid Cannot be empty!')
    {
        if(empty($this->warehouse_aid)) throw new Exception($msg);
    }
    
    /**
     * 获取 详细地址
     * @return string
     */
    public function getWarehouseAddress(): ?string
    {
        return $this->warehouse_address;
    }
    
    /**
     * 设置 详细地址
     * @param string|null $warehouse_address
     */
    public function setWarehouseAddress(?string $warehouse_address)
    {
        $this->warehouse_address = $warehouse_address;
    }
    
    /**
     * 效验 详细地址
     * @param string $msg
     * @throws Exception
     */
    public function validWarehouseAddress(string $msg = 'warehouse_address Cannot be empty!')
    {
        if(empty($this->warehouse_address)) throw new Exception($msg);
    }
    
    /**
     * 获取 联系人名称
     * @return string
     */
    public function getWarehouseCname(): ?string
    {
        return $this->warehouse_cname;
    }
    
    /**
     * 设置 联系人名称
     * @param string|null $warehouse_cname
     */
    public function setWarehouseCname(?string $warehouse_cname)
    {
        $this->warehouse_cname = $warehouse_cname;
    }
    
    /**
     * 效验 联系人名称
     * @param string $msg
     * @throws Exception
     */
    public function validWarehouseCname(string $msg = 'warehouse_cname Cannot be empty!')
    {
        if(empty($this->warehouse_cname)) throw new Exception($msg);
    }
    
    /**
     * 获取 联系人电话
     * @return string
     */
    public function getWarehouseTelephone(): ?string
    {
        return $this->warehouse_telephone;
    }
    
    /**
     * 设置 联系人电话
     * @param string|null $warehouse_telephone
     */
    public function setWarehouseTelephone(?string $warehouse_telephone)
    {
        $this->warehouse_telephone = $warehouse_telephone;
    }
    
    /**
     * 效验 联系人电话
     * @param string $msg
     * @throws Exception
     */
    public function validWarehouseTelephone(string $msg = 'warehouse_telephone Cannot be empty!')
    {
        if(empty($this->warehouse_telephone)) throw new Exception($msg);
    }
}