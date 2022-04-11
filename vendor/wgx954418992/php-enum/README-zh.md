PHP Enum 1.1.3
===============
[English](README.md)
>最简单、最快的PHP枚举，支持` then`匹配回调和特定`value`

# 1. 通过composer 安装

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
 * @warning `常量值不能重复`
 */
class OrderStatus extends Enum
{

    /**
     * 订单状态 待支付
     */
    public const WAIT_PAY = 'WAIT_PAY';

    /**
     * 订单状态 已支付
     */
    public const PAYED = 'PAYED';

    /**
     * 订单状态 配送中
     */
    public const DELIVERING = 'DELIVERING';

    /**
     * 订单状态 已完成
     */
    public const COMPLETE = 'COMPLETE';

    /**
     * 订单状态 已评论
     */
    public const COMMENTED = 'COMMENTED';

    /**
     * 获取常量`WAIT_PAY`的实际值，它将在构造时调用，以后不会再调用，并且优先级高于静态属性
     */
    protected function getWaitPay()
    {
        return new class {

            /**
             * @var string
             */
            private $text = "待支付";

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
     * 常量 PAYED 实际值
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
        echo '命中 WAIT_PAY,PAYED' . PHP_EOL;
    })
        ->then(OrderStatus::DELIVERING, function () {
            echo '命中 DELIVERING' . PHP_EOL;
        })
        ->then(OrderStatus::COMPLETE, function () {
            echo '命中 COMPLETE' . PHP_EOL;
        })
        ->then(OrderStatus::COMMENTED, function () {
            echo '命中 COMMENTED' . PHP_EOL;
        })
        ->fetch();
} catch (Exception $e) {
    exit($e->getMessage());
}
```
