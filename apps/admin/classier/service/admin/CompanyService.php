<?php

namespace apps\admin\classier\service\admin;

use apps\admin\classier\bean\CompanyListCondition;
use apps\core\classier\config\CompanyConfig;
use apps\core\classier\context\PathContextInterface;
use apps\core\classier\dao\master\user\CompanyDao;
use apps\core\classier\dao\master\user\LogDao;
use apps\admin\classier\dao\master\ViewCompanyDao;
use apps\core\classier\dao\master\UserDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppUserModel;
use apps\core\classier\model\UserCompanyModel;
use apps\core\classier\wrapper\user\CompanyWrapper;
use apps\admin\classier\wrapper\ViewCompanyWrapper;
use Exception;

class CompanyService extends ValidaAdminService
{
    /**
     * 获取企业列表
     * @param CompanyListCondition $condition
     * @param PathContextInterface $pathContext
     * @return ViewCompanyWrapper[]
     * @throws Exception
     */
    public function getList(CompanyListCondition $condition, PathContextInterface $pathContext): array
    {
        /** @var ViewCompanyDao $companyDao */
        $companyDao = ViewCompanyDao::getInstance();

        $list = $companyDao->getCompanyList($condition);

        /** @var LogDao $logDao */
        $logDao = LogDao::getInstance();

        foreach ($list as $index => $value) {
            $loginCount = $logDao->getLoginCount($value->getId());

            $value->setLoginCount($loginCount);

            $value->setHeadPic($pathContext->getFileUrl($value->getHeadFid()));

            $value->setBusinessPic($pathContext->getFileUrl($value->getBusinessFid()));
        }

        return $list;
    }


    /**
     * 获取企业列表查询总数量
     * @param CompanyListCondition $condition
     * @return int
     * @throws Exception
     */
    public function getListCount(CompanyListCondition $condition): int
    {
        /** @var ViewCompanyDao $companyDao */
        $companyDao = ViewCompanyDao::getInstance();

        return $companyDao->getCompanyListCount($condition);
    }

    /**
     * 通过用户获取企业信息
     * @param $userId
     * @param PathContextInterface|null $pathContext
     * @return CompanyWrapper
     * @throws Exception
     */
    public function getCompanyByUser($userId, PathContextInterface $pathContext = null)
    {
        if (empty($userId)) throw new Exception('userId 错误!');

        /** @var CompanyDao $companyDao */
        $companyDao = CompanyDao::getInstance();

        $companyWrapper = $companyDao->getCompanyByUser($userId);

        if ($companyWrapper == null) throw new Exception('企业信息不存在!');

        if ($pathContext) {
            $companyWrapper->setBusinessPic($pathContext->getFileUrl($companyWrapper->getBusinessFid()));
        }

        return $companyWrapper;
    }


    /**
     * 激活企业
     * @param $companyId
     * @return bool
     * @throws Exception
     */
    public function activation($companyId): bool
    {
        if (empty($companyId)) throw new Exception('companyId 错误!');

        /** @var CompanyDao $companyDao */
        $companyDao = CompanyDao::getInstance();

        $companyModel = $companyDao->getCompany($companyId);

        if ($companyModel == null) throw new Exception('企业不存在!');

        $companyModel->setStatus(CompanyConfig::STATUS_NORMAL);

        $companyModel->setUpdatedId(parent::getAdminId());

        if (!$companyDao->setCompany($companyModel))
            throw new Exception('激活失败!');

        return true;
    }

    /**
     * 修改企业信息
     * @param AppUserModel $userModel
     * @param UserCompanyModel $companyModel
     * @return bool
     * @throws Exception
     */
    public function setCompany(AppUserModel $userModel, UserCompanyModel $companyModel): bool
    {
        $userModel->validId('用户id 错误!');

        $companyModel->validCompanyName('企业名称错误!');

        $companyModel->validEori('Eori错误!');

        $companyModel->validTva('欧盟税号错误!');

        $companyModel->validBusinessFid('请上传营业执照!');

        $companyModel->setUserId($userModel->getId());

        $companyModel->setCreatedId(parent::getAdminId());

        $companyModel->setUpdatedId(parent::getAdminId());

        /** @var CompanyDao $companyDao */
        $companyDao = CompanyDao::getInstance();

        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        MasterDao::getSQLDB()->beginTransaction();

        try {
            if ($companyModel->getId()) {
                $companyDao->setCompany($companyModel);
            } else {
                $companyDao->addCompany($companyModel);
            }

            $userModel->setUpdatedId(parent::getAdminId());

            $userDao->setUser($userModel);

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('修改资料失败!');

            return true;
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }

}