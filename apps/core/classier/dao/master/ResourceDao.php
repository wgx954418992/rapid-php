<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\bean\ResourceListCondition;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppResourceModel;
use apps\core\classier\wrapper\ResourceWrapper;
use Exception;
use rapidPHP\modules\reflection\classier\Utils;
use function rapidPHP\Cal;

class ResourceDao extends MasterDao
{

    /**
     * ResourceDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppResourceModel::class);
    }

    /**
     * 添加资源
     * @param AppResourceModel $resourceModel
     * @return bool
     * @throws Exception
     */
    public function addResource(AppResourceModel $resourceModel): bool
    {
        $data = [
            'owner_id' => $resourceModel->getOwnerId(),
            'bind_id' => $resourceModel->getBindId(),
            'bind_type' => $resourceModel->getBindType(),
            'file_id' => $resourceModel->getFileId(),
            'file_type' => $resourceModel->getFileType(),
            'is_delete' => false,
            'created_id' => $resourceModel->getCreatedId(),
            'created_time' => empty($resourceModel->getCreatedTime()) ? Cal()->getDate() : $resourceModel->getCreatedTime(),
        ];

        if (!empty($resourceModel->getOptions())) {
            if (is_object($resourceModel->getOptions())) {
                $data['options'] = json_encode(Utils::getInstance()->toArray($resourceModel->getOptions()));
            } else if (is_array($resourceModel->getOptions())) {
                $data['options'] = json_encode($resourceModel->getOptions());
            }
        }

        $result = parent::add($data, $insertId);

        if ($result) $resourceModel->setId($insertId);

        return $result;
    }

    /**
     * 获取资源信息
     * @param $id
     * @return ResourceWrapper|null
     * @throws Exception
     */
    public function getResource($id): ?ResourceWrapper
    {
        return parent::get()
            ->where('is_delete', false)
            ->where('id', $id)
            ->getStatement()
            ->fetch(ResourceWrapper::class);
    }


    /**
     * 通过作品获取资源列表
     * @param $bindId
     * @param $type
     * @return ResourceWrapper
     * @throws Exception
     */
    public function getResourceByBind($bindId, $type): ?ResourceWrapper
    {
        return parent::get()
            ->where('is_delete', false)
            ->where('bind_id', $bindId)
            ->where('type', $type)
            ->getStatement()
            ->fetch(ResourceWrapper::class);
    }

    /**
     * 获取资源列表
     * @param ResourceListCondition $condition
     * @return ResourceWrapper[]
     * @throws Exception
     */
    public function getResources(ResourceListCondition $condition): array
    {
        $select = parent::get()
            ->where('is_delete', false)
            ->where('bind_id', $condition->getBindId())
            ->order($condition->getOrderName(), $condition->getOrderType());

        if (!empty($condition->getBindType())) $select->in('bind_type', $condition->getBindType());

        if (!empty($condition->getOwnerId())) $select->where('owner_id', $condition->getOwnerId());

        if (!empty($condition->getFileType())) $select->in('file_type', $condition->getFileType());

        if (is_int($condition->getPage()) && is_int($condition->getSize())) {
            $select->limit($condition->getPage(), $condition->getSize());
        }

        return (array)$select
            ->order($condition->getOrderName(), $condition->getOrderType())
            ->getStatement()
            ->fetchAll(ResourceWrapper::class);
    }


    /**
     * 通过bind id 删除全部资源
     * @param $actionId
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function delAllResourceByBindId($id, $actionId): bool
    {
        return parent::set([
            'is_delete' => true,
            'updated_id' => $actionId,
            'updated_time' => Cal()->getDate(),
        ])->where('bind_id', $id)->execute();
    }


    /**
     * 删除资源
     * @param $actionId
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function delResource($id, $actionId): bool
    {
        return parent::set([
            'is_delete' => true,
            'updated_id' => $actionId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)->execute();
    }

}
