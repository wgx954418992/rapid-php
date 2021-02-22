<?php

namespace pay\wx\classier\request;

/**
 * 生成二维码规则,模式一生成支付二维码
 * Class BizPayUrlRequest
 * @package pay\wx\classier\request
 */
class BizPayUrlRequest extends BaseRequest
{

    /**
     * 设置支付时间戳
     * @var string|null
     */
    private $time_stamp;

    /**
     * 设置商品ID
     * @var string|null
     */
    private $product_id;

    /**
     * @return string|null
     */
    public function getTimeStamp(): ?string
    {
        return $this->time_stamp;
    }

    /**
     * @param string|null $time_stamp
     */
    public function setTimeStamp(?string $time_stamp): void
    {
        $this->time_stamp = $time_stamp;
    }

    /**
     * @return string|null
     */
    public function getProductId(): ?string
    {
        return $this->product_id;
    }

    /**
     * @param string|null $product_id
     */
    public function setProductId(?string $product_id): void
    {
        $this->product_id = $product_id;
    }
}