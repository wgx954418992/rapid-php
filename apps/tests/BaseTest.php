<?php

namespace apps\tests;

use apps\core\classier\options\UserOptions;
use apps\core\classier\service\UserService;
use apps\core\classier\wrapper\UserWrapper;
use Exception;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{

    /**
     * @var UserWrapper
     */
    protected $user;

    /**
     * 测试获取用户信息
     * @before
     * @throws Exception
     */
    public function testUser()
    {
        $this->user = UserService::getInstance()
            ->getUserByTel('+86***********', null, UserOptions::i(UserOptions::MEMBER));

        $this->assertNotEmpty($this->user);

        return $this->user;
    }
}
