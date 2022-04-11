<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 收银实际付款表
 * @table cashier_pay
 * rapidPHP auto generate Model 2022-04-11 11:39:20
 */

class CashierPayModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'cashier_pay';

    
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
     * 收银id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $cashier_id;

    /**
     * 设置 收银id
     * @param $cashier_id
     */
    public function setCashierId($cashier_id)
    {
        $this->cashier_id = $cashier_id;
    }

    /**
     * 获取 收银id
     * @return mixed
     */
    public function getCashierId()
    {
        return $this->cashier_id;
    }

    /**
     * 效验 收银id
     * @param string $msg
     * @throws Exception
     */
    public function validCashierId(string $msg = 'cashier_id Cannot be empty!')
    {
        if (empty($this->cashier_id)) throw new Exception($msg);
    }

    /**
     * 收款人
     * @var string|null 
     * @length 50
     * @typed varchar
     */
    protected $payee;

    /**
     * 设置 收款人
     * @param string|null $payee
     */
    public function setPayee(?string $payee)
    {
        $this->payee = $payee;
    }

    /**
     * 获取 收款人
     * @return string|null
     */
    public function getPayee(): ?string
    {
        return $this->payee;
    }

    /**
     * 效验 收款人
     * @param string $msg
     * @throws Exception
     */
    public function validPayee(string $msg = 'payee Cannot be empty!')
    {
        if (empty($this->payee)) throw new Exception($msg);
    }

    /**
     * 付款人
     * @var string|null 
     * @length 50
     * @typed varchar
     */
    protected $payer;

    /**
     * 设置 付款人
     * @param string|null $payer
     */
    public function setPayer(?string $payer)
    {
        $this->payer = $payer;
    }

    /**
     * 获取 付款人
     * @return string|null
     */
    public function getPayer(): ?string
    {
        return $this->payer;
    }

    /**
     * 效验 付款人
     * @param string $msg
     * @throws Exception
     */
    public function validPayer(string $msg = 'payer Cannot be empty!')
    {
        if (empty($this->payer)) throw new Exception($msg);
    }

    /**
     * 付款时间
     * @var string|null 
     * @length 
     * @typed datetime
     */
    protected $date;

    /**
     * 设置 付款时间
     * @param string|null $date
     */
    public function setDate(?string $date)
    {
        $this->date = $date;
    }

    /**
     * 获取 付款时间
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * 效验 付款时间
     * @param string $msg
     * @throws Exception
     */
    public function validDate(string $msg = 'date Cannot be empty!')
    {
        if (empty($this->date)) throw new Exception($msg);
    }

    /**
     * 支付状态
     * @var string|null 
     * @length 20
     * @typed varchar
     */
    protected $status;

    /**
     * 设置 支付状态
     * @param string|null $status
     */
    public function setStatus(?string $status)
    {
        $this->status = $status;
    }

    /**
     * 获取 支付状态
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * 效验 支付状态
     * @param string $msg
     * @throws Exception
     */
    public function validStatus(string $msg = 'status Cannot be empty!')
    {
        if (empty($this->status)) throw new Exception($msg);
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
