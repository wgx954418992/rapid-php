<?php

namespace apps\admin\classier\service\admin;


use apps\core\classier\bean\PageListCondition;
use apps\core\classier\dao\master\LogDao;
use Exception;
use rapidPHP\modules\common\classier\Instances;

class SystemService
{

    /**
     * 单例模式
     */
    use Instances;

    /**
     * 初始化当前
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

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
