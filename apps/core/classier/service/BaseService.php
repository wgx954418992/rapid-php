<?php

namespace apps\core\classier\service;

use apps\core\classier\context\PathContextInterface;
use apps\core\classier\dao\master\LogDao;
use apps\core\classier\dao\master\UserDao;
use apps\core\classier\model\AppUserModel;
use apps\core\classier\wrapper\UserWrapper;
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
     * 通过userId获取用户信息
     * @param $userId
     * @param PathContextInterface|null $pathContext
     * @return UserWrapper
     * @throws Exception
     */
    public function getUser($userId, PathContextInterface $pathContext = null)
    {
        if (empty($userId)) throw new Exception('userId错误!');

        $userDao = UserDao::getInstance();

        $userWrapper = $userDao->getUser($userId);

        if ($userWrapper == null) throw new Exception('帐号不存在!');

        return $this->updateUser($userWrapper, $pathContext);
    }


    /**
     * 更新用户信息
     * @param UserWrapper|AppUserModel $userModel
     * @param PathContextInterface|null $pathContext
     * @return UserWrapper
     */
    public function updateUser($userModel, PathContextInterface $pathContext = null)
    {
        if ($userModel instanceof UserWrapper && $pathContext) {
            $userModel->setHeadPic($pathContext->getFileUrl($userModel->getHeadFid()));
        }

        return $userModel;
    }

    /**
     * 添加系统日志
     * @param $msg
     * @param null $content
     * @return int
     */
    public function addLog($msg, $content = null)
    {
        try {

            $logDao = LogDao::getInstance();

            if ($content instanceof Exception) {
                $content = formatException($content);
            } else {
                if (is_array($content) || is_object($content)) $content = json_encode($content);
            }

            $logDao->addLog($logId, $msg, $content);

            return $logId;
        } catch (Exception $e) {
            return false;
        }
    }
}