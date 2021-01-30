<?php

namespace apps\core\classier\dao\master\user;


use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\UserCompanyModel;
use apps\core\classier\wrapper\user\CompanyWrapper;
use Exception;
use function rapidPHP\Cal;

class CompanyDao extends MasterDao
{

    /**
     * CompanyDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(UserCompanyModel::class);
    }

    /**
     * 添加企业
     * @param UserCompanyModel $companyModel
     * @return bool
     * @throws Exception
     */
    public function addCompany(UserCompanyModel $companyModel): bool
    {
        $result = parent::add([
            'user_id' => $companyModel->getUserId(),
            'company_name' => $companyModel->getCompanyName(),
            'eori' => $companyModel->getEori(),
            'tva' => $companyModel->getTva(),
            'business_fid' => $companyModel->getBusinessFid(),
            'status' => $companyModel->getStatus(),
            'is_delete' => false,
            'created_id' => $companyModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ], $inserId);

        if ($result) $companyModel->setId($inserId);

        return $result;
    }

    /**
     * 修改企业
     * @param UserCompanyModel $companyModel
     * @return bool
     * @throws Exception
     */
    public function setCompany(UserCompanyModel $companyModel): bool
    {
        return parent::set([
            'company_name' => $companyModel->getCompanyName(),
            'eori' => $companyModel->getEori(),
            'tva' => $companyModel->getTva(),
            'business_fid' => $companyModel->getBusinessFid(),
            'status' => $companyModel->getStatus(),
            'updated_id' => $companyModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $companyModel->getId())->execute();
    }

    /**
     * 获取企业信息
     * @param $companyId
     * @return CompanyWrapper|null
     * @throws Exception
     */
    public function getCompany($companyId): ?CompanyWrapper
    {
        /** @var CompanyWrapper $model */
        $model = parent::get()
            ->where('is_delete', false)
            ->where('id', $companyId)
            ->getStatement()
            ->fetch(CompanyWrapper::class);

        return $model;
    }

    /**
     * 通过用户获取企业信息
     * @param $userId
     * @return CompanyWrapper|null
     * @throws Exception
     */
    public function getCompanyByUser($userId): ?CompanyWrapper
    {
        /** @var CompanyWrapper $model */
        $model = parent::get()
            ->where('is_delete', false)
            ->where('user_id', $userId)
            ->getStatement()
            ->fetch(CompanyWrapper::class);

        return $model;
    }
}