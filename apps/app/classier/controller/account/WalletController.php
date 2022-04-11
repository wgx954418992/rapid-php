<?php


namespace apps\app\classier\controller\account;


use apps\app\classier\context\WebContext;
use apps\core\classier\bean\CashOutListCondition;
use apps\core\classier\model\AppCashoutModel;
use apps\core\classier\service\WalletService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use ReflectionException;

/**
 * Class WalletController
 * @route /account/wallet
 * @package apps\app\classier\controller\account
 */
class WalletController extends ValidaAccountController
{

    /**
     * @var WalletService
     */
    protected $walletService;

    /**
     * IntegralController constructor.
     * @param WebContext $context
     * @throws ReflectionException
     * @throws Exception
     */
    public function __construct(WebContext $context)
    {
        parent::__construct($context);

        $this->walletService = new WalletService($this->getUserId());
    }

    /**
     * 获取当前钱包
     * @route /get
     * @method get
     * @return RESTFulApi
     * @throws ReflectionException
     */
    public function getWallet()
    {
        $data = $this->walletService->getPoint();

        return RESTFulApi::success($data);
    }

    /**
     * 获取明细
     * @route /detail/list
     * @method get
     * @param $page
     * @param array|null $tag get json
     * @return RESTFulApi
     * @throws Exception
     */
    public function getDetailsList($page, ?array $tag)
    {
        $data = $this->walletService->getDetailsList($page, $tag);

        return RESTFulApi::success($data);
    }

    /**
     * 充值钱包
     * @route /recharge/cashier
     * @method post
     * @param float $point
     * @return RESTFulApi
     * @throws ReflectionException
     * @throws Exception
     */
    public function rechargeCashier(float $point)
    {
        $cashierId = $this->walletService->rechargeCashier($point);

        return RESTFulApi::success($cashierId);
    }

    /**
     * 申请提现
     * @route /cashout/apply
     * @method post
     * @param AppCashoutModel $cashout
     * @return RESTFulApi
     * @throws ReflectionException
     * @throws Exception
     */
    public function applyCashOut(AppCashoutModel $cashout)
    {
        $cashout->setUserId(parent::getUserId());

        $cashout->setCreatedId(parent::getUserId());

        $this->walletService->applyCashOut($cashout);

        return RESTFulApi::success(null, '申请成功');
    }

    /**
     * 获取提现记录列表
     * @route /cashout/list
     * @method get
     * @param CashOutListCondition $condition
     * @return RESTFulApi
     * @throws Exception
     */
    public function getCashOutList(CashOutListCondition $condition)
    {
        $list = $this->walletService->getCashOutList($condition);

        return RESTFulApi::success($list);
    }

    /**
     * 使用钱包支付
     * @route /payment
     * @method post
     * @param $cashierId
     * @return RESTFulApi
     * @throws ReflectionException
     */
    public function payment($cashierId)
    {
        $this->walletService->payment($cashierId);

        return RESTFulApi::success();
    }
}
