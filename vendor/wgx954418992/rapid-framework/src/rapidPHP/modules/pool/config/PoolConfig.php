<?php

namespace rapidPHP\modules\pool\config;

class PoolConfig
{

    /**
     * 最小数量
     * @var int|null
     */
    private $min;

    /**
     * 最大数量
     * @var int|null
     */
    private $max;

    /**
     * 超时时间 sm（预留）
     * @var int|null
     */
    private $timeout;

    /**
     * @return int|null
     */
    public function getMin(): ?int
    {
        return $this->min;
    }

    /**
     * @param int|null $min
     */
    public function setMin(?int $min): void
    {
        $this->min = $min;
    }

    /**
     * @return int|null
     */
    public function getMax(): ?int
    {
        return $this->max;
    }

    /**
     * @param int|null $max
     */
    public function setMax(?int $max): void
    {
        $this->max = $max;
    }

    /**
     * @return int|null
     */
    public function getTimeout(): ?int
    {
        return $this->timeout;
    }

    /**
     * @param int|null $timeout
     */
    public function setTimeout(?int $timeout): void
    {
        $this->timeout = $timeout;
    }
}
