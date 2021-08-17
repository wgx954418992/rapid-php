<?php

namespace apps\admin\classier\controller\admin\role;


use apps\admin\classier\controller\admin\ValidaAdminController;
use apps\admin\classier\service\admin\role\AccountService;
use apps\admin\classier\service\BaseService;
use apps\core\classier\bean\AdminListCondition;
use apps\core\classier\helper\CommonHelper;
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
        if (empty($condition->getAdminId())) $condition->setAdminId(parent::getAdminId());

        $list = AccountService::getInstance()->getList($condition);

        $count = AccountService::getInstance()->getListCount($condition);

        $pager = CommonHelper::pager($count, $condition->getPage(), $condition->getSize());

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

            if ($model->getIsSupreme()) $model->setIsSupreme(parent::getCurrentAdmin()->getIsSupreme());

            if ($model->getId()) {
                $model->setUpdatedId(parent::getAdminId());

                if ($model->getUsername() != parent::getCurrentAdmin()->getUsername()) {
                    $model->setParentId(parent::getAdminId());
                }
            } else {
                $model->setCreatedId(parent::getAdminId());
            }

            $adminModel = AccountService::getInstance()->added($model);
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
        if ($is) $is = parent::getCurrentAdmin()->getIsSupreme();

        AccountService::getInstance()->setIsSupreme($adminId, $is, parent::getAdminId());

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
        if ($adminId == parent::getAdminId())
            throw new Exception('不能删除自己哦!');

        AccountService::getInstance()->del($adminId, parent::getAdminId());

        return RESTFulApi::success(null, '删除成功');
    }
}
