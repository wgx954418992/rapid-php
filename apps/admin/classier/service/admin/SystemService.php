<?php

namespace apps\admin\classier\service\admin;


use apps\core\classier\bean\PageListCondition;
use apps\core\classier\dao\master\LogDao;
use Exception;

class SystemService extends ValidaAdminService
{

    /**
     * 获取系统日志
     * @param PageListCondition $condition
     * @return array
     * @throws Exception
     */
    public function getLogList(PageListCondition $condition): array
    {
        /** @var LogDao $logDao */
        $logDao = LogDao::getInstance();

        return $logDao->getLogList($condition);
    }

    /**
     * 获取系统日志总数量
     * @param PageListCondition $condition
     * @return int
     * @throws Exception
     */
    public function getLogCount(PageListCondition $condition): int
    {
        /** @var LogDao $logDao */
        $logDao = LogDao::getInstance();

        return $logDao->getLogListCount($condition);
    }
}