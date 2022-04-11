<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\bean\CollectionListCondition;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\collection\Type;
use apps\core\classier\model\AppCollectionModel;
use apps\core\classier\model\AppQuestionModel;
use Exception;
use function rapidPHP\Cal;

class CollectionDao extends MasterDao
{

    /**
     * cache prefix
     */
    public const CACHE_PREFIX = 'app_collection';

    /**
     * CollectionDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppCollectionModel::class);
    }

    /**
     * 获取缓存id
     * @param AppCollectionModel $collectionModel
     * @return string
     */
    public function getCacheIdByModel(AppCollectionModel $collectionModel): string
    {
        return $this->getCacheId($collectionModel->getUserId(), $collectionModel->getBindId(), $collectionModel->getType());
    }

    /**
     * 添加收藏
     * @param AppCollectionModel $collectionModel
     * @return bool
     * @throws Exception
     */
    public function addCollection(AppCollectionModel $collectionModel): bool
    {
        $result = parent::add([
            'bind_id' => $collectionModel->getBindId(),
            'user_id' => $collectionModel->getUserId(),
            'type' => $collectionModel->getType(),
            'add_time' => Cal()->getDate(),
        ], $inserId);

        if ($result) $collectionModel->setId($inserId);

        return $result;
    }

    /**
     * 删除收藏
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function delCollection($id): bool
    {
        return parent::del()->where('id', $id)->execute();
    }

    /**
     * 获取收藏信息
     * @param $id
     * @return AppCollectionModel|null
     * @throws Exception
     */
    public function getCollection($id): ?AppCollectionModel
    {
        return parent::get()
            ->where('id', $id)
            ->getStatement()
            ->fetch($this->getModelOrClass());
    }


    /**
     * 通过bindId获取收藏信息
     * @param $bindId
     * @param $userId
     * @param $type
     * @return AppCollectionModel|null
     * @throws Exception
     */
    public function getCollectionByBind($userId, $bindId, $type): ?AppCollectionModel
    {
        $cacheId = $this->getCacheId($userId, $bindId, $type);

        return parent::getCacheWithCallback($cacheId, function () use ($type, $bindId, $userId) {
            return parent::get()
                ->where('user_id', $userId)
                ->where('bind_id', $bindId)
                ->where('type', $type)
                ->forUpdate()
                ->getStatement()
                ->fetch($this->getModelOrClass());
        });
    }

    /**
     * 获取收藏 题列表
     * @param CollectionListCondition $condition
     * @return AppQuestionModel[]
     * @throws Exception
     */
    public function getCollectionQuestionList(CollectionListCondition $condition): array
    {
        $select = parent::get('b.*')
            ->alias('a')
            ->join(function () {
                return UserDao::getInstance()
                    ->getDriver()
                    ->alias('b')
                    ->on('b.id=a.bind_id')
                    ->on('b.is_delete', false);
            })
            ->where('a.user_id', $condition->getUserId())
            ->where('a.type', Type::QUESTION)
            ->order('a.add_time', 'DESC');

        if (!empty($condition->getKeyword())) {

            $keyName = $select->getOptionsKey('keyword');

            $select->addOptions("%{$condition->getKeyword()}%", $keyName);

            $select->where("(concat(b.id,b.title)) LIKE :{$keyName} ");
        }

        if ($condition->getIds()) $select->in('b.id', $condition->getIds());

        if (!empty($condition->getStartTime())) $select->where("a.add_time", $condition->getStartTime(), '>=:');

        if (!empty($condition->getEndTime())) $select->where("a.add_time", $condition->getEndTime(), '<:');

        return (array)$select->limit($condition->getPage(), $condition->getSize())
            ->getStatement()
            ->fetchAll(AppQuestionModel::class);
    }

}
