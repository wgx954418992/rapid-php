<?php

namespace apps\queue\classier\controller;


use apps\queue\classier\process\UnifiedDispatchProcess;

class QueueController extends BaseController
{

    /**
     * @var UnifiedDispatchProcess
     */
    private $mainProcess;

    /**
     * 启动
     * @route /start
     */
    public function start()
    {
        $this->mainProcess = new UnifiedDispatchProcess();
    }
}