<?php

namespace apps\admin\classier\service\admin\role;


use apps\admin\classier\service\admin\ValidaAdminService;
use apps\core\classier\bean\AdminListCondition;
use apps\core\classier\config\AdminConfig;
use apps\core\classier\dao\master\AdminDao;
use apps\core\classier\model\AppAdminModel;
use apps\core\classier\wrapper\AdminWrapper;
use Exception;
use function rapidPHP\AR;
use function rapidPHP\B;

class AccountService extends ValidaAdminService
{

    /**
     * 添加管理员
     * @param AppAdminModel $adminModel
     * @return AppAdminModel
     * @throws Exception
     */
    public function added(AppAdminModel $adminModel)
    {
        if (empty($adminModel->getUsername())) throw new Exception('账号必填!');

        if (empty($adminModel->getNickname())) throw new Exception('管理员姓名必填!');

        if (empty(AdminConfig::getTypeText($adminModel->getType()))) throw new Exception('类型错误!');

        if ($adminModel->getIsSupreme()) $adminModel->setIsSupreme(parent::getCurrentAdmin()->getIsSupreme());

        /** @var AdminDao $adminDao */
        $adminDao = AdminDao::getInstance();

        if (!empty($adminModel->getId())) {

            $cAdminModel = $adminDao->getAdmin($adminModel->getId());

            if ($cAdminModel != null && $adminModel->getUsername() != $cAdminModel->getUsername()) {
                if ($adminDao->getAdminByUsername($adminModel->getUsername())) {
                    throw new Exception($adminModel->getUsername() . '已经存在!');
                }
            }

            if (!empty($adminModel->getPassword()) && strlen($adminModel->getPassword()) < 6) {
                throw new Exception('密码不能少于6位!');
            }

            $adminModel->setUpdatedId(parent::getAdminId());

            if (!$adminDao->setAdmin($adminModel))
                throw new Exception('修改管理员信息失败!');
        } else {
            if (strlen($adminModel->getPassword()) < 6) throw new Exception('密码不能少于6位!');

            if ($adminDao->getAdminByUsername($adminModel->getUsername()))
                throw new Exception($adminModel->getUsername() . '已经存在!');

            if ($adminModel->getUsername() != parent::getCurrentAdmin()->getUsername()) {
                $adminModel->setParentId(parent::getAdminId());
            }

            $adminModel->setId(B()->onlyIdToInt());

            $adminModel->setCreatedId(parent::getAdminId());

            if (!$adminDao->addAdmin($adminModel))
                throw new Exception('添加管理员失败!');
        }

        return $adminModel;
    }


    /**
     * 获取管理员列表
     * @param AdminListCondition $condition
     * @return array
     * @throws Exception
     */
    public function getList(AdminListCondition $condition)
    {
        if (empty($condition->getAdminId())) $condition->setAdminId(parent::getAdminId());

        /** @var AdminDao $adminDao */
        $adminDao = AdminDao::getInstance();

        $list = $adminDao->getAdminList($condition);

        foreach ($list as $index => $adminWrapper) {
            if ($adminWrapper->getParentId()) {
                $creator = $adminDao->getAdmin($adminWrapper->getParentId());

                $adminWrapper->setCreator($creator);
            }

            if (empty($condition->getAdminId())) $condition->setAdminId(parent::getAdminId());

            $adminWrapper->setChildCount($adminDao->getChildCount($adminWrapper->getId()));

            $list[$index] = $adminWrapper;
        }

        return $list;
    }

    /**
     * 获取管理员列表查询总数量
     * @param AdminListCondition $condition
     * @return int
     * @throws Exception
     */
    public function getListCount(AdminListCondition $condition)
    {
        if (empty($condition->getAdminId())) $condition->setAdminId(parent::getAdminId());

        /** @var AdminDao $adminDao */
        $adminDao = AdminDao::getInstance();

        return $adminDao->getAdminListCount($condition);
    }

    /**
     * 设置是否超级管理员
     * @param $adminId
     * @param $is
     * @return bool
     * @throws Exception
     */
    public function setIsSupreme($adminId, $is): bool
    {
        if (empty($adminId)) throw new Exception('管理员id 错误!');

        /** @var AdminDao $adminDao */
        $adminDao = AdminDao::getInstance();

        if ($is) $is = parent::getCurrentAdmin()->getIsSupreme();

        if (!$adminDao->setIsSupreme(parent::getAdminId(), $adminId, $is))
            throw new Exception('设置失败!');

        return true;
    }

    /**
     * 删除管理员
     * @param $adminId
     * @return bool
     * @throws Exception
     */
    public function del($adminId): bool
    {
        if (empty($adminId)) throw new Exception('管理员id 错误!');

        if ($adminId == parent::getAdminId())
            throw new Exception('不能删除自己哦!');

        /** @var AdminDao $adminDao */
        $adminDao = AdminDao::getInstance();

        if (!$adminDao->delAdmin(parent::getAdminId(), $adminId))
            throw new Exception('删除失败!');

        return true;
    }
}