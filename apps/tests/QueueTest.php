<?php

namespace apps\tests;

use apps\queue\classier\service\EventService;
class QueueTest extends BaseTest
{


    public function testWorkCreatedEvent()
    {
        EventService::getInstance()->addFollowEvent(177);

        $this->assertIsBool(true);
    }

}
