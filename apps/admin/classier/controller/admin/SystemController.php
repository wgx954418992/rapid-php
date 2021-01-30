<?php

namespace apps\admin\classier\controller\admin;

use apps\admin\classier\service\admin\SystemService;
use apps\core\classier\bean\PageListCondition;
use apps\core\classier\config\BaseConfig;
use Exception;

/**
 * Class SystemController
 * @route /admin/system
 * @package apps\admin\classier\controller\admin
 */
class SystemController extends ValidaAdminController
{


    /**
     * 系统日志列表
     * @route /logs
     * @template admin/system/logs
     * @param PageListCondition $condition
     * @return array
     * @throws Exception
     */
    public function logs(PageListCondition $condition)
    {
        $systemService = new SystemService(parent::getCurrentAdmin());

        $list = $systemService->getLogList($condition);

        $count = $systemService->getLogCount($condition);

        $pager = BaseConfig::pager($count, $condition->getPage(), BaseConfig::PAGE_SIZE_DEFAULT);

        return [
            'condition' => $condition,
            'count' => $count,
            'pager' => $pager,
            'list' => $list,
        ];
    }

}