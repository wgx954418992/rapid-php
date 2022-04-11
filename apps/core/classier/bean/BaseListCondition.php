<?php

namespace apps\core\classier\bean;

use rapidPHP\modules\core\classier\Model;
use function rapidPHP\B;

class BaseListCondition extends Model
{

    /**
     * 指定id
     * @var mixed
     */
    protected $ids;

    /**
     * 关键字
     * @var string
     */
    protected $keyword = '';

    /**
     * 排序类型
     * @var string
     */
    protected $order_type = '';

    /**
     * 排序名称
     * @var string
     */
    protected $order_name = '';

    /**
     * 开始时间
     * @var string
     */
    protected $start_time = '';

    /**
     * 结束时间
     * @var string
     */
    protected $end_time = '';

    /**
     * @return mixed
     */
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * @param mixed $ids
     */
    public function setIds($ids): void
    {
        $this->ids = $ids;
    }

    /**
     * @return string
     */
    public function getKeyword(): string
    {
        return $this->keyword;
    }

    /**
     * @param string|null $keyword
     */
    public function setKeyword(string $keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * @return string
     */
    public function getOrderType(): string
    {
        $orderType = strtoupper($this->order_type);

        if (empty($orderType)) $orderType = 'DESC';

        if ($orderType != 'DESC' && $orderType != 'ASC') return 'DESC';

        return $orderType;
    }

    /**
     * @param string $order_type
     */
    public function setOrderType(string $order_type)
    {
        $this->order_type = $order_type;
    }

    /**
     * @return string
     */
    public function getOrderName(): string
    {
        return B()->contrast($this->order_name, 'created_time');
    }

    /**
     * @param string $order_name
     */
    public function setOrderName(string $order_name)
    {
        $this->order_name = $order_name;
    }

    /**
     * @return string
     */
    public function getStartTime(): string
    {
        return $this->start_time;
    }

    /**
     * @param string|null $start_time
     */
    public function setStartTime(string $start_time)
    {
        $this->start_time = $start_time;
    }

    /**
     * @return string
     */
    public function getEndTime(): string
    {
        return $this->end_time;
    }

    /**
     * @param string|null $end_time
     */
    public function setEndTime(string $end_time)
    {
        $this->end_time = $end_time;
    }

    /**
     * @return BaseListCondition
     */
    public function toPageCondition(): BaseListCondition
    {
        return $this;
    }

    /**
     * 解析array
     * @param $value
     * @return array|false|int|mixed|object|string|string[]
     */
    public function parseArray($value)
    {
        if (empty($value)) {
            $value = null;
        } else if (is_string($value)) {
            if (substr($value, 0, 1) === '[' && substr($value, -1) === ']') {
                $value = B()->jsonDecode($value);
            } else {
                $value = explode(",", $value);
            }
        } else if (!is_array($value)) {
            $value = [$value];
        }

        return $value;
    }
}
