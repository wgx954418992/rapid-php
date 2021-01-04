<?php


namespace apps\queue\classier\process\notify;

use apps\core\classier\model\AppQueueModel;
use apps\core\classier\service\BaseService;
use apps\core\classier\service\SMSService;
use Exception;
use rapidPHP\modules\process\classier\swoole\PipeProcess;
use function rapidPHP\B;

class SMSProcess extends PipeProcess
{

    /**
     * @param $data
     * @return mixed|void
     * @throws Exception
     */
    public function onHandler($data)
    {
        /** @var AppQueueModel $queueModel */
        $queueModel = unserialize($data);

        $param = B()->jsonDecode($queueModel->getParam());

        try {
            $telephone = B()->getData($param, 'telephone');

            if (empty($telephone)) throw new Exception('telephone 错误');

            $templateCode = B()->getData($param, 'templateCode');

            if (empty($templateCode)) throw new Exception('templateCode 错误');

            SMSService::getInstance()->send($templateCode, $telephone);
        } catch (Exception $e) {
            BaseService::getInstance()->addLog($e->getMessage(), $e);
        }

        $parentProcess = $this->getParentProcess();

        if ($parentProcess instanceof PipeProcess) $parentProcess->onHandler($data);
    }
}