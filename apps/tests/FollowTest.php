<?php

namespace apps\tests;

use apps\core\classier\bean\RelationshipListCondition;
use apps\core\classier\dao\master\user\FollowDao;
use apps\core\classier\service\FollowService;
use Exception;

class FollowTest extends BaseTest
{

    /**
     * 测试添加关注
     * @throws Exception
     */
    public function testAddFollow()
    {
        FollowService::getInstance()
            ->addFollow($this->user->getId(), 97270687153);

        FollowService::getInstance()
            ->addFollow(97270687153, $this->user->getId());

        $this->assertIsBool(true);
    }


}
