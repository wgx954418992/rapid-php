<?php

namespace apps\admin\classier\controller\admin\user;

use apps\admin\classier\bean\CompanyListCondition;
use apps\admin\classier\context\PathContext;
use apps\admin\classier\context\WebContext;
use apps\admin\classier\controller\admin\ValidaAdminController;
use apps\admin\classier\service\admin\CompanyService;
use apps\core\classier\config\BaseConfig;
use apps\core\classier\context\PathContextInterface;
use apps\core\classier\model\AppUserModel;
use apps\core\classier\model\UserCompanyModel;
use apps\core\classier\service\BaseService;
use apps\core\classier\wrapper\user\CompanyWrapper;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;

/**
 * Class CompanyController
 * @route /admin/user/company
 * @package apps\admin\classier\controller\admin
 */
class CompanyController extends ValidaAdminController
{

    /**
     * @var CompanyService
     */
    protected $companyService;

    /**
     * CompanyController constructor.
     * @param WebContext $context
     * @throws Exception
     */
    public function __construct(WebContext $context)
    {
        parent::__construct($context);

        $this->companyService = new CompanyService(parent::getCurrentAdmin());
    }

    /**
     * 企业列表
     * @route /list
     * @template admin/user/company/list
     * @param PathContextInterface $pathContext
     * @param CompanyListCondition $condition
     * @return array
     * @throws Exception
     */
    public function list(PathContextInterface $pathContext, CompanyListCondition $condition)
    {
        $list = $this->companyService->getList($condition, $pathContext);

        $count = $this->companyService->getListCount($condition);

        $pager = BaseConfig::pager($count, $condition->getPage(), BaseConfig::PAGE_SIZE_DEFAULT);

        return [
            'condition' => $condition,
            'count' => $count,
            'pager' => $pager,
            'list' => $list,
        ];
    }

    /**
     * 添加或者编辑企业详情
     * @route /added
     * @template admin/user/company/added
     * @param PathContextInterface $pathContext
     * @param $submit
     * @param $userId
     * @param AppUserModel $user
     * @param UserCompanyModel $company
     * @return array
     * @throws Exception
     */
    public function added($submit, $userId, PathContextInterface $pathContext, AppUserModel $user, UserCompanyModel $company)
    {
        if (!empty($submit)) {
            $this->companyService->setCompany($user, $company);
        } else {
            $user = BaseService::getInstance()->getUser($userId, $pathContext);

            try {
                $company = $this->companyService->getCompanyByUser($userId, $pathContext);
            } catch (Exception $e) {
                $company = new CompanyWrapper();
            }
        }

        return [
            'user' => $user,
            'company' => $company
        ];
    }

    /**
     * 激活企业
     * @route /{userId}/activation
     * @method post
     * @typed api
     * @param $userId
     * @return RESTFulApi
     * @throws Exception
     */
    public function activation($userId)
    {
        $this->companyService->activation($userId);

        return RESTFulApi::success(null, '激活成功');
    }
}