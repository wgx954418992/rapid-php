<?php
namespace rapidPHP\library\db;

use PDO;

class Exec
{

    /**
     * 连接对象
     * @var null|PDO
     */
    private $connect = null;

    /**
     * sql执行语句
     * @var null
     */
    private $sql = null;


    /**
     * Exec constructor.
     * @param PDO $connect
     * @param $sql
     */
    public function __construct(PDO $connect, $sql)
    {
        $this->sql = $sql;

        $this->connect = $connect;
    }


    /**
     * 除过select都用这个执行
     * @param array $options
     * @return bool
     */
    public function execute(array $options = [])
    {
        $result = $this->connect->prepare($this->sql);

        return $result->execute($options);
    }



    /**
     * select用这个执行
     * @param array $options
     * @param int $mode
     * @return Result
     */
    public function get(array $options = [], $mode = PDO::FETCH_ASSOC)
    {
        $result = $this->connect->prepare($this->sql);

        $result->execute($options);

        $result->setFetchMode($mode);

        return new Result($result);
    }

}

