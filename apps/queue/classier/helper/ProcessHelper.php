<?php


namespace apps\queue\classier\helper;


use apps\core\classier\model\AppQueueModel;
use apps\queue\classier\event\QueueEvent;
use Exception;
use rapidPHP\modules\reflection\classier\Utils;
use function rapidPHP\B;

class ProcessHelper
{
    /**
     * 转 queue event
     * @param $data
     * @param $class
     * @return QueueEvent|null
     * @throws Exception
     */
    public static function toQueueEvent($data, $class)
    {
        /** @var AppQueueModel $queueModel */
        $queueModel = unserialize($data);

        $data = $queueModel->toData(['param'], AppQueueModel::MODEL_DEL);

        $param = B()->jsonDecode($queueModel->getParam());

        return Utils::getInstance()->toObject($class, array_merge($data, $param));
    }
}
