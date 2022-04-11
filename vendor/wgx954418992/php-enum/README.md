PHP Enum 1.1.3
===============
[简体中文](README-zh.md)
>The simplest and fastest PHP enumeration, supports `then` matching callback and Specific `value`

# 1. composer install

```shell
composer require wgx954418992/php-enum
```

# 2. demo

```php
<?php

use enum\classier\Enum;

require '../vendor/autoload.php';

/**
 * Class OrderStatus
 * 
 * @warning `Constant values cannot be repeated`
 */
class OrderStatus extends Enum
{

    /**
     * order status wait pay
     */
    public const WAIT_PAY = 'WAIT_PAY';

    /**
     * order status payed
     */
    public const PAYED = 'PAYED';

    /**
     * order status delivering
     */
    public const DELIVERING = 'DELIVERING';

    /**
     * order status complete next status wait comment
     */
    public const COMPLETE = 'COMPLETE';

    /**
     * order status commented
     */
    public const COMMENTED = 'COMMENTED';

    /**
     * Get real value of constant 'WAIT_PAY', it will be called at the time of construction, but not later And the priority is higher than Static Property
     */
    protected function getWaitPay()
    {
        return new class {

            /**
             * @var string
             */
            private $text = "To be paid";

            /**
             * @return string
             */
            public function getText(): string
            {
                return $this->text;
            }
        };
    }

    /**
     * static property
     * @var string[]
     */
    protected static $_PAYED = ['text' => '已支付'];
}

try {
    $status = OrderStatus::i(OrderStatus::WAIT_PAY);

    echo "name: {$status->getName()}" . PHP_EOL;

    echo "value:" . PHP_EOL;

    print_r($status->getValue());

    echo PHP_EOL;

    $status->then(OrderStatus::WAIT_PAY, OrderStatus::PAYED, function () {
        echo 'Hit WAIT_PAY,PAYED' . PHP_EOL;
    })
        ->then(OrderStatus::DELIVERING, function () {
            echo 'Hit DELIVERING' . PHP_EOL;
        })
        ->then(OrderStatus::COMPLETE, function () {
            echo 'Hit COMPLETE' . PHP_EOL;
        })
        ->then(OrderStatus::COMMENTED, function () {
            echo 'Hit COMMENTED' . PHP_EOL;
        })
        ->fetch();

} catch (Exception $e) {
    exit($e->getMessage());
}
```
