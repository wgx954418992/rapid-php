<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppMemberModel;
use Exception;
use ReflectionException;
use function rapidPHP\Cal;

class MemberDao extends MasterDao
{

    /**
     * cache prefix
     */
    public const CACHE_PREFIX = 'app_member';

    /**
     * MemberDao
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppMemberModel::class);
    }

    /**
     * 添加会员
     * @param AppMemberModel $memberModel
     * @return bool
     * @throws Exception
     */
    public function addMember(AppMemberModel $memberModel): bool
    {
        $data = [
            'major_id' => $memberModel->getMajorId(),
            'name' => $memberModel->getName(),
            'title' => $memberModel->getTitle(),
            'desc' => $memberModel->getDesc(),
            'amount' => $memberModel->getAmount(),
            'original_price' => $memberModel->getOriginalPrice(),
            'valid_time' => $memberModel->getValidTime(),
            'is_delete' => false,
            'created_id' => $memberModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        $result = $this->add($data, $insertId);

        if ($result) {
            $memberModel->setId($insertId);

            $this->delCache($this->getCacheIdList('/list.*/i'));
        }

        return $result;
    }

    /**
     * 设置会员
     * @param AppMemberModel $memberModel
     * @return bool
     * @throws Exception
     */
    public function setMember(AppMemberModel $memberModel): bool
    {
        $data = [
            'name' => $memberModel->getName(),
            'title' => $memberModel->getTitle(),
            'desc' => $memberModel->getDesc(),
            'amount' => $memberModel->getAmount(),
            'original_price' => $memberModel->getOriginalPrice(),
            'valid_time' => $memberModel->getValidTime(),
            'updated_id' => $memberModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ];

        $result = $this->set($data)
            ->where('id', $memberModel->getId())
            ->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $memberModel->getId()));

            $this->delCache($this->getCacheIdList('/list.*/i'));
        }

        return $result;
    }

    /**
     * 删除会员
     * @param AppMemberModel $courseModel
     * @return bool
     * @throws Exception
     */
    public function delMember(AppMemberModel $courseModel): bool
    {
        $result = $this->set([
            'is_delete' => true,
            'updated_id' => $courseModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $courseModel->getId())->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $courseModel->getId()));

            $this->delCache($this->getCacheIdList('/list.*/i'));
        }

        return $result;
    }

    /**
     * 通过专业id获取会员列表
     * @return AppMemberModel[]
     * @throws Exception
     */
    public function getMemberListByMajorId($majorId): array
    {
        $cacheId = $this->getCacheId('list', $majorId);

        return (array)$this->getCacheWithCallback($cacheId, function () use ($majorId) {
            return $this->get()
                ->where('is_delete', false)
                ->where('major_id', $majorId)
                ->getStatement()
                ->fetchAll($this->getModelOrClass());
        });
    }

    /**
     * 获取会员信息
     * @param $id
     * @return AppMemberModel
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
                ->fetch($this->getModelOrClass());
        });
    }
}
