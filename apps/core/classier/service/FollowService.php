<?php

namespace apps\core\classier\service;

use apps\core\classier\dao\master\user\FollowDao;
use apps\core\classier\dao\master\UserDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\follow\Status;
use apps\core\classier\enum\follow\Type;
use apps\core\classier\wrapper\user\FollowWrapper;
use apps\queue\classier\service\EventService;
use Exception;
use rapidPHP\modules\common\classier\Instances;

class FollowService
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
     * 获取关注信息
     * @param $id
     * @return FollowWrapper|null
     * @throws Exception
     */
    public function getFollow($id)
    {
        if (empty($id)) throw new Exception('id 错误！');

        /** @var FollowDao $followDao */
        $followDao = FollowDao::getInstance();

        $followModel = $followDao->getFollow($id);

        if ($followModel == null) throw new Exception('关注信息不存在！');

        return $followModel;
    }

    /**
     * 获取关注信息
     * @param $fromId
     * @param $toId
     * @return FollowWrapper|null
     * @throws Exception
     */
    public function getFollowByFT($fromId, $toId)
    {
        if (empty($fromId)) throw new Exception('from id 错误！');

        if (empty($toId)) throw new Exception('to id 错误！');

        /** @var FollowDao $followDao */
        $followDao = FollowDao::getInstance();

        $followModel = $followDao->getFollowByFT($fromId, $toId);

        if ($followModel == null) throw new Exception('关注信息不存在！');

        return $followModel;
    }

    /**
     * 获取关注数量 (一般用于获取朋友的数量)
     * @param $userId
     * @param int $type
     * @return int
     * @throws Exception
     */
    public function getFollowCount($userId, int $type = Type::DOUBLE): int
    {
        return FollowDao::getInstance()->getFollowCount($userId, $type);
    }

    /**
     * 添加关注
     * @param $fromId
     * @param $toId
     * @return FollowWrapper
     * @throws Exception
     */
    public function addFollow($fromId, $toId)
    {
        if ($fromId == $toId) throw new Exception('自己不能关注自己!');

        if (empty($fromId)) throw new Exception('from id 错误！');

        if (empty($toId)) throw new Exception('to id 错误！');

        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        $toUserModel = $userDao->getUser($toId);

        if ($toUserModel == null) throw new Exception('关注的用户不存在!');

        /** @var FollowDao $followDao */
        $followDao = FollowDao::getInstance();

        MasterDao::getSQLDB()->beginTransaction();

        $fromFollowModel = $followDao->getFollowByFT($fromId, $toId);

        if ($fromFollowModel != null) return $fromFollowModel;

        try {
            $followModel = new FollowWrapper();

            $followModel->setFromId($fromId);

            $followModel->setToId($toId);

            $followModel->setType(Type::ONE);

            $followModel->setStatus(Status::RELATION);

            /**
             * 关注判断对方是否已经向自己发送关注申请或者对方已经成功关注自己
             * 如果对方 已经向自己发送关注提醒，则同意对方申请，并且关注对方
             * 如果对方已经成功关注自己
             */
            $toFollowModel = $followDao->getFollowByFT($toId, $fromId);

            if ($toFollowModel != null) {
                $followModel->setType(Type::DOUBLE);

                $followModel->setStatus(Status::RELATION);

                if ($toFollowModel->getStatus() == Status::APPLY) {
                    $toFollowModel->setStatus(Status::RELATION);

                    $followDao->setFollowStatus($toFollowModel);

                    UserService::getInstance()->setFollowingCount($toId);

                    UserService::getInstance()->setFollowerCount($fromId);
                }
            }

            $followDao->addFollow($followModel);

            try {
                if ($followModel->getStatus() == Status::RELATION) {
                    UserService::getInstance()->setFollowingCount($fromId);

                    UserService::getInstance()->setFollowerCount($toId);
                }
            } catch (Exception $e) {
                BaseService::getInstance()->addLog($e);
            }

            EventService::getInstance()->addFollowEvent($followModel->getId());

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('关注失败!');

            return $followModel;
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }

    /**
     * 删除关注或者粉丝
     * @param $fromId
     * @param $toId
     * @throws Exception
     */
    public function delFollow($fromId, $toId)
    {
        /** @var FollowDao $followDao */
        $followDao = FollowDao::getInstance();

        $isThing = MasterDao::getSQLDB()->isInThing();

        if (!$isThing) MasterDao::getSQLDB()->beginTransaction();

        $followModel = $this->getFollowByFT($fromId, $toId);

        try {
            $followDao->delFollow($followModel);

            try {
                if ($followModel->getStatus() == Status::RELATION) {
                    UserService::getInstance()->setFollowingCount($followModel->getFromId(), -1);

                    UserService::getInstance()->setFollowerCount($followModel->getToId(), -1);
                }
            } catch (Exception $e) {
                BaseService::getInstance()->addLog($e);
            }

            if (!$isThing && !MasterDao::getSQLDB()->commit()) throw new Exception('取消失败!');
        } catch (Exception $e) {
            if (!$isThing) MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }
}
