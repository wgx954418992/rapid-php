<?php


namespace apps\core\classier\options;


use rapidPHP\modules\options\classier\Options;

class CashierOptions extends Options
{

    /**
     * options 开始
     */
    const EMPTY = 1;

    /**
     * options pay
     */
    const PAY = self::EMPTY << 1;
}
