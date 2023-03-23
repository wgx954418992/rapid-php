<?php

namespace script\crontab\classier\controller;

use Exception;
use rapidPHP\modules\core\classier\console\ConsoleController;

class CrontabController extends ConsoleController
{

    /**
     * start
     * @route /start
     * @throws Exception
     */
    public function sendGoodMorning()
    {
        $this->psuccess('您好 这里是定时任务');
    }
}
