<?php

namespace apps\admin\classier\controller\admin;

use apps\admin\classier\bean\UserListCondition;
use apps\admin\classier\service\admin\UserService;
use apps\core\classier\bean\WorkListCondition;
use apps\core\classier\helper\CommonHelper;
use apps\core\classier\service\WorkService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use ReflectionException;

/**
 * Class WorkController
 * @route /admin/work
 * @package apps\admin\classier\controller\admin
 */
class WorkController extends ValidaAdminController
{

    /**
     * 作品列表
     * @route /list
     * @typed auto
     * @template admin/work/list
     * @param WorkListCondition $condition
     * @return array
     * @throws ReflectionException
     * @throws Exception
     */
    public function list(WorkListCondition $condition)
    {
        $condition->setSize(10);

        $list = WorkService::getInstance()->getWorkList($condition);

        $count = WorkService::getInstance()->getWorkListCount($condition);

        $pager = CommonHelper::pager($count, $condition->getPage(), $condition->getSize());

        return [
            'condition' => $condition,
            'count' => $count,
            'pager' => $pager,
            'list' => $list,
        ];
    }

    /**
     * 设置是否推荐到发现页
     * @route /{id}/pr/set
     * @typed api
     * @param $id
     * @param $is
     * @return RESTFulApi
     * @throws Exception
     */
    public function setIsPR($id, $is)
    {
        WorkService::getInstance()->setIsPR($id, $is);

        return RESTFulApi::success('设置成功');
    }
}
