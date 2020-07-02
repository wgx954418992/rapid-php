<?php

namespace rapidPHP\plugin\pay\model;


class AliPayPayNotifyModel extends BasePayNotifyModel
{
    public $gmt_create;

    public $charset;

    public $subject;

    public $sign;

    public $buyer_id;

    public $invoice_amount;

    public $notify_id;

    public $fund_bill_list;

    public $notify_type;

    public $receipt_amount;

    public $sign_type;

    public $notify_time;

    public $version;

    public $total_amount;

    public $trade_no;

    public $point_amount;

    /**
     * @return mixed
     */
    public function getGmtCreate()
    {
        return $this->gmt_create;
    }

    /**
     * @param mixed $gmt_create
     */
    public function setGmtCreate($gmt_create): void
    {
        $this->gmt_create = $gmt_create;
    }

    /**
     * @return mixed
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * @param mixed $charset
     */
    public function setCharset($charset): void
    {
        $this->charset = $charset;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * @param mixed $sign
     */
    public function setSign($sign): void
    {
        $this->sign = $sign;
    }

    /**
     * @return mixed
     */
    public function getBuyerId()
    {
        return $this->buyer_id;
    }

    /**
     * @param mixed $buyer_id
     */
    public function setBuyerId($buyer_id): void
    {
        $this->buyer_id = $buyer_id;
    }

    /**
     * @return mixed
     */
    public function getInvoiceAmount()
    {
        return $this->invoice_amount;
    }

    /**
     * @param mixed $invoice_amount
     */
    public function setInvoiceAmount($invoice_amount): void
    {
        $this->invoice_amount = $invoice_amount;
    }

    /**
     * @return mixed
     */
    public function getNotifyId()
    {
        return $this->notify_id;
    }

    /**
     * @param mixed $notify_id
     */
    public function setNotifyId($notify_id): void
    {
        $this->notify_id = $notify_id;
    }

    /**
     * @return mixed
     */
    public function getFundBillList()
    {
        return $this->fund_bill_list;
    }

    /**
     * @param mixed $fund_bill_list
     */
    public function setFundBillList($fund_bill_list): void
    {
        $this->fund_bill_list = $fund_bill_list;
    }

    /**
     * @return mixed
     */
    public function getNotifyType()
    {
        return $this->notify_type;
    }

    /**
     * @param mixed $notify_type
     */
    public function setNotifyType($notify_type): void
    {
        $this->notify_type = $notify_type;
    }

    /**
     * @return mixed
     */
    public function getReceiptAmount()
    {
        return $this->receipt_amount;
    }

    /**
     * @param mixed $receipt_amount
     */
    public function setReceiptAmount($receipt_amount): void
    {
        $this->receipt_amount = $receipt_amount;
    }

    /**
     * @return mixed
     */
    public function getSignType()
    {
        return $this->sign_type;
    }

    /**
     * @param mixed $sign_type
     */
    public function setSignType($sign_type): void
    {
        $this->sign_type = $sign_type;
    }

    /**
     * @return mixed
     */
    public function getNotifyTime()
    {
        return $this->notify_time;
    }

    /**
     * @param mixed $notify_time
     */
    public function setNotifyTime($notify_time): void
    {
        $this->notify_time = $notify_time;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version): void
    {
        $this->version = $version;
    }

    /**
     * @return mixed
     */
    public function getTotalAmount()
    {
        return $this->total_amount;
    }

    /**
     * @param mixed $total_amount
     */
    public function setTotalAmount($total_amount): void
    {
        $this->total_amount = $total_amount;
    }

    /**
     * @return mixed
     */
    public function getTradeNo()
    {
        return $this->trade_no;
    }

    /**
     * @param mixed $trade_no
     */
    public function setTradeNo($trade_no): void
    {
        $this->trade_no = $trade_no;
    }

    /**
     * @return mixed
     */
    public function getPointAmount()
    {
        return $this->point_amount;
    }

    /**
     * @param mixed $point_amount
     */
    public function setPointAmount($point_amount): void
    {
        $this->point_amount = $point_amount;
    }
}