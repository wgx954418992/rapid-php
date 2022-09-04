<?php

namespace apps\core\classier\dao\master\cms;


use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\CmsColumnModel;
use Exception;
use function rapidPHP\Cal;

class ColumnDao extends MasterDao
{

    /**
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(CmsColumnModel::class);
    }

    /**
     * 添加栏目
     * @param CmsColumnModel $ColumnModel
     * @return bool
     * @throws Exception
     */
    public function addColumn(CmsColumnModel $ColumnModel): bool
    {
        $result = parent::add([
            'title' => $ColumnModel->getTitle(),
            'rank' => $ColumnModel->getRank(),
            'type' => $ColumnModel->getType(),
            'is_delete' => false,
            'created_id' => $ColumnModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ], $insertId);

        if ($result) $ColumnModel->setId($insertId);

        return $result;
    }

    /**
     * 修改栏目
     * @param CmsColumnModel $ColumnModel
     * @return bool
     * @throws Exception
     */
    public function setColumn(CmsColumnModel $ColumnModel): bool
    {
        return parent::set([
            'title' => $ColumnModel->getTitle(),
            'rank' => $ColumnModel->getRank(),
            'type' => $ColumnModel->getType(),
            'updated_id' => $ColumnModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $ColumnModel->getId())->execute();
    }

    /**
     * 删除栏目
     * @param CmsColumnModel $ColumnModel
     * @return bool
     * @throws Exception
     */
    public function delColumn(CmsColumnModel $ColumnModel): bool
    {
        return parent::del()
            ->where('id', $ColumnModel->getId())
            ->execute();
    }


    /**
     * 获取栏目
     * @param $type
     * @return CmsColumnModel[]
     * @throws Exception
     */
    public function getColumnList($type = null): array
    {
        $select = $this->get()
            ->where('is_delete', false);

        if (!empty($type)) $select->where('type', $type);

        return (array)$select
            ->order('rank', 'ASC')
            ->getStatement()
            ->fetchAll($this->getModelOrClass());
    }

    /**
     * 获取栏目信息
     * @param $id
     * @return CmsColumnModel
     * @throws Exception
     */
    public function getColumn($id)
    {
        return parent::get()
            ->where('is_delete', false)
            ->where('id', $id)
            ->getStatement()
            ->fetch($this->getModelOrClass());
    }
}
