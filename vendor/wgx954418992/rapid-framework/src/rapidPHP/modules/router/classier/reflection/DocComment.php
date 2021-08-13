<?php


namespace rapidPHP\modules\router\classier\reflection;


use Exception;
use rapidPHP\modules\reflection\classier\DocComment as ReflectionDocComment;
use rapidPHP\modules\router\classier\reflection\annotation\Encode;
use rapidPHP\modules\router\classier\reflection\annotation\Header;
use rapidPHP\modules\router\classier\reflection\annotation\Method;
use rapidPHP\modules\router\classier\reflection\annotation\Route;
use rapidPHP\modules\router\classier\reflection\annotation\Template;
use rapidPHP\modules\router\classier\reflection\annotation\Typed;
use rapidPHP\modules\router\config\AnnotationConfig;

class DocComment extends ReflectionDocComment
{

    /**
     * @throws Exception
     */
    public function getConfigClass(): string
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
    public function getHeadersAnnotation(): array
    {
        return $this->getAnnotations(AnnotationConfig::AT_HEADER);
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getHeadersArray(): array
    {
        $result = [];

        $headersAnnotation = $this->getHeadersAnnotation();

        foreach ($headersAnnotation as $headerAnnotation) {
            if (!($headerAnnotation instanceof Header)) continue;

            $result[] = $headerAnnotation->getValue();
        }

        return $result;
    }

    /**
     * 获取Method注解
     * @return string
     * @throws Exception
     */
    public function getMethodAnnotation()
    {
        $result = [];

        $methodsAnnotation = $this->getAnnotations(AnnotationConfig::AT_METHOD);

        foreach ($methodsAnnotation as $methodAnnotation) {
            if (!($methodAnnotation instanceof Method)) continue;

            $result[] = $methodAnnotation->getMethod();
        }

        return join(",", $result);
    }

    /**
     * 获取Typed注解
     * @return Typed
     * @throws Exception
     */
    public function getTypedAnnotation(): ?Typed
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
