<?php
namespace rapidPHP\library\db;

use PDOStatement;
use rapid\library\rapid;
use ReflectionException;

class Result
{

    /**
     * pdo结果集
     * @var null|PDOStatement
     */
    private $result;


    private $resultArray = [];


    public function __construct(PDOStatement $result)
    {
        $this->result = $result;

        $this->resultArray = $result->fetchAll();
    }


    /**
     * 获取pdo结果集
     * @return null|PDOStatement
     */
    public function getPdoStatement()
    {
        return $this->result;
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
     * @param $instanceClassName
     * @param int $article
     * @return object
     * @throws ReflectionException
     */
    public function getInstance($instanceClassName, $article = 0)
    {
        return B()->reflectionInstance($instanceClassName, [$this->getArticle($article)]);
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


    /**
     * 添加新对象或者修改对象内容
     * @param $key
     * @param $value
     * @param bool $article
     * @return mixed
     */
    public function setValue($key, $value, $article = false)
    {
        return is_int($article) ? $this->resultArray[$article][$key] = $value : $this->resultArray[$key] = $value;
    }

}