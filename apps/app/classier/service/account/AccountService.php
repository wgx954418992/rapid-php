<?php

namespace apps\app\classier\service\account;


use apps\app\classier\context\PathContext;
use apps\core\classier\config\AddressConfig;
use apps\core\classier\config\CompanyConfig;
use apps\core\classier\config\EmailConfig;
use apps\core\classier\context\PathContextInterface;
use apps\core\classier\dao\master\AddressDao;
use apps\core\classier\dao\master\user\CompanyDao;
use apps\core\classier\dao\master\UserDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\helper\CommonHelper;
use apps\core\classier\model\AppAddressModel;
use apps\core\classier\model\UserCompanyModel;
use apps\core\classier\service\AddressService;
use apps\core\classier\service\AreaService;
use apps\core\classier\service\EmailService;
use apps\core\classier\wrapper\AddressWrapper;
use Exception;
use libphonenumber\PhoneNumber;

class AccountService extends ValidaAccountService
{
    /**
     * 获取当前企业信息
     * @param PathContextInterface|null $pathContext
     * @return UserCompanyModel|null
     * @throws Exception
     */
    public function getCurrentCompany(PathContextInterface $pathContext = null)
    {
        /** @var CompanyDao $userDao */
        $companyDao = CompanyDao::getInstance();

        $companyModel = $companyDao->getCompanyByUser(parent::getUserId());

        if ($companyModel == null) return null;

        if ($pathContext) {
            $companyModel->setBusinessPic($pathContext->getFileUrl($companyModel->getBusinessFid()));
        }

        return $companyModel;
    }

    /**
     * 获取欧洲店铺地址
     * @return AddressWrapper|null
     * @throws Exception
     */
    public function getEuroStore()
    {
        /** @var AddressDao $addressDao */
        $addressDao = AddressDao::getInstance();

        $addressModel = $addressDao->getFirstAddressByBT(parent::getUserId(), AddressConfig::TYPE_EUROPEAN_STORES);

        if ($addressModel == null) return null;

        /** @var PhoneNumber $phoneNumber */
        CommonHelper::validTelephone($addressModel->getTelephone(), $phoneNumber);

        $addressModel->setTcode($phoneNumber->getCountryCode());

        $addressModel->setTelephone($phoneNumber->getNationalNumber());

        /** @var AreaService $areaService */
        $areaService = AreaService::getInstance();

        $areaAddress = $areaService->getAreaAddress($addressModel->getAreaId(), true);

        $addressModel->setAddressDetail($areaAddress);

        return $addressModel;
    }

    /**
     * 完善资料
     * @param $code
     * @param $email
     * @param UserCompanyModel $companyModel
     * @param AppAddressModel $euroStore
     * @return bool
     * @throws Exception
     */
    public function perfectInfo($code, $email, UserCompanyModel $companyModel, AppAddressModel $euroStore): bool
    {
        $companyModel->validCompanyName('企业名称错误!');

        $companyModel->validEori('Eori错误!');

        $companyModel->validTva('欧盟税号错误!');

        $companyModel->validBusinessFid('请上传营业执照!');

        $companyModel->setUserId(parent::getUserId());

        $companyModel->setCreatedId(parent::getUserId());

        $companyModel->setUpdatedId(parent::getUserId());

        $companyModel->setStatus(CompanyConfig::STATUS_WAITING);

        EmailService::getInstance()->checkVerificationCode(EmailConfig::TEMPLATE_TYPE_PERFECT, $email, $code);

        $euroStore->setType(AddressConfig::TYPE_EUROPEAN_STORES);

        $euroStore->setBindId(parent::getUserId());

        $euroStore->setCreatedId(parent::getUserId());

        $euroStore->setUpdatedId(parent::getUserId());

        /** @var CompanyDao $companyDao */
        $companyDao = CompanyDao::getInstance();

        $currentCompanyModel = $this->getCurrentCompany();

        $currentEuroStoreModel = $this->getEuroStore();

        if ($currentEuroStoreModel != null) {
            $euroStore->setId($currentEuroStoreModel->getId());
        }

        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        MasterDao::getSQLDB()->beginTransaction();

        try {
            if ($currentCompanyModel == null) {
                $companyDao->addCompany($companyModel);
            } else {
                $companyModel->setId($currentCompanyModel->getId());

                $companyDao->setCompany($companyModel);
            }

            AddressService::getInstance()->addedAddress($euroStore);

            $currentUserModel = parent::getCurrentUser();

            $currentUserModel->setEmail($email);

            $currentUserModel->setUpdatedId(parent::getUserId());

            $userDao->setUser($currentUserModel);

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('完善资料信息错误!');

            return true;
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }

}