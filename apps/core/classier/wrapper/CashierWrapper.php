<?php

namespace apps\core\classier\wrapper;


use apps\core\classier\model\AppCashierModel;
use apps\core\classier\model\CashierPayModel;

class CashierWrapper extends AppCashierModel
{

    /**
     * 支付信息
     * @var CashierPayModel|null
     */
    public $pay;

    /**
     * @return CashierPayModel|null
     */
    public function getPay(): ?CashierPayModel
    {
        return $this->pay;
    }

    /**
     * @param CashierPayModel|null $pay
     */
    public function setPay(?CashierPayModel $pay): void
    {
        $this->pay = $pay;
    }

}
