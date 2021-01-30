<?php

namespace apps\admin\classier\dao\master;

use apps\admin\classier\bean\CompanyListCondition;
use apps\core\classier\config\BaseConfig;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\ViewCompanyModel;
use apps\admin\classier\wrapper\ViewCompanyWrapper;
use Exception;
use rapidPHP\modules\database\sql\classier\Driver;
use rapidPHP\modules\database\sql\classier\driver\Mysql;

class ViewCompanyDao extends MasterDao
{

    /**
     * UserDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(ViewCompanyModel::class);
    }

    /**
     * 获取企业列表查询对象
     * @param CompanyListCondition $condition
     * @return Driver|Mysql
     * @throws Exception
     */
    private function getCompanyListSelect(CompanyListCondition $condition)
    {
        $select = parent::get();

        if (!empty($condition->getKeyword())) {

            $keyName = $select->getOptionsKey('keyword');

            $select->addOptions("%{$condition->getKeyword()}%", $keyName);

            $select->where("(concat(id,email,nickname,company_name,company_id,eori,tva,telephone,register_ip)) LIKE :{$keyName} ");
        }

        if ($condition->getIds()) $select->in('id', $condition->getIds());

        if (!empty($condition->getStartTime())) $select->where("created_time", $condition->getStartTime(), '>=:');

        if (!empty($condition->getEndTime())) $select->where("created_time", $condition->getEndTime(), '<:');

        if ($condition->getStatus()) {
            $select->where('status', $condition->getStatus());
        }

        return $select->where('is_delete', $condition->getIsDelete());
    }


    /**
     * 获取企业列表
     * @param CompanyListCondition $condition
     * @return ViewCompanyWrapper[]
     * @throws Exception
     */
    public function getCompanyList(CompanyListCondition $condition): array
    {
        $select = $this->getCompanyListSelect($condition);

        $select->limit($condition->getPage(), BaseConfig::PAGE_SIZE_DEFAULT);

        return (array)$select->order($condition->getOrderName(), $condition->getOrderType())
            ->getStatement()
            ->fetchAll(ViewCompanyWrapper::class);
    }

    /**
     * 获取企业列表查询总数量
     * @param CompanyListCondition $condition
     * @return int
     * @throws Exception
     */
    public function getCompanyListCount(CompanyListCondition $condition): int
    {
        $select = $this->getCompanyListSelect($condition);

        return (int)$select->resetSql('select')
            ->select('count(id) as count')
            ->getStatement()
            ->fetchValue('count');
    }

}