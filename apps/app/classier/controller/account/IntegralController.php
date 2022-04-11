<?php


namespace apps\app\classier\controller\account;


use apps\app\classier\context\WebContext;
use apps\core\classier\service\IntegralService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use ReflectionException;

/**
 * Class IntegralController
 * @route /account/integral
 * @package apps\app\classier\controller\account
 */
class IntegralController extends ValidaAccountController
{

    /**
     * @var IntegralService
     */
    protected $integralService;

    /**
     * IntegralController constructor.
     * @param WebContext $context
     * @throws ReflectionException
     * @throws Exception
     */
    public function __construct(WebContext $context)
    {
        parent::__construct($context);

        $this->integralService = new IntegralService($this->getUserId());
    }

    /**
     * 获取当前积分
     * @route /get
     * @method get
     * @return RESTFulApi
     * @throws ReflectionException
     */
    public function getIntegral()
    {
        $data = $this->integralService->getPoint();

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
        $data = $this->integralService->getDetailsList($page, $tag);

        return RESTFulApi::success($data);
    }

    /**
     * 充值积分
     * @route /recharge/cashier
     * @method post
     * @param float $point
     * @return RESTFulApi
     * @throws ReflectionException
     * @throws Exception
     */
    public function rechargeCashier(float $point)
    {
        $cashierId = $this->integralService->rechargeCashier($point);

        return RESTFulApi::success($cashierId);
    }
}
