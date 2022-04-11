<?php

namespace apps\app\classier\controller\account;


use apps\core\classier\bean\SignListCondition;
use apps\core\classier\model\AppSignModel;
use apps\core\classier\service\SignService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;

/**
 * Class SignController
 * @route /account/sign
 * @package apps\app\classier\controller\account
 */
class SignController extends ValidaAccountController
{
    /**
     * 是否已经签到了
     * @route /check
     * @method get
     * @param AppSignModel $signModel
     * @return RESTFulApi
     * @throws Exception
     */
    public function checkSign(AppSignModel $signModel)
    {
        $signModel->setUserId(parent::getUserId());

        $signModel->setCreatedId(parent::getUserId());

        $data = SignService::getInstance()->checkSign($signModel);

        return RESTFulApi::success($data);
    }

    /**
     * 添加签到
     * @route /add
     * @method post
     * @return RESTFulApi
     * @throws Exception
     */
    public function addSign()
    {
        $signModel = new AppSignModel();

        $signModel->setUserId(parent::getUserId());

        $signModel->setCreatedId(parent::getUserId());

        SignService::getInstance()->addSign($signModel);

        return RESTFulApi::success();
    }

    /**
     * 获取签到记录
     * @route /list
     * @method get
     * @param SignListCondition $condition
     * @return RESTFulApi
     * @throws Exception
     */
    public function getSignList(SignListCondition $condition)
    {
        $condition->setUserId(parent::getUserId());

        $data = SignService::getInstance()->getSignList($condition);

        return RESTFulApi::success($data);
    }
}
