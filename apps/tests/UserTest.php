<?php

namespace apps\tests;

use apps\core\classier\options\UserOptions;
use apps\core\classier\service\UserService;
use Exception;

class UserTest extends BaseTest
{

    /**
     * 测试获取用户信息
     * @throws Exception
     */
    public function testUserInfo()
    {
        $user = UserService::getInstance()
            ->getUser(
                $this->user->getId(),
                97270687153,
                UserOptions::i(UserOptions::FOLLOW)
            );

        var_dump($user);

        $this->assertIsObject($user);
    }

}
