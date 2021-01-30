<?php


namespace apps\queue\classier\process\notify;

use apps\core\classier\helper\CommonHelper;
use apps\core\classier\model\AppQueueModel;
use apps\core\classier\service\BaseService;
use apps\core\classier\service\SMSService;
use apps\queue\classier\config\QueueConfig;
use Exception;
use libphonenumber\PhoneNumber;
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
            $telephone = B()->getData($param, QueueConfig::PARAM_KEY_SMS_TELEPHONE);

            if (empty($telephone)) throw new Exception('telephone 错误');

            $templateId = B()->getData($param, QueueConfig::PARAM_KEY_SMS_TEMPLATE_ID);

            if (empty($templateId)) throw new Exception('templateId 错误');

            $tParam = B()->getData($param, QueueConfig::PARAM_KEY_SMS_PARAM);

            /** @var PhoneNumber $phoneNumber */
            $telephone = CommonHelper::validTelephone($telephone, $phoneNumber);

            $SMSService = SMSService::getInstance();

            $templateCode = $SMSService->getTemplateCodeByType($templateId, $phoneNumber->getCountryCode());

            SMSService::getInstance()->send($templateCode, $telephone, $tParam);
        } catch (Exception $e) {
            BaseService::getInstance()->addLog($e->getMessage(), $e);
        }

        $parentProcess = $this->getParentProcess();

        if ($parentProcess instanceof PipeProcess) $parentProcess->onHandler($data);
    }
}