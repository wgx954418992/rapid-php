<?php


namespace rapidPHP\modules\application\wrapper;

use rapidPHP\modules\application\wrapper\database\NoSqlWrapper;
use rapidPHP\modules\application\wrapper\database\SqlWrapper;

class DatabaseWrapper
{

    /**
     * @var SqlWrapper
     */
    private $sql;

    /**
     * @var NoSqlWrapper
     */
    private $nosql;

    /**
     * @return SqlWrapper
     */
    public function getSql(): SqlWrapper
    {
        return $this->sql;
    }

    /**
     * @param SqlWrapper $sql
     */
    public function setSql(SqlWrapper $sql): void
    {
        $this->sql = $sql;
    }

    /**
     * @return NoSqlWrapper
     */
    public function getNosql(): NoSqlWrapper
    {
        return $this->nosql;
    }

    /**
     * @param NoSqlWrapper $nosql
     */
    public function setNosql(NoSqlWrapper $nosql): void
    {
        $this->nosql = $nosql;
    }
}