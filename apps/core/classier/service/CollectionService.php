<?php

namespace apps\core\classier\service;

use apps\core\classier\bean\CollectionListCondition;
use apps\core\classier\dao\master\CollectionDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\collection\Type;
use apps\core\classier\model\AppCollectionModel;
use Exception;
use rapidPHP\modules\common\classier\Instances;

class CollectionService
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
     * 是否收藏
     * @param $bindId
     * @param $userId
     * @param $type
     * @return bool
     * @throws Exception
     */
    public function isCollection($userId, $bindId, $type): bool
    {
        if (empty($userId)) throw new Exception('userId错误!');

        if (empty($bindId)) throw new Exception('bindId错误!');

        if (empty($type)) throw new Exception('type 错误!');

        /** @var CollectionDao $collectionDao */
        $collectionDao = CollectionDao::getInstance();

        $collectionModel = $collectionDao->getCollectionByBind($userId, $bindId, $type);

        return $collectionModel != null;
    }

    /**
     * 添加或者取消收藏收藏 （没有效验是否在黑名单内）
     * @param $userId
     * @param $bindId
     * @param $type
     * @return int
     * @throws Exception
     */
    public function toggleCollection($userId, $bindId, $type)
    {
        if (empty($userId)) throw new Exception('userId 错误!');

        if (empty($bindId)) throw new Exception('bindId 错误!');

        /** @var CollectionDao $collectionDao */
        $collectionDao = CollectionDao::getInstance();

        MasterDao::getSQLDB()->beginTransaction();

        try {
            $collectionModel = $collectionDao->getCollectionByBind($userId, $bindId, $type);

            $count = $collectionModel == null ? 1 : -1;

            switch ($type) {
                case Type::COURSE:
                    break;
                case Type::QUESTION:
                    break;
            }

            if ($collectionModel == null) {

                $collectionModel = new AppCollectionModel();

                $collectionModel->setBindId($bindId);

                $collectionModel->setType($type);

                $collectionModel->setUserId($userId);

                $collectionDao->addCollection($collectionModel);
            } else {
                $collectionDao->delCollection($collectionModel->getId());
            }

            $collectionDao->delCache($collectionDao->getCacheIdByModel($collectionModel));

            if (!MasterDao::getSQLDB()->commit())
                throw new Exception('操作失败!');

            return $count;
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }


    /**
     * 获取收藏的列表
     * @param CollectionListCondition $condition
     * @return array
     * @throws Exception
     */
    public function getCollectionList(CollectionListCondition $condition): array
    {
        if (empty($condition->getType())) throw new Exception('类型错误!');

        /** @var CollectionDao $collectionDao */
        $collectionDao = CollectionDao::getInstance();

        switch ($condition->getType()) {
            case Type::COURSE:
                $list = $collectionDao->getCollectionWorkList($condition);

                return [];
            case Type::QUESTION:
                return $collectionDao->getCollectionSubjectList($condition);
        }

        return [];
    }
}
