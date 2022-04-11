<?php

namespace apps\admin\classier\service;


use apps\admin\classier\options\AdminOptions;
use apps\admin\classier\bean\AdminListCondition;
use apps\admin\classier\dao\master\AdminDao;
use apps\admin\classier\enum\admin\Type;
use apps\core\classier\model\AppAdminModel;
use apps\admin\classier\wrapper\AdminWrapper;
use apps\file\classier\config\FileConfig;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use function rapidPHP\B;

class AdminService
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
     * 添加编辑管理员
     * @param AppAdminModel $adminModel
     * @return AppAdminModel
     * @throws Exception
     */
    public function addedAdmin(AppAdminModel $adminModel)
    {
        if (empty($adminModel->getUsername())) throw new Exception('账号必填!');

        if (empty($adminModel->getNickname())) throw new Exception('管理员姓名必填!');

        if (Type::WEB != $adminModel->getType()) throw new Exception('类型错误!');

        /** @var AdminDao $adminDao */
        $adminDao = AdminDao::getInstance();

        if (!empty($adminModel->getId())) {

            $currentAdminModel = $adminDao->getAdmin($adminModel->getId());

            if ($currentAdminModel != null && $adminModel->getUsername() != $currentAdminModel->getUsername()) {
                if ($adminDao->getAdminByUsername($adminModel->getUsername())) {
                    throw new Exception($adminModel->getUsername() . '已经存在!');
                }
            }

            if (!empty($adminModel->getPassword()) && strlen($adminModel->getPassword()) < 6) {
                throw new Exception('密码不能少于6位!');
            }

            if (!$adminDao->setAdmin($adminModel))
                throw new Exception('修改管理员信息失败!');
        } else {
            if (strlen($adminModel->getPassword()) < 6) throw new Exception('密码不能少于6位!');

            if ($adminDao->getAdminByUsername($adminModel->getUsername()))
                throw new Exception($adminModel->getUsername() . '已经存在!');

            $adminModel->setId(B()->onlyIdToInt());

            if (!$adminDao->addAdmin($adminModel))
                throw new Exception('添加管理员失败!');
        }

        return $adminModel;
    }

    /**
     * 删除管理员
     * @param AppAdminModel $adminModel
     * @return bool
     * @throws Exception
     */
    public function delAdmin(AppAdminModel $adminModel): bool
    {
        if (empty($adminModel->getId())) throw new Exception('管理员id 错误!');

        /** @var AdminDao $adminDao */
        $adminDao = AdminDao::getInstance();

        if (!$adminDao->delAdmin($adminModel))
            throw new Exception('删除失败!');

        return true;
    }

    /**
     * set admin options
     * @param AdminWrapper $adminModel
     * @param AdminOptions|null $options
     * @throws Exception
     */
    public function setAdminOptions(AdminWrapper $adminModel, ?AdminOptions $options = null)
    {
        $adminModel->setAvatar(FileConfig::getFileUrl($adminModel->getHeadFid()));

        if (!$options) return;

        /** @var AdminDao $adminDao */
        $adminDao = AdminDao::getInstance();

        $options
            ->then(AdminOptions::OPTIONS_CREATOR, function () use ($adminModel, $adminDao) {
                if (!$adminModel->getParentId()) return;

                $creator = $adminDao->getAdmin($adminModel->getParentId());

                $adminModel->setCreator($creator);
            })
            ->then(AdminOptions::OPTIONS_CHILD_COUNT, function () use ($adminModel, $adminDao) {

                $adminModel->setChildCount($adminDao->getChildCount($adminModel->getId()));
            })
            ->then(AdminOptions::OPTIONS_ACCESS_LIST, function () use ($adminModel, $adminDao) {

                $accessList = AccessService::getInstance()->getAccessListByAdminId($adminModel->getId());

                $adminModel->setAccessList($accessList);
            });
    }

    /**
     * 获取管理员
     * @param $adminId
     * @param AdminOptions|null $options
     * @return AdminWrapper
     * @throws Exception
     */
    public function getAdmin($adminId, ?AdminOptions $options = null)
    {
        if (empty($adminId)) throw new Exception('id error!');

        /** @var AdminDao $adminDao */
        $adminDao = AdminDao::getInstance();

        $adminModel = $adminDao->getAdmin($adminId);

        if ($adminModel == null) throw new Exception('管理员不存在!');

        $this->setAdminOptions($adminModel, $options);

        return $adminModel;
    }

    /**
     * 获取全部管理员列表
     * @param Type|null $type
     * @param AdminOptions|null $options
     * @return AdminWrapper[]
     * @throws Exception
     */
    public function getAllAdmin(?Type $type = null, ?AdminOptions $options = null): array
    {
        /** @var AdminDao $adminDao */
        $adminDao = AdminDao::getInstance();

        $list = $adminDao->getAllAdmin($type);

        foreach ($list as $value) {
            $this->setAdminOptions($value, $options);
        }

        return $list;
    }

    /**
     * 获取管理员列表
     * @param AdminListCondition $condition
     * @return array
     * @throws Exception
     */
    public function getAdminList(AdminListCondition $condition): array
    {
        /** @var AdminDao $adminDao */
        $adminDao = AdminDao::getInstance();

        $list = $adminDao->getAdminList($condition);

        foreach ($list as $value) {
            $this->setAdminOptions($value, $condition->getOptions());
        }

        return $list;
    }

    /**
     * 获取管理员列表查询总数量
     * @param AdminListCondition $condition
     * @return int
     * @throws Exception
     */
    public function getAdminListCount(AdminListCondition $condition): int
    {
        /** @var AdminDao $adminDao */
        $adminDao = AdminDao::getInstance();

        return $adminDao->getAdminListCount($condition);
    }


    /**
     * 设置是否超级管理员
     * @param AppAdminModel $adminModel
     * @return bool
     * @throws Exception
     */
    public function setIsSupreme(AppAdminModel $adminModel): bool
    {
        if (empty($adminModel->getId())) throw new Exception('管理员id 错误!');

        /** @var AdminDao $adminDao */
        $adminDao = AdminDao::getInstance();

        if (!$adminDao->setIsSupreme($adminModel))
            throw new Exception('设置失败!');

        return true;
    }
}
