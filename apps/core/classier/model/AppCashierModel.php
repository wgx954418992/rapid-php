<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 收银表
 * @table app_cashier
 * rapidPHP auto generate Model 2022-04-11 11:39:18
 */

class AppCashierModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'app_cashier';

    
    /**
     * 订单收银关联Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $id;

    /**
     * 设置 订单收银关联Id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 获取 订单收银关联Id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 效验 订单收银关联Id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if (empty($this->id)) throw new Exception($msg);
    }

    /**
     * 收款标题
     * @var string|null 
     * @length 50
     * @typed varchar
     */
    protected $title;

    /**
     * 设置 收款标题
     * @param string|null $title
     */
    public function setTitle(?string $title)
    {
        $this->title = $title;
    }

    /**
     * 获取 收款标题
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * 效验 收款标题
     * @param string $msg
     * @throws Exception
     */
    public function validTitle(string $msg = 'title Cannot be empty!')
    {
        if (empty($this->title)) throw new Exception($msg);
    }

    /**
     * 总金额
     * @var float|null 
     * @length 
     * @typed decimal
     */
    protected $total_amount;

    /**
     * 设置 总金额
     * @param float|null $total_amount
     */
    public function setTotalAmount(?float $total_amount)
    {
        $this->total_amount = $total_amount;
    }

    /**
     * 获取 总金额
     * @return float|null
     */
    public function getTotalAmount(): ?float
    {
        return $this->total_amount;
    }

    /**
     * 效验 总金额
     * @param string $msg
     * @throws Exception
     */
    public function validTotalAmount(string $msg = 'total_amount Cannot be empty!')
    {
        if (empty($this->total_amount)) throw new Exception($msg);
    }

    /**
     * 实际付款金额
     * @var float|null 
     * @length 
     * @typed decimal
     */
    protected $payment_amount;

    /**
     * 设置 实际付款金额
     * @param float|null $payment_amount
     */
    public function setPaymentAmount(?float $payment_amount)
    {
        $this->payment_amount = $payment_amount;
    }

    /**
     * 获取 实际付款金额
     * @return float|null
     */
    public function getPaymentAmount(): ?float
    {
        return $this->payment_amount;
    }

    /**
     * 效验 实际付款金额
     * @param string $msg
     * @throws Exception
     */
    public function validPaymentAmount(string $msg = 'payment_amount Cannot be empty!')
    {
        if (empty($this->payment_amount)) throw new Exception($msg);
    }

    /**
     * 支付方式 1 微信、2 支付宝 3 钱包
     * @var string|null 
     * @length 10
     * @typed varchar
     */
    protected $pay_type;

    /**
     * 设置 支付方式 1 微信、2 支付宝 3 钱包
     * @param string|null $pay_type
     */
    public function setPayType(?string $pay_type)
    {
        $this->pay_type = $pay_type;
    }

    /**
     * 获取 支付方式 1 微信、2 支付宝 3 钱包
     * @return string|null
     */
    public function getPayType(): ?string
    {
        return $this->pay_type;
    }

    /**
     * 效验 支付方式 1 微信、2 支付宝 3 钱包
     * @param string $msg
     * @throws Exception
     */
    public function validPayType(string $msg = 'pay_type Cannot be empty!')
    {
        if (empty($this->pay_type)) throw new Exception($msg);
    }

    /**
     * 是否支付
     * @var bool|null 
     * @length 
     * @typed bit
     */
    protected $is_pay;

    /**
     * 设置 是否支付
     * @param bool|null $is_pay
     */
    public function setIsPay(?bool $is_pay)
    {
        $this->is_pay = $is_pay;
    }

    /**
     * 获取 是否支付
     * @return bool|null
     */
    public function getIsPay(): ?bool
    {
        return $this->is_pay;
    }

    /**
     * 效验 是否支付
     * @param string $msg
     * @throws Exception
     */
    public function validIsPay(string $msg = 'is_pay Cannot be empty!')
    {
        if (empty($this->is_pay)) throw new Exception($msg);
    }

    /**
     * 付款时间
     * @var string|null 
     * @length 
     * @typed datetime
     */
    protected $pay_time;

    /**
     * 设置 付款时间
     * @param string|null $pay_time
     */
    public function setPayTime(?string $pay_time)
    {
        $this->pay_time = $pay_time;
    }

    /**
     * 获取 付款时间
     * @return string|null
     */
    public function getPayTime(): ?string
    {
        return $this->pay_time;
    }

    /**
     * 效验 付款时间
     * @param string $msg
     * @throws Exception
     */
    public function validPayTime(string $msg = 'pay_time Cannot be empty!')
    {
        if (empty($this->pay_time)) throw new Exception($msg);
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
