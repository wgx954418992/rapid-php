<?php


use PHPUnit\Framework\TestCase;
use rapidPHP\modules\core\classier\Model;
use rapidPHP\modules\database\sql\classier\SQLDB;

class StatisticalModel extends Model
{
    const NAME = 'app_statistical';


    /**
     * @var string|null
     */
    private $url;

    /**
     * @var string|null
     */
    private $createdTime;

    /**
     * @var bool|null
     */
    private $isDeleted;

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string|null
     */
    public function getCreatedTime(): ?string
    {
        return $this->createdTime;
    }

    /**
     * @param string|null $createdTime
     */
    public function setCreatedTime(?string $createdTime): void
    {
        $this->createdTime = $createdTime;
    }

    /**
     * @return bool|null
     */
    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    /**
     * @param bool|null $isDeleted
     */
    public function setIsDeleted(?bool $isDeleted): void
    {
        $this->isDeleted = $isDeleted;
    }

}

class ColumnModel extends Model
{
    const NAME = 'app_column';

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $createdTime;

    /**
     * @var bool|null
     */
    private $isDeleted;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getCreatedTime(): ?string
    {
        return $this->createdTime;
    }

    /**
     * @param string|null $createdTime
     */
    public function setCreatedTime(?string $createdTime): void
    {
        $this->createdTime = $createdTime;
    }

    /**
     * @return bool|null
     */
    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    /**
     * @param bool|null $isDeleted
     */
    public function setIsDeleted(?bool $isDeleted): void
    {
        $this->isDeleted = $isDeleted;
    }


}

class SQLTest extends TestCase
{

    /**
     * @var SQLDB
     */
    private $db;

    /**
     * @before
     * @throws Exception
     */
    public function testSQLDBConnect()
    {
        var_dump(\rapidPHP\modules\excel\classier\Excel::getInstance());


        $config = new \rapidPHP\modules\database\sql\config\ConnectConfig();

        $config->setUrl('mysql://127.0.0.1:3306/?database=test&characterCode=utf8mb4');

        $config->setUsername('root');

        $config->setPassword('Wgx954418992');

        $this->db = new SQLDB();

        $this->db->connect($config);
    }

    /**
     * 测试联合查询
     * @throws Exception
     */
    public function testUnion()
    {
        $driver = $this->db->table(StatisticalModel::NAME)
            ->select('*')
            ->alias('a')
            ->union(function () {
                return $this->db->table(StatisticalModel::NAME)
                    ->select('*')
                    ->alias('c')
                    ->like('c.url', 'rapid');
            });

        var_dump($driver->getSql());

        var_dump($driver->print());
    }


    /**
     * 测试join
     * @throws Exception
     */
    public function testJoin()
    {
        $driver = $this->db->table(StatisticalModel::NAME)
            ->select('*')
            ->alias('a')
            ->join(ColumnModel::NAME, function () {
                return $this->db->table(ColumnModel::NAME)->alias('b')
                    ->on('b.isDeleted', 0);
            })
            ->join(ColumnModel::NAME, function () {
                return $this->db->table(ColumnModel::NAME)->alias('e')
                    ->on('e.isDeleted', 0);
            })
            ->where('a.isDeleted', 0)
            ->where('b.isDeleted', 0)
            ->where('e.isDeleted', 0);

        var_dump($driver->getSql());

        var_dump($driver->print());
    }

    /**
     * 测试update
     * @throws Exception
     */
    public function testUpdate()
    {

        $driver = $this->db->table(StatisticalModel::NAME)
            ->update(['url' => function () {
                return $this->db->table(ColumnModel::NAME)
                    ->select('`name`')->limit(1);
            }]);

        var_dump($driver->getSql());

        var_dump($driver->print());
    }

    /**
     * 测试select
     * @throws Exception
     */
    public function testSelect()
    {
        $driver = $this->db->table(null)
            ->select('url', function () {
                return $this->db->table(StatisticalModel::NAME)
                    ->select('*')
                    ->alias('a')
                    ->union(function () {
                        return $this->db->table(StatisticalModel::NAME)
                            ->select('*')
                            ->alias('c')
                            ->like('c.url', 'rapid');
                    });
            })
            ->alias('d')
            ->like('d.url', 'http')
            ->limit(10);

        var_dump($driver->getSql());

        var_dump($driver->print());
    }

}