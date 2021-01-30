<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 订单表
 * @table app_order
 * rapidPHP auto generate Model 2021-01-25 21:19:26
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
     * 货物类型：1 散货/拼箱 2 整柜
     * @length 
     * @typed tinyint
     */
    private $goods_type;    
    
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