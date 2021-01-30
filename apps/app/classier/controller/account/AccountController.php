<?php

namespace apps\app\classier\controller\account;


use apps\app\classier\context\WebContext;
use apps\app\classier\service\account\AccountService;
use apps\core\classier\context\PathContextInterface;
use apps\core\classier\model\AppAddressModel;
use apps\core\classier\model\UserCompanyModel;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;

/**
 * Class AccountController
 * @route /account
 * @package apps\app\classier\controller\account
 */
class AccountController extends ValidaAccountController
{

    /**
     * @var AccountService
     */
    private $accountService;

    /**
     * AccountController constructor.
     * @param WebContext $context
     * @throws Exception
     */
    public function __construct(WebContext $context)
    {
        parent::__construct($context);

        $this->accountService = new AccountService(parent::getCurrentUser());
    }

    /**
     * 获取当前用户信息
     * @route /info
     * @method get
     * @typed api
     * @param PathContextInterface $pathContext
     * @return RESTFulApi
     * @throws Exception
     */
    public function getCurrentUserInfo(PathContextInterface $pathContext)
    {
        $userModel = parent::getCurrentUser();

        $data = $userModel->toData();

        $data['company'] = $this->accountService->getCurrentCompany($pathContext);

        return RESTFulApi::success($data);
    }

    /**
     * 获取欧洲店铺地址
     * @route /eurostore
     * @method get
     * @typed api
     * @return RESTFulApi
     * @throws Exception
     */
    public function getEuroStore()
    {
        return RESTFulApi::success($this->accountService->getEuroStore());
    }

    /**
     * 完善用户信息
     * @route /perfect
     * @method post
     * @typed api
     * @param $code
     * @param $email
     * @param UserCompanyModel $company
     * @param AppAddressModel $euroStore
     * @return RESTFulApi
     * @throws Exception
     */
    public function perfectInfo($code, $email, UserCompanyModel $company, AppAddressModel $euroStore)
    {
        $this->accountService->perfectInfo($code, $email, $company, $euroStore);

        return RESTFulApi::success(null, '完善成功，等待审核资料哦');
    }
}