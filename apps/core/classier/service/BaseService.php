<?php

namespace apps\core\classier\service;

use apps\core\classier\bean\LogListCondition;
use apps\core\classier\dao\master\LogDao;
use apps\core\classier\enum\log\Type as LogType;
use apps\core\classier\model\AppLogModel;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use function rapidPHP\formatException;

class BaseService
{

    /**
     * 单例模式
     */
    use Instances;

    /**
     * 初始化当前
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }


    /**
     * 添加系统日志
     * @param $msg
     * @param null $content
     * @param LogType|null $type
     * @param null $bindId
     * @return int
     */
    public function addLog($msg, $content = null, ?LogType $type = null, $bindId = null)
    {
        try {

            $logDao = LogDao::getInstance();

            $logModel = new AppLogModel();

            if ($content instanceof Exception) {
                $content = formatException($content);

                if ($type == null) {
                    $logModel->setType(LogType::ERROR);
                }
            } else {
                if ($type == null) {
                    $logModel->setType(LogType::RUN);
                }

                if (is_array($content) || is_object($content)) $content = json_encode($content);
            }

            $logModel->setMsg($msg);

            $logModel->setContent($content);

            if ($type != null) {
                $logModel->setType($type->getRawValue());
            }

            $logModel->setBindId($bindId);

            $logDao->addLog($logModel);

            return $logModel->getId();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * 获取系统日志
     * @param LogListCondition $condition
     * @return array
     * @throws Exception
     */
    public function getLogList(LogListCondition $condition): array
    {
        /** @var LogDao $logDao */
        $logDao = LogDao::getInstance();

        return $logDao->getLogList($condition);
    }

    /**
     * 获取系统日志总数量
     * @param LogListCondition $condition
     * @return int
     * @throws Exception
     */
    public function getLogCount(LogListCondition $condition): int
    {
        /** @var LogDao $logDao */
        $logDao = LogDao::getInstance();

        return $logDao->getLogListCount($condition);
    }

}
