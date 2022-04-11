<?php

namespace apps\app\classier\controller\account;

use apps\core\classier\bean\RelationshipListCondition;
use apps\core\classier\service\ChainService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;

/**
 * Class ChainController
 * @route /account/chain
 * @package apps\app\classier\controller\account
 */
class ChainController extends ValidaAccountController
{

    /**
     * 获取关系列表
     * @route /relationship/list
     * @method get
     * @param RelationshipListCondition $condition
     * @return RESTFulApi
     * @throws Exception
     */
    public function getRelationshipList(RelationshipListCondition $condition)
    {
        $condition->setSelfUid(parent::getUserId());

        if (!$condition->getUserId()) {
            $condition->setUserId(parent::getUserId());
        }

        $list = ChainService::getInstance()->getRelationshipList($condition);

        return RESTFulApi::success($list);
    }
}
