<?php


namespace rapidPHP\modules\reflection\classier;


use Exception;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\reflection\classier\annotation\Parameter;
use rapidPHP\modules\reflection\classier\annotation\Returned;
use rapidPHP\modules\reflection\classier\annotation\Variable;
use rapidPHP\modules\reflection\config\AnnotationConfig;

class DocComment
{

    /**
     * @var string
     */
    protected $doc;

    /**
     * @var array
     */
    protected static $registers = [];

    /**
     * @param $doc
     * @return DocComment
     * @throws Exception
     */
    public static function getInstance($doc)
    {
        return new static($doc);
    }

    /**
     * DocComment constructor.
     * @param string|null $doc
     * @throws Exception
     */
    public function __construct(?string $doc)
    {
        $this->doc = $doc;

        $configClass = $this->getConfigClass();

        if (!isset(self::$registers[$configClass])) {
            if (method_exists($configClass, 'getAtList')) {
                $list = call_user_func([$configClass, 'getAtList']);

                foreach ($list as $atName => $class) {
                    Annotation::getInstance()->addMapping($atName, $class);
                }
            }

            self::$registers[$configClass] = true;
        }
    }

    /**
     * @return string
     */
    public function getConfigClass()
    {
        return AnnotationConfig::class;
    }

    /**
     * @return string|null
     */
    public function getDoc(): ?string
    {
        return $this->doc;
    }

    /**
     * @param string $doc
     */
    public function setDoc(string $doc): void
    {
        $this->doc = $doc;
    }

    /**
     * 获取注解s
     * @param string|null $name
     * @param $pattern
     * @return array
     * @throws Exception
     */
    public function getAnnotations(?string $name = '.*?', $pattern = null): array
    {
        return Annotation::getInstance()->getAnnotations($this->getDoc(), $name, $pattern);
    }

    /**
     * 获取一条注解
     * @param string|null $name
     * @return mixed|null
     * @throws Exception
     */
    public function getOneAnnotation(?string $name = '.*?')
    {
        return Annotation::getInstance()->getOneAnnotation($this->getDoc(), $name);
    }

    /**
     * 获取Returned注解
     * @return Returned|null
     * @throws Exception
     */
    public function getReturnedAnnotation()
    {
        /** @var Returned $annotation */
        $annotation = $this->getOneAnnotation(AnnotationConfig::AT_RETURNED);

        if ($annotation instanceof Returned) return $annotation;

        return null;
    }

    /**
     * 通过param获取注解
     * @param $name
     * @return Parameter|null
     * @throws Exception
     */
    public function getParamAnnotation($name)
    {
        /** @var Parameter[] $params */
        $params = $this->getAnnotations(
            null,
            "/@(" . AnnotationConfig::AT_PARAM . ")(.*\\\${$name}.*)/i"
        );

        $parameter = Build::getInstance()->getData($params, 0);

        if (empty($parameter)) return null;

        if ($parameter instanceof Parameter) return $parameter;

        return null;
    }

    /**
     * 获取属性 var 注解
     * @return Variable
     * @throws Exception
     */
    public function getVariableAnnotation()
    {
        /** @var Variable $variable */
        $annotation = $this->getOneAnnotation(AnnotationConfig::AT_VARIABLE);

        if ($annotation instanceof Variable) return $annotation;

        return null;
    }

}
