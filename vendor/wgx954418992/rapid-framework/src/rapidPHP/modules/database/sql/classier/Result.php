<?php

namespace rapidPHP\modules\database\sql\classier;

use Exception;
use rapidPHP\modules\reflection\classier\Utils as ReflectionUtils;

class Result
{

    /**
     * @var string|object
     */
    private $model;

    /**
     * @var array
     */
    private $resultArray;

    /**
     * Result constructor.
     * @param array $result
     * @param $model
     */
    public function __construct(array $result, $model)
    {
        $this->resultArray = $result;

        $this->model = $model;
    }


    /**
     * 获取结果集
     * @return array
     */
    public function getResult()
    {
        return $this->resultArray;
    }

    /**
     * 获取记录里面的第几条
     * @param int $article
     * @return array
     */
    public function getArticle($article = 0)
    {
        return isset($this->resultArray[$article]) ? $this->resultArray[$article] : [];
    }

    /**
     * 把数据转成实体对象
     * @param $className
     * @param int $article
     * @return object
     * @throws Exception
     */
    public function getInstance($className = null, $article = 0)
    {
        $className = empty($className) ? $this->model : $className;

        return ReflectionUtils::getInstance()
            ->toObject($this->getArticle($article), $className);
    }

    /**
     * 获取值
     * @param null $key
     * @param int $article
     * @return array|mixed|null
     */
    public function getValue($key = null, $article = 0)
    {
        $articleVal = $this->getArticle($article);

        return $key ? isset($articleVal[$key]) ? $articleVal[$key] : null : $this->resultArray;
    }
}