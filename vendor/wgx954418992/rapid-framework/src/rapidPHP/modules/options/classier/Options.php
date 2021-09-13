<?php

namespace rapidPHP\modules\options\classier;


use Exception;

abstract class Options
{

    /**
     * instances
     * @var static[]
     */
    protected static $instances;

    /**
     * options
     * @return int
     */
    public static function options()
    {
        $args = func_get_args();

        if (empty($args)) return 0;

        $value = intval(array_shift($args));

        foreach ($args as $arg) {
            $value = $value | intval($arg);
        }

        return $value;
    }

    /**
     * options
     * @return static
     */
    public static function i()
    {
        $value = static::options(...func_get_args());

        if (!isset(static::$instances[static::class])) {
            return static::$instances[static::class] = new static($value);
        } else {
            $instance = clone static::$instances[static::class];

            $instance->value = $value;

            return $instance;
        }
    }

    /**
     * OPTIONS
     */
    const OPTIONS = 1;

    /**
     * value
     * @var int
     */
    protected $value = self::OPTIONS;

    /**
     * Options constructor.
     */
    public function __construct()
    {
        $this->value = self::options(...func_get_args());
    }

    /**
     * then
     * @param int $member
     * @param callable|null $callable
     * @param bool $isThrow
     * @return int|static
     */
    public function then(int $member, ?callable $callable = null, bool $isThrow = false)
    {
        $result = $this->value & $member;

        if (is_callable($callable)) {
            try {
                if ($result) call_user_func($callable, $result);
            } catch (Exception $e) {
                if ($isThrow) throw $e;
            }

            return $this;
        }

        return $result;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
    }

    /**
     * @param int $value
     */
    public function append(int $value): void
    {
        $this->value = $this->value | $value;
    }
}
