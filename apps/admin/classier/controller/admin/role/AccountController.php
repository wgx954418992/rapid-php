<?php

namespace apps\admin\classier\controller\admin\role;


use apps\admin\classier\context\WebContext;
use apps\admin\classier\controller\admin\ValidaAdminController;
use apps\admin\classier\service\admin\role\AccountService;
use apps\admin\classier\service\BaseService;
use apps\core\classier\bean\AdminListCondition;
use apps\core\classier\config\BaseConfig;
use apps\core\classier\model\AppAdminModel;
use apps\core\classier\wrapper\AdminWrapper;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;

/**
 * Class AccountController
 * @route /admin/role/account
 * @package apps\admin\classier\controller\admin\role
 */
class AccountController extends ValidaAdminController
{

    /**
     * @var AccountService
     */
    protected $accountService;

    /**
     * AccountController constructor.
     * @param WebContext $context
     * @throws Exception
     */
    public function __construct(WebContext $context)
    {
        parent::__construct($context);

        $this->accountService = new AccountService(parent::getCurrentAdmin());
    }

    /**
     * 管理员列表
     * @route /list
     * @typed auto
     * @template admin/role/account/list
     * @param AdminListCondition $condition
     * @return array
     * @throws Exception
     */
    public function list(AdminListCondition $condition)
    {
        $list = $this->accountService->getList($condition);

        $count = $this->accountService->getListCount($condition);

        $pager = BaseConfig::pager($count, $condition->getPage(), BaseConfig::PAGE_SIZE_DEFAULT);

        return [
            'condition' => $condition,
            'count' => $count,
            'pager' => $pager,
            'list' => $list,
        ];
    }

    /**
     * 添加或者编辑管理员
     * @route /added
     * @typed auto
     * @template admin/role/account/added
     * @param $submit
     * @param AppAdminModel $model
     * @return AdminWrapper
     * @throws Exception
     */
    public function added($submit, AppAdminModel $model)
    {
        if (!empty($submit)) {
            $adminModel = $this->accountService->added($model);
        } else {
            if (!empty($model->getId())) {
                $adminModel = BaseService::getInstance()->getAdmin($model->getId());
            } else {
                $adminModel = new AdminWrapper();
            }
        }

        return $adminModel;
    }

    /**
     * 修改是否超级管理员
     * @route /{adminId}/supreme/set
     * @typed api
     * @method post
     * @param $adminId
     * @param $is
     * @return RESTFulApi
     * @throws Exception
     */
    public function setIsSupreme($adminId, $is)
    {
        $this->accountService->setIsSupreme($adminId, $is);

        return RESTFulApi::success(null, '设置成功');
    }

    /**
     * 删除管理员
     * @route /{adminId}/del
     * @typed api
     * @method post
     * @param $adminId
     * @return RESTFulApi
     * @throws Exception
     */
    public function del($adminId)
    {
        $this->accountService->del($adminId);

        return RESTFulApi::success(null, '删除成功');
    }
}