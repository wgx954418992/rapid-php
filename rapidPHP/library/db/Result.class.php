<?php

namespace rapidPHP\library\db;

use rapid\library\rapid;
use ReflectionException;

class Result
{

    private $modelClass;

    private $resultArray;

    public function __construct(array $result, $modelClass)
    {
        $this->resultArray = $result;

        $this->modelClass = $modelClass;
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
     * @throws ReflectionException
     */
    public function getInstance($className = null, $article = 0)
    {
        $className = empty($className) ? $this->modelClass : $className;

        return B()->toObject($this->getArticle($article), $className);
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