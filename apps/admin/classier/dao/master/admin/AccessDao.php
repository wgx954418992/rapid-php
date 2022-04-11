<?php

namespace apps\admin\classier\dao\master\admin;

use apps\admin\classier\wrapper\admin\AccessWrapper;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AdminAccessModel;
use Exception;
use function rapidPHP\Cal;

class AccessDao extends MasterDao
{

    /**
     * cache prefix
     */
    public const CACHE_PREFIX = 'admin_access';

    /**
     * AccessDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AdminAccessModel::class);
    }

    /**
     * 添加Access
     * @param AdminAccessModel $roleModel
     * @return bool
     * @throws Exception
     */
    public function addAccess(AdminAccessModel $roleModel): bool
    {
        $result = $this->add([
            'admin_id' => $roleModel->getAdminId(),
            'code_id' => $roleModel->getCodeId(),
            'is_delete' => false,
            'created_id' => $roleModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ], $id);

        if ($result) {
            $roleModel->setId($id);

            $this->delCache($this->getCacheId($roleModel->getAdminId()));
        }

        return $result;
    }

    /**
     * set Access
     * @param AdminAccessModel $roleModel
     * @return bool
     * @throws Exception
     */
    public function setAccess(AdminAccessModel $roleModel): bool
    {
        $result = $this->set([
            'admin_id' => $roleModel->getAdminId(),
            'code_id' => $roleModel->getCodeId(),
            'updated_id' => $roleModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $roleModel->getId())->execute();

        if ($result) {
            $this->delCache($this->getCacheId($roleModel->getAdminId()));
        }

        return $result;
    }

    /**
     * 删除role 通过管理员
     * @param $adminId
     * @return bool
     * @throws Exception
     */
    public function delAccessByAdmin($adminId): bool
    {
        $result = $this->del()->where('admin_id', $adminId)->execute();

        if ($result) {
            $this->delCache($this->getCacheId($adminId));
        }

        return $result;
    }

    /**
     * 获取Access信息
     * @param $id
     * @return AccessWrapper|null
     * @throws Exception
     */
    public function getAccess($id): ?AccessWrapper
    {
        return $this->get()
            ->where('is_delete', false)
            ->where('id', $id)
            ->getStatement()
            ->fetch(AccessWrapper::class);
    }

    /**
     * 通过管理员id获取权限list
     * @param $adminId
     * @return AccessWrapper[]
     * @throws
     * Exception
     */
    public function getAccessListByAdminId($adminId): array
    {
        $cacheId = $this->getCacheId($adminId);

        return (array)$this->getCacheWithCallback($cacheId, function () use ($adminId) {

            return (array)$this->get('access.*,code.code')
                ->alias('access')
                ->join(function () {
                    return CodeDao::getInstance()
                        ->getDriver()
                        ->alias('code')
                        ->on('code.id=access.code_id');
                })
                ->where('admin_id', $adminId)
                ->where('is_delete', false)
                ->getStatement()
                ->fetchAll(AccessWrapper::class);
        });
    }
}
