<?php


namespace enum\classier;


use Exception;
use ReflectionException;

abstract class Enum
{

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
     * constants
     * @var array
     */
    protected $constants = [];

    /**
     * switch 如果是false 则停止继续往下匹配，如果是true，则继续匹配
     * @var bool
     */
    protected $thenState = true;

    /**
     * BaseEnum constructor.
     * @param null $constValue
     * @throws ReflectionException
     * @throws Exception
     */
    public function __construct($constValue = null)
    {
        if ($constValue instanceof Enum) {
            $this->constValue = $constValue->constValue;
        } else {
            $this->constValue = $constValue;
        }

        $reflection = Utils::getReflection($this);

        $this->constants = Utils::getConstants($reflection);

        if (count($this->constants) != count(array_unique($this->constants))) {
            throw new Exception("Constant values cannot be repeated " . __CLASS__);
        }

        if (!in_array($this->constValue, $this->constants)) {
            throw new Exception("Const Value: {$this->constValue} is not in enum " . __CLASS__);
        }

        $this->constName = array_search($this->constValue, $this->constants);

        $methodName = 'get' . Utils::toFirstUppercase(strtolower($this->constName), '_');

        if (method_exists($this, $methodName)) {
            $this->realValue = call_user_func([$this, $methodName]);
        } else {
            $staticName = "_" . $this->constants[$this->constName];

            $staticProperties = Utils::getStaticProperties($reflection);

            if (isset($staticProperties[$staticName])) {
                $this->realValue = $staticProperties[$staticName];
            }
        }
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

        $this->thenState = !($result === false);

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
}
