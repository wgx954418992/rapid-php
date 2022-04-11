<?php

namespace apps\admin\classier\controller\account;


use apps\admin\classier\bean\AdminListCondition;
use apps\admin\classier\enum\admin\Type;
use apps\admin\classier\options\AdminOptions;
use apps\admin\classier\service\AccessService;
use apps\admin\classier\service\AdminService;
use apps\admin\classier\wrapper\AdminWrapper;
use apps\core\classier\helper\CommonHelper;
use apps\core\classier\model\AppAdminModel;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use rapidPHP\modules\reflection\classier\Utils;
use ReflectionException;

/**
 * Class AdminController
 * @route /account/admin
 * @package apps\admin\classier\controller\account
 */
class AdminController extends ValidaAccountController
{
    /**
     * 添加编辑管理员
     * @route /added
     * @typed auto
     * @access ADMIN:ADDED
     * @template account/admin/added
     * @param $submit
     * @param AppAdminModel $model
     * @return AdminWrapper
     * @throws Exception
     */
    public function addedAdmin($submit, AppAdminModel $model)
    {
        if (!empty($submit)) {

            if ($model->getIsSupreme()) $model->setIsSupreme(parent::getAccount()->getIsSupreme());

            if ($model->getId()) {
                $model->setUpdatedId(parent::getAccountId());

                if ($model->getUsername() != parent::getAccount()->getUsername()) {
                    $model->setParentId(parent::getAccountId());
                }
            } else {
                $model->setParentId(parent::getAccountId());

                $model->setCreatedId(parent::getAccountId());
            }

            $adminModel = new AdminWrapper(AdminService::getInstance()->addedAdmin($model)->toData());
        } else {
            if (!empty($model->getId())) {
                $adminModel = AdminService::getInstance()->getAdmin($model->getId());
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
     * @access ADMIN:SUPREME:SET
     * @return RESTFulApi
     * @throws Exception
     */
    public function setIsSupreme($adminId, $is)
    {
        if ($is) $is = parent::getAccount()->getIsSupreme();

        $adminModel = AdminService::getInstance()->getAdmin($adminId);

        $adminModel->setIsSupreme($is);

        $adminModel->setUpdatedId(parent::getAccountId());

        AdminService::getInstance()->setIsSupreme($adminModel);

        return RESTFulApi::success(null, '设置成功');
    }

    /**
     * 添加编辑权限
     * @route /{adminId}/access/added
     * @typed auto
     * @access ADMIN:ACCESS:ADDED
     * @template account/admin/access
     * @param $submit
     * @param $adminId
     * @param array $codeIds post json
     * @return array|bool
     * @throws Exception
     */
    public function addedAccessList($submit, $adminId, array $codeIds)
    {
        if ($submit) {
            if ($adminId == $this->getAccountId()) throw new Exception('您不能修自己的权限！');

            $allowCodeIds = array_map(function ($access) {
                return $access->getCodeId();
            }, $this->getAccount()->getAccessList());

            foreach ($codeIds as $id) {
                if (!in_array($id, $allowCodeIds)) throw new Exception('您的选择超出的您的权限范围，请检查后保存!');
            }

            AccessService::getInstance()->setAccessList($adminId, $codeIds);

            return true;
        }

        $adminModel = AdminService::getInstance()
            ->getAdmin(
                $adminId,
                AdminOptions::i(AdminOptions::OPTIONS_ACCESS_LIST)
            );

        $codes = Utils::getInstance()
            ->toArray(AccessService::getInstance()->getCodeList());

        return [
            'account' => $adminModel,
            'codes' => $codes,
            'access' => $adminModel->getAccessList(),
        ];
    }

    /**
     * 删除管理员
     * @route /{adminId}/del
     * @typed api
     * @method post
     * @access ADMIN:DEL
     * @param $adminId
     * @return RESTFulApi
     * @throws Exception
     */
    public function delAdmin($adminId)
    {
        if ($adminId == parent::getAccountId()) throw new Exception('不能删除自己哦!');

        $adminModel = AdminService::getInstance()->getAdmin($adminId);

        $adminModel->setUpdatedId(parent::getAccountId());

        AdminService::getInstance()->delAdmin($adminModel);

        return RESTFulApi::success(null, '删除成功');
    }

    /**
     * 全部管理员
     * @route /all
     * @method get
     * @typed api
     * @param int|null $type
     * @param int|null $options
     * @return RESTFulApi
     * @throws ReflectionException
     */
    public function getAllAdmin(?int $type = Type::WEB, ?int $options = null)
    {
        $type = is_numeric($type) ? Type::i($type) : null;

        $options = is_numeric($options) ? AdminOptions::i($options) : null;

        $list = AdminService::getInstance()->getAllAdmin($type, $options);

        return RESTFulApi::success($list);
    }

    /**
     * 管理员列表
     * @route /list
     * @method get
     * @typed auto
     * @access ADMIN:LIST
     * @template account/admin/list
     * @param AdminListCondition $condition
     * @return array
     * @throws Exception
     */
    public function getAdminList(AdminListCondition $condition)
    {
        if (empty($condition->getAdminId())) $condition->setAdminId($this->getAccountId());

        if (is_null($condition->getOptions())) $condition->setOptions(AdminOptions::OPTIONS_CREATOR | AdminOptions::OPTIONS_CHILD_COUNT);

        $list = AdminService::getInstance()->getAdminList($condition);

        $count = AdminService::getInstance()->getAdminListCount($condition);

        $pager = CommonHelper::pager($count, $condition->getPage(), $condition->getSize());

        $condition->setOptions(null);

        return [
            'condition' => $condition,
            'count' => $count,
            'pager' => $pager,
            'list' => $list,
        ];
    }

    /**
     * 获取管理员
     * @route /{adminId}/get
     * @method get
     * @typed api
     * @access ADMIN:GET
     * @param $adminId
     * @param $options
     * @return RESTFulApi
     * @throws Exception
     */
    public function getAdmin($adminId, $options)
    {
        $options = is_numeric($options) ? AdminOptions::i($options) : null;

        $adminModel = AdminService::getInstance()->getAdmin($adminId, $options);

        return RESTFulApi::success($adminModel);
    }
}
