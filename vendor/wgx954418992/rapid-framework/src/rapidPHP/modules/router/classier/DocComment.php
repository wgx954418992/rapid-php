<?php


namespace rapidPHP\modules\router\classier;


use Exception;
use rapidPHP\modules\reflection\classier\DocComment as ReflectionDocComment;
use rapidPHP\modules\router\classier\annotation\Encode;
use rapidPHP\modules\router\classier\annotation\Header;
use rapidPHP\modules\router\classier\annotation\Method;
use rapidPHP\modules\router\classier\annotation\Route;
use rapidPHP\modules\router\classier\annotation\Template;
use rapidPHP\modules\router\classier\annotation\Typed;
use rapidPHP\modules\router\config\AnnotationConfig;

class DocComment extends ReflectionDocComment
{

    /**
     * @throws Exception
     */
    public function getConfigClass()
    {
        return AnnotationConfig::class;
    }

    /**
     * 获取Route注解
     * @return Route
     * @throws Exception
     */
    public function getRouteAnnotation()
    {
        /** @var Route $annotation */
        $annotation = $this->getOneAnnotation(AnnotationConfig::AT_ROUTE);

        if ($annotation instanceof Route) return $annotation;

        return null;
    }


    /**
     * 获取Headers注解
     * @return Header[]
     * @throws Exception
     */
    public function getHeadersAnnotation()
    {
        return $this->getAnnotations(AnnotationConfig::AT_HEADER);
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getHeadersArray()
    {
        $result = [];

        $headersAnnotation = $this->getHeadersAnnotation();

        foreach ($headersAnnotation as $headerAnnotation) {
            $result[] = $headerAnnotation->getValue();
        }

        return $result;
    }

    /**
     * 获取Method注解
     * @return Method
     * @throws Exception
     */
    public function getMethodAnnotation()
    {
        /** @var Method $annotation */
        $annotation = $this->getOneAnnotation(AnnotationConfig::AT_METHOD);

        if ($annotation instanceof Method) return $annotation;

        return null;
    }

    /**
     * 获取Typed注解
     * @return Typed
     * @throws Exception
     */
    public function getTypedAnnotation()
    {
        /** @var Typed $annotation */
        $annotation = $this->getOneAnnotation(AnnotationConfig::AT_TYPED);

        if ($annotation instanceof Typed) return $annotation;

        return null;
    }

    /**
     * 获取Template注解
     * @return Template
     * @throws Exception
     */
    public function getTemplateAnnotation()
    {
        /** @var Template $annotation */
        $annotation = $this->getOneAnnotation(AnnotationConfig::AT_TEMPLATE);

        if ($annotation instanceof Template) return $annotation;

        return null;
    }


    /**
     * 获取Encode注解
     * @return Encode
     * @throws Exception
     */
    public function getEncodeAnnotation()
    {
        /** @var Encode $annotation */
        $annotation = $this->getOneAnnotation(AnnotationConfig::AT_ENCODE);

        if ($annotation instanceof Encode) return $annotation;

        return null;
    }
}