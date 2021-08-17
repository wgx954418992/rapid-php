<?php

namespace apps\admin\classier\controller\admin;

use apps\admin\classier\service\admin\SystemService;
use apps\core\classier\bean\PageListCondition;
use apps\core\classier\helper\CommonHelper;
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
        $list = SystemService::getInstance()->getLogList($condition);

        $count = SystemService::getInstance()->getLogCount($condition);

        $pager = CommonHelper::pager($count, $condition->getPage(), $condition->getSize());

        return [
            'condition' => $condition,
            'count' => $count,
            'pager' => $pager,
            'list' => $list,
        ];
    }

}
