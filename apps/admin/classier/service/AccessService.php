<?php

namespace apps\admin\classier\service;

use apps\admin\classier\dao\master\admin\AccessDao;
use apps\admin\classier\dao\master\admin\CodeDao;
use apps\admin\classier\wrapper\admin\AccessWrapper;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AdminAccessModel;
use apps\core\classier\model\AdminCodeModel;
use Exception;
use rapidPHP\modules\common\classier\Instances;


class AccessService
{

    /**
     * 单例模式
     */
    use Instances;

    /**
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * 添加编辑Code
     * @param AdminCodeModel $codeModel
     * @return AdminCodeModel
     * @throws Exception
     */
    public function addedCode(AdminCodeModel $codeModel)
    {
        $codeModel->validName('name必填!');

        $codeModel->validCode('code 错误!');

        /** @var CodeDao $codeDao */
        $codeDao = CodeDao::getInstance();

        if (!empty($codeModel->getId())) {
            if (!$codeDao->setCode($codeModel)) throw new Exception('修改code信息失败!');
        } else {
            if (!$codeDao->addCode($codeModel)) throw new Exception('修改code员失败!');
        }

        return $codeModel;
    }

    /**
     * 删除Code
     * @param $codeId
     * @return bool
     * @throws Exception
     */
    public function delCode($codeId): bool
    {
        if (empty($codeId)) throw new Exception('codeId 错误!');

        /** @var CodeDao $codeDao */
        $codeDao = CodeDao::getInstance();

        $codeModel = $codeDao->getCode($codeId);

        if ($codeModel == null) throw new Exception('code不存在!');

        if (!$codeDao->delCode($codeId)) throw new Exception('删除失败!');

        return true;
    }

    /**
     * 获取Code
     * @param $codeId
     * @return AdminCodeModel
     * @throws Exception
     */
    public function getCode($codeId)
    {
        if (empty($codeId)) throw new Exception('codeId 错误!');

        /** @var CodeDao $codeDao */
        $codeDao = CodeDao::getInstance();

        $codeModel = $codeDao->getCode($codeId);

        if ($codeModel == null) throw new Exception('code不存在!');

        return $codeModel;
    }

    /**
     * 获取Code列表
     * @return array
     * @throws Exception
     */
    public function getCodeList()
    {
        /** @var CodeDao $codeDao */
        $codeDao = CodeDao::getInstance();

        return $codeDao->getCodeList();
    }

    /**
     * 通过管理员id获取权限list
     * @param $adminId
     * @return AccessWrapper[]
     * @throws Exception
     */
    public function getAccessListByAdminId($adminId)
    {
        if (empty($adminId)) throw new Exception('adminId error!');

        return AccessDao::getInstance()->getAccessListByAdminId($adminId);
    }

    /**
     * 设置权限
     * @param $adminId
     * @param $codeIds
     * @param null $actionId
     * @throws Exception
     */
    public function setAccessList($adminId, $codeIds, $actionId = null)
    {
        if (empty($adminId)) throw new Exception('adminId error!');

        $isThing = MasterDao::getSQLDB()->isInThing();

        if (!$isThing) MasterDao::getSQLDB()->beginTransaction();

        try {
            AccessDao::getInstance()->delAccessByAdmin($adminId);

            $accessModel = new AdminAccessModel();

            $accessModel->setAdminId($adminId);

            $accessModel->setCreatedId($actionId);

            foreach ($codeIds as $codeId) {

                $accessModel->setCodeId($codeId);

                AccessDao::getInstance()->addAccess($accessModel);
            }

            if (!$isThing && !MasterDao::getSQLDB()->commit()) throw new Exception('保存权限失败!');

        } catch (Exception $e) {
            if (!$isThing) MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }
}
