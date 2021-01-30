<?php

namespace apps\queue\classier\controller;


use apps\queue\classier\service\UnifiedDispatchService;
use rapidPHP\modules\application\classier\context\ConsoleContext;

class QueueController extends BaseController
{

    /**
     * @var UnifiedDispatchService
     */
    private $dispatchService;

    /**
     * QueueController constructor.
     * @param ConsoleContext $context
     */
    public function __construct(ConsoleContext $context)
    {
        parent::__construct($context);

        $this->dispatchService = new UnifiedDispatchService($this->getOutput());
    }

    /**
     * 启动
     * @route /start
     */
    public function start()
    {
        $this->dispatchService->start(function (){
            $pids = $this->dispatchService->getAllPIDs();

            foreach ($pids as $pid => $type) {
                $this->psuccess("- {$type}:{$pid}");
            }
        });
    }

    /**
     * 重启进程
     * @route /restart
     * @param $pid
     */
    public function restart($pid)
    {
        $this->dispatchService->kill($pid, SIGHUP);
    }

    /**
     * 杀死进程
     * @route /kill
     * @param $pid
     */
    public function kill($pid)
    {
        $this->dispatchService->kill($pid);
    }


}