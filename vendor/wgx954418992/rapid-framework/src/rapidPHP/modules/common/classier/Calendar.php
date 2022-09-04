<?php

namespace rapidPHP\modules\common\classier;

class Calendar
{
    /**
     * 一分钟的秒数
     */
    const TIME_MINUTE = 60;

    /**
     * 一小时的秒数
     */
    const TIME_HOURS = 3600;

    /**
     * 一天的秒数
     */
    const TIME_DAY = 3600 * 24;

    /**
     * 一周的秒数
     */
    const TIME_WEEK = 3600 * 24 * 7;

    /**
     * 一月的秒数
     */
    const TIME_MONTH = 3600 * 24 * 30;

    /**
     * 一季度（一月按照30天计算的）的秒数
     */
    const TIME_QUARTER = 3600 * 24 * 30 * 3;

    /**
     * 半年（一月按照30天计算的）的秒数
     */
    const TIME_HALFYEAR = 3600 * 24 * 30 * 6;

    /**
     * 一年（平年）的秒数
     */
    const TIME_YEAR = 3600 * 24 * 365;

    /**
     * 一年（闰年年）的秒数
     */
    const TIME_YEAR_INTERCALARY = 3600 * 24 * 366;

    /**
     * 时间=》对应名称
     */
    const TIME_NAMES = [
        0 => '$1秒',
        self::TIME_MINUTE => '$1分钟',
        self::TIME_HOURS => '$1小时',
        self::TIME_DAY => '$1天',
        self::TIME_WEEK => '$1周',
        self::TIME_MONTH => '$1月',
        self::TIME_QUARTER => '$1季度',
        self::TIME_HALFYEAR => '半年',
        self::TIME_YEAR => '$1年',
    ];

    /**
     * 效验是否同一时间模式 只效验是否同一当前
     */
    const HS_MODE_CURRENT = 'c';

    /**
     * 效验是否同一时间模式 效验是否同一全部时间
     */
    const HS_MODE_FULL = 'f';

    /**
     * 采用单例模式
     */
    use Instances;

    /**
     * 实例不存在
     * @return static
     */
    public static function onNotInstance()
    {
        return new static(...func_get_args());
    }

    /**
     * Calendar constructor.
     * @param string $zone
     */
    public function __construct(string $zone = 'PRC')
    {
        self::setZone($zone);
    }

    /**
     * 设置时区
     * @param string $zone
     */
    public static function setZone(string $zone = 'PRC')
    {
        date_default_timezone_set($zone);
    }

    /**
     * 格式化日期，可以传入时间戳，或者时间，如果是时间则会转换成时间戳，在进行转换日期格式化
     * @param $datetime
     * @param string $format
     * @return false|string
     */
    public function format($datetime, string $format = 'Y-m-d H:i:s')
    {
        if (is_string($datetime)) $datetime = $this->dateToTime($datetime);

        if (is_int(strpos($format, 'AY'))) {
            if ($this->getDate($datetime, 'Y') == $this->getDate(time(), 'Y')) {
                $format = preg_replace("#AY(\(.*\)|)#i", '', $format);
            } else {
                $format = preg_replace("#AY(\((.*)\)|)#i", 'Y$2', $format);
            }
        }

        return date($format, $datetime);
    }


    /**
     * 获取时间戳时间或者本地时间
     * @param int|null $time
     * @param string $format
     * @return false|string
     */
    public function getDate(?int $time = null, string $format = 'Y-m-d H:i:s')
    {
        return date($format, !is_null($time) ? $time : time());
    }

    /**
     * 日期到时间戳
     * @param $date
     * @param string $now
     * @return false|int
     */
    public function dateToTime($date, string $now = '')
    {
        if (!empty($now)) {
            return strtotime($date, $now);
        } else {
            return strtotime($date);
        }
    }


    /**
     * 获取时间是星期几
     * @param int|null $time
     * @param string[] $weeks
     * @return array|string|null
     */
    public function getDateWeekName(?int $time = null, array $weeks = ['周天', '周一', '周二', '周三', '周四', '周五', '周六'])
    {
        if (is_null($time)) $time = time();

        return Build::getInstance()->getData($weeks, $this->getDate($time, 'w'));
    }


    /**
     * 格式化秒自动到 分或者时 或者 天 等....
     * @param int $second
     * @param string[] $unitString 可以自己定义
     * @return string
     */
    public function formatSecond(int $second = 0, array $unitString = self::TIME_NAMES): ?string
    {
        ksort($unitString);

        if ($second < self::TIME_MINUTE) return str_replace('$1', $second, $unitString[0]);

        krsort($unitString);

        foreach ($unitString as $time => $unitName) {
            if ($time <= 0) continue;

            $result = floor($second / $time);

            if ($result >= 1) return str_replace('$1', $result, $unitName);
        }

        return null;
    }

    /**
     * 获取指定时间内，有多少闰年，不包含当前年
     * @param $fromTime
     * @param $toTime
     * @return float
     */
    public function getYearIntercalary($fromTime, $toTime)
    {
        return (int)abs(($fromTime - $toTime) / 4) + (($this->isIntercalaryYear($toTime) ? -1 : 0));
    }

    /**
     * 获取结束时间到开始时间相差多少天，当结束时间小于开始时间
     * @param string|int $formDatetime 如果是字符串则按照日期进行计算，会转换成时间戳
     * @param string|int $toDatetime 如果是字符串则按照日期进行计算，会转换成时间戳 默认为今天日期
     * @param string $format 默认是效验是否同一天数，如果要精确的天数的 时间分
     * @return float|int
     */
    public function getTimeToTimeDay(&$formDatetime, &$toDatetime = '', string $format = 'Y-m-d')
    {
        if (is_string($formDatetime)) $formDatetime = $this->dateToTime($this->format($formDatetime, $format));

        if (empty($toDatetime)) $toDatetime = time();

        if (is_string($toDatetime)) $toDatetime = $this->dateToTime($this->format($toDatetime, $format));

        return ($toDatetime - $formDatetime) / 60 / 60 / 24;
    }

    /**
     * 是否闰年
     * @param $date
     * @return bool
     */
    public function isIntercalaryYear($date = null): bool
    {
        if (empty($date)) {
            $year = (int)$this->getDate(time(), 'Y');
        } else {
            $year = (int)$this->format($date, 'Y');
        }

        if ($year % 100 === 0) {
            return $year % 400 == 0 && $year % 3200 != 0;
        } else {
            return $year % 4 == 0 && $year % 100 != 0;
        }
    }


    /**
     * 获取效验是否同一时间模式
     * @param $mode
     * @param $c
     * @param $f
     * @return mixed
     */
    private function getHsMode($mode, $c, $f)
    {
        switch ($mode) {
            case self::HS_MODE_CURRENT:
                return $c;
            case self::HS_MODE_FULL:
                return $f;
        }
        return $f;
    }

    /**
     * 效验是否同一时间
     * @param $from
     * @param $format
     * @param $to
     * @return bool
     */
    public function hsTime($from, $format, $to = null): bool
    {
        if (empty($to)) {
            $to = $this->getDate(time(), $format);
        } else {
            $to = $this->format($to, $format);
        }

        $from = $this->format($from, $format);

        return $from == $to;
    }


    /**
     * 效验是否同一年
     * @param $from
     * @param $to
     * @return bool
     */
    public function hsYear($from, $to = null): bool
    {
        return $this->hsTime($from, 'Y', $to);
    }

    /**
     * 效验是否同一月
     * @param $from
     * @param $to
     * @param string $mode
     * @return bool
     */
    public function hsMonth($from, $to = null, string $mode = self::HS_MODE_FULL): bool
    {
        return $this->hsTime($from, $this->getHsMode($mode, 'm', 'Ym'), $to);
    }

    /**
     * 效验是否同一周
     * @param $from
     * @param $to
     * @param string $mode
     * @return bool
     */
    public function hsWeek($from, $to = null, string $mode = self::HS_MODE_FULL): bool
    {
        return $this->hsTime($from, $this->getHsMode($mode, 'w', 'Ymdw'), $to);
    }

    /**
     * 效验是否同一天
     * @param $from
     * @param $to
     * @param string $mode
     * @return bool
     */
    public function hsDay($from, $to = null, string $mode = self::HS_MODE_FULL): bool
    {
        return $this->hsTime($from, $this->getHsMode($mode, 'd', 'Ymd'), $to);
    }


    /**
     * 效验是否同一时
     * @param $from
     * @param $to
     * @param string $mode
     * @return bool
     */
    public function hsHours($from, $to = null, string $mode = self::HS_MODE_FULL): bool
    {
        return $this->hsTime($from, $this->getHsMode($mode, 'H', 'YmdH'), $to);
    }

    /**
     * 效验是否同一分
     * @param $from
     * @param $to
     * @param string $mode
     * @return bool
     */
    public function hsMinute($from, $to = null, string $mode = self::HS_MODE_FULL): bool
    {
        return $this->hsTime($from, $this->getHsMode($mode, 'i', 'YmdHi'), $to);
    }

    /**
     * 效验是否同一秒
     * @param $from
     * @param $to
     * @param string $mode
     * @return bool
     */
    public function hsSecond($from, $to = null, string $mode = self::HS_MODE_FULL): bool
    {
        return $this->hsTime($from, $this->getHsMode($mode, 's', 'YmdHis'), $to);
    }

    /**
     * 指定时间超出当前时间多少秒 负数为小于多少秒，正数为大于多少秒
     * @param $date
     * @param int $limit
     * @return false|int|mixed
     */
    public function datePassTime($date, int $limit = 0): int
    {
        $date = $this->dateToTime($date);

        return ($date + $limit) - time();
    }
}
