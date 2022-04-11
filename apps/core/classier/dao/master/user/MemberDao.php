<?php

namespace apps\core\classier\dao\master\user;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\UserMemberModel;
use apps\core\classier\wrapper\user\MemberWrapper;
use Exception;
use ReflectionException;
use function rapidPHP\Cal;

class MemberDao extends MasterDao
{

    /**
     * cache prefix
     */
    public const CACHE_PREFIX = 'user_member';

    /**
     * MemberDao
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(UserMemberModel::class);
    }

    /**
     * 添加会员
     * @param UserMemberModel $memberModel
     * @return bool
     * @throws Exception
     */
    public function addMember(UserMemberModel $memberModel): bool
    {
        $data = [
            'user_id' => $memberModel->getUserId(),
            'major_id' => $memberModel->getMajorId(),
            'member_id' => $memberModel->getMemberId(),
            'name' => $memberModel->getName(),
            'open_time' => $memberModel->getOpenTime(),
            'end_time' => $memberModel->getEndTime(),
            'is_delete' => false,
            'created_id' => $memberModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        $result = $this->add($data, $insertId);

        if ($result) {
            $memberModel->setId($insertId);

            $this->delCache($this->getCacheId('id', $memberModel->getUserId(), $memberModel->getMajorId()));
        }

        return $result;
    }

    /**
     * 设置会员结束时间
     * @param UserMemberModel $memberModel
     * @return bool
     * @throws Exception
     */
    public function setMemberTime(UserMemberModel $memberModel): bool
    {
        $result = $this->set([
            'open_time' => $memberModel->getOpenTime(),
            'end_time' => $memberModel->getEndTime(),
            'updated_id' => $memberModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])
            ->where('id', $memberModel->getId())
            ->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $memberModel->getUserId(), $memberModel->getMajorId()));
        }

        return $result;
    }

    /**
     * 删除会员
     * @param UserMemberModel $memberModel
     * @return bool
     * @throws Exception
     */
    public function delMember(UserMemberModel $memberModel): bool
    {
        $result = parent::set([
            'is_delete' => true,
            'updated_id' => $memberModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $memberModel->getId())->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $memberModel->getUserId(), $memberModel->getMajorId()));
        }

        return $result;
    }

    /**
     * 获取用户开通会员列表
     * @param $userId
     * @return array
     * @throws Exception
     */
    public function getUserMemberList($userId): array
    {
        return (array)$this->get()
            ->where('is_delete', false)
            ->where('user_id', $userId)
            ->getStatement()
            ->fetchAll(MemberWrapper::class);
    }

    /**
     * 获取会员
     * @param $id
     * @return MemberWrapper|null
     * @throws ReflectionException
     * @throws Exception
     */
    public function getMember($id)
    {
        $cacheId = $this->getCacheId('id', $id);

        return $this->getCacheWithCallback($cacheId, function () use ($id) {
            return $this->get()
                ->where('id', $id)
                ->where('is_delete', false)
                ->getStatement()
                ->fetch(MemberWrapper::class);
        });
    }

    /**
     * 通过userId+majorId获取会员
     * @param $userId
     * @param $majorId
     * @return MemberWrapper|null
     * @throws Exception
     */
    public function getMemberByUM($userId, $majorId)
    {
        $cacheId = $this->getCacheId('id', $userId, $majorId);

        return $this->getCacheWithCallback($cacheId, function () use ($majorId, $userId) {
            return $this->get()
                ->where('user_id', $userId)
                ->where('major_id', $majorId)
                ->where('is_delete', false)
                ->getStatement()
                ->fetch(MemberWrapper::class);
        });
    }

}
