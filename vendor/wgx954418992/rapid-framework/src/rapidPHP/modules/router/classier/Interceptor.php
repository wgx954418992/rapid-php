<?php

namespace rapidPHP\modules\router\classier;

use rapidPHP\modules\common\classier\Verify;

abstract class Interceptor
{

    /**
     * 拦截规则
     * @var string[]
     */
    protected $roles;

    /**
     * 排除规则
     * @var string[]
     */
    protected $excludes;

    /**
     * 是否在排除的规则内
     * @param $realPath
     * @param $role
     * @return bool
     */
    public function isInExclude($realPath, &$role = null)
    {
        foreach ($this->excludes as $value) {
            $pattern = Router::getPatternByString($value);

            $preg = Verify::getInstance()->preg($pattern) ? preg_match($pattern, $realPath) : (int)($pattern == $realPath);

            if (is_int($preg) && $preg == 1) {
                $role = $value;

                return true;
            }
        }

        return false;
    }

    /**
     * 是否在规则内
     * @param $realPath
     * @param $role
     * @return bool
     */
    public function isInRole($realPath, &$role = null)
    {
        foreach ($this->roles as $value) {
            $pattern = Router::getPatternByString($value);

            $preg = Verify::getInstance()->preg($pattern) ? preg_match($pattern, $realPath) : (int)($pattern == $realPath);

            if (is_int($preg) && $preg == 1) {
                $role = $value;

                return true;
            }
        }

        return false;
    }

    /**
     * 处理
     * @param Router $router
     * @param Action $action
     * @param Route $route
     * @param $pathVariable
     * @param $realPath
     * @param $role
     */
    abstract public function onHandler(Router $router, Action $action, Route $route, &$pathVariable, &$realPath, &$role);
}