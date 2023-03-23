<?php

namespace apps\queue\classier\controller;


use apps\queue\classier\config\QueueConfig;
use apps\queue\classier\model\HandlerModel;
use apps\queue\classier\service\UnifiedDispatchService;
use Exception;
use rapidPHP\modules\application\classier\context\ConsoleContext;
use rapidPHP\modules\reflection\classier\Utils;

class QueueController extends BaseController
{

    /**
     * @var UnifiedDispatchService
     */
    private $dispatchService;

    /**
     * QueueController constructor.
     * @param ConsoleContext $context
     * @throws Exception
     */
    public function __construct(ConsoleContext $context)
    {
        parent::__construct($context);

        $handlers = QueueConfig::getInstance()->getHandlers();

        Utils::getInstance()->toObjects(HandlerModel::class, $handlers);

        $this->dispatchService = new UnifiedDispatchService($this->getOutput(), $handlers);
    }

    /**
     * 启动
     * @route /start
     */
    public function start()
    {
        $this->dispatchService->start(function () {
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