<?php

use enum\classier\Enum;

require '../vendor/autoload.php';

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

/**
 * Class OrderStatusInt
 *
 * @warning `Constant values cannot be repeated`
 */
class OrderStatusInt extends Enum
{

    /**
     * order status wait pay
     */
    public const WAIT_PAY = 0;

    /**
     * order status payed
     */
    public const PAYED = 1;

    /**
     * order status delivering
     */
    public const DELIVERING = 2;

    /**
     * order status complete
     */
    public const COMPLETE = 3;

    /**
     * order status commented
     */
    public const COMMENTED = 4;

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

/**
 * test order status
 * @throws Exception
 */
function testOrderStatus()
{
    $status = new OrderStatus(OrderStatus::WAIT_PAY);

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
}

/**
 * test order status with int
 * @throws Exception
 */
function testOrderStatusInt()
{
    $status = OrderStatusInt::i(OrderStatusInt::WAIT_PAY);

    echo "name: {$status->getName()}" . PHP_EOL;

    echo "value:" . PHP_EOL;

    print_r($status->getValue());

    echo PHP_EOL;

    $status->then(OrderStatusInt::WAIT_PAY, OrderStatusInt::PAYED, function () {
        echo 'Hit WAIT_PAY,PAYED' . PHP_EOL;
    })
        ->then(OrderStatusInt::DELIVERING, function () {
            echo 'Hit DELIVERING' . PHP_EOL;
        })
        ->then(OrderStatusInt::COMPLETE, function () {
            echo 'Hit COMPLETE' . PHP_EOL;
        })
        ->then(OrderStatusInt::COMMENTED, function () {
            echo 'Hit COMMENTED' . PHP_EOL;
        })
        ->fetch();
}

try {
    echo '---------testOrderStatus----------' . PHP_EOL;

    testOrderStatus();

    echo '--------------------------------------' . PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL;

    echo '---------testOrderStatusInt----------' . PHP_EOL;

    testOrderStatusInt();

    echo '--------------------------------------' . PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL;
} catch (Exception $e) {
    exit($e->getMessage() . PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL);
}

