<?php

namespace apps\core\classier\dao\master\point;


use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\PointDetailModel;
use Exception;
use function rapidPHP\Cal;

class DetailDao extends MasterDao
{
    /**
     * DetailDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(PointDetailModel::class);
    }

    /**
     * 添加明细
     * @param PointDetailModel $model
     * @return bool
     * @throws Exception
     */
    public function addDetail(PointDetailModel $model): bool
    {
        $result = $this->add([
            'point_id' => $model->getPointId(),
            'number' => $model->getNumber(),
            'frozen' => $model->getFrozen(),
            'describe' => $model->getDescribe(),
            'tag' => $model->getTag(),
            'is_delete' => false,
            'created_id' => $model->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ], $insertId);

        if ($result) $model->setId($insertId);

        return $result;
    }

    /**
     * 获取明细
     * @param $pointId
     * @param $page
     * @param $size
     * @param array|null $tag
     * @return PointDetailModel[]
     * @throws Exception
     */
    public function getList($pointId, $page, $size, ?array $tag = null): array
    {
        $select = $this->get()
            ->where('point_id', $pointId)
            ->where('is_delete', false);

        if (!empty($tag)) $select->in('tag', $tag);

        return (array)$select
            ->order('created_time', 'DESC')
            ->limit($page, $size)
            ->getStatement()
            ->fetchAll($this->getModelOrClass());
    }

}
