<?php


namespace enum\classier;


use Exception;
use ReflectionException;

abstract class Enum
{

    /**
     * instances
     * @var static[][]
     */
    protected static $instances;

    /**
     * 解析数据
     * @param $value
     * @return mixed
     */
    public static function parseValue($value)
    {
        return $value;
    }

    /**
     * i constants
     * @return static[]
     * @throws ReflectionException
     */
    public static function getIConstants($instance = null)
    {
        if (isset(static::$instances[static::class])) {
            return static::$instances[static::class];
        }

        if (is_null($instance)) $instance = new static();

        $reflection = Utils::getReflection(static::class);

        $constants = Utils::getConstants($reflection);

        foreach ($constants as $name => $value) {
            $self = clone $instance;

            $methodName = 'get' . Utils::toFirstUppercase(strtolower($name), '_');

            if (method_exists($self, $methodName)) {
                $self->realValue = call_user_func([$self, $methodName]);
            } else {
                $staticProperties = Utils::getStaticProperties($reflection);

                if (isset($staticProperties['_' . $name])) {
                    $self->realValue = $staticProperties['_' . $name];
                }
            }

            $self->constName = $name;

            $self->constValue = $value;

            $constants[$name] = $self;
        }

        return static::$instances[static::class] = $constants;
    }

    /**
     * instance
     * @param null $constValue
     * @return void|static
     * @throws ReflectionException
     * @throws Exception
     */
    public static function i($constValue = null)
    {
        $constants = static::getIConstants();

        if ($constValue instanceof Enum) {
            $constValue = $constValue->constValue;
        } else {
            $constValue = static::parseValue($constValue);
        }

        foreach ($constants as $instance) {
            if ($instance->constValue === $constValue) {
                return clone $instance;
            }
        }

        static::onConstValueNotInEnumError($constValue);
    }

    /**
     * error text
     * @throws Exception
     */
    public static function onConstValueNotInEnumError($constValue)
    {
        throw new Exception("Const Value: {$constValue} is not in enum " . static::class);
    }


    /**
     * const name
     * @var mixed|null
     */
    protected $constName;

    /**
     * const value
     * @var mixed|null
     */
    protected $constValue;

    /**
     * real value
     * @var mixed|null
     */
    protected $realValue;

    /**
     * switch 如果是false 则停止继续往下匹配，如果是true，则继续匹配
     * @var bool
     */
    protected $thenState = true;

    /**
     * Enum constructor.
     * @param $constValue
     * @throws Exception
     * @throws ReflectionException
     */
    private function __construct($constValue = null)
    {
        if ($constValue === null) return;

        $constants = static::getIConstants($this);

        if ($constValue instanceof Enum) {
            $constValue = $constValue->constValue;
        } else {
            $constValue = static::parseValue($constValue);
        }

        foreach ($constants as $instance) {

            if ($instance->constValue !== $constValue) continue;

            $this->constName = $instance->constName;

            $this->constValue = $instance->constValue;

            $this->realValue = $instance->realValue;
        }

        if (is_null($this->constValue)) $this->onConstValueNotInEnumError($constValue);
    }

    /**
     * constants
     * @return static[]
     * @throws ReflectionException
     */
    public function getConstants(): array
    {
        return static::getIConstants();
    }

    /**
     * constants
     * @return static[]
     * @throws ReflectionException
     */
    public static function getConstantsWithStatic(): array
    {
        return static::getIConstants();
    }

    /**
     * switch
     * @return $this
     * @throws Exception
     */
    public function then()
    {
        if (!$this->thenState) return $this;

        $parameters = func_get_args();

        if (count($parameters) < 2) throw new Exception('then parameters error');

        $callback = array_pop($parameters);

        if (!is_callable($callback)) throw new Exception('then callback error');

        $then = false;

        foreach ($parameters as $object) {

            $then = $this->equals($object);

            if ($then) break;
        }

        if (!$then) return $this;

        $result = call_user_func_array($callback, [$this]);

        if ($result === false) $this->thenState = false;

        return $this;
    }

    /**
     * default
     * @param callable|null $callback
     * @return $this
     */
    public function default(?callable $callback)
    {
        if (!$this->thenState) return $this;

        call_user_func_array($callback, [$this]);

        $this->thenState = false;

        return $this;
    }

    /**
     * fetch
     * @return void
     */
    public function fetch()
    {
        $this->thenState = true;
    }

    /**
     * 检查两个是否相等
     * @param $object
     * @return bool
     */
    public function equals($object): bool
    {
        $constValue = $object instanceof Enum ? $object->constValue : $object;

        return $this->constValue == $constValue;
    }

    /**
     * value
     * @return int|mixed|string|null
     */
    public function getName()
    {
        return $this->constName;
    }

    /**
     * const value
     * @return int|mixed|string|null
     */
    public function getRawValue()
    {
        return $this->constValue;
    }

    /**
     * Value from get Method or Static Property
     * @return int|mixed|string|null
     */
    public function getValue()
    {
        return $this->realValue ?? $this->constValue;
    }

    /**
     * @return void
     */
    public function __clone()
    {
        $this->thenState = true;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->getValue();
    }
}
