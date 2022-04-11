<?php

namespace apps\admin\classier\controller\account;

use apps\core\classier\bean\LogListCondition;
use apps\core\classier\helper\CommonHelper;
use apps\core\classier\service\BaseService;
use Exception;

/**
 * Class SystemController
 * @route /account/system
 * @package apps\admin\classier\controller\account
 */
class SystemController extends ValidaAccountController
{

    /**
     * 系统日志列表
     * @route /log/list
     * @method get
     * @typed auto
     * @access SYSTEM:LOG:LIST
     * @template account/system/log
     * @param LogListCondition $condition
     * @return array
     * @throws Exception
     */
    public function getLogList(LogListCondition $condition)
    {
        $list = BaseService::getInstance()->getLogList($condition);

        $count = BaseService::getInstance()->getLogCount($condition);

        $pager = CommonHelper::pager($count, $condition->getPage(), $condition->getSize());

        return [
            'condition' => $condition,
            'count' => $count,
            'pager' => $pager,
            'list' => $list,
        ];
    }
}
