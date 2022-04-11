<?php

namespace apps\core\classier\dao\master;


use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\point\Type as PointType;
use apps\core\classier\model\AppPointModel;
use Exception;
use function rapidPHP\Cal;

class PointDao extends MasterDao
{

    /**
     * PointDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppPointModel::class);
    }


    /**
     * 添加点
     * @param AppPointModel $model
     * @return bool
     * @throws Exception
     */
    public function addPoint(AppPointModel $model): bool
    {
        $result = $this->add([
            'bind_id' => $model->getBindId(),
            'type' => $model->getType(),
            'number' => $model->getNumber(),
            'frozen' => $model->getFrozen(),
            'is_delete' => false,
            'created_id' => $model->getBindId(),
            'created_time' => Cal()->getDate(),
        ], $insertId);

        if ($result) $model->setId($insertId);

        return $result;
    }

    /**
     * 获取点信息
     * @param $bindId
     * @param PointType $type
     * @return AppPointModel|null
     * @throws Exception
     */
    public function getPointByBind($bindId, PointType $type)
    {
        return $this->get()
            ->where('bind_id', $bindId)
            ->where('type', $type->getRawValue())
            ->where('is_delete', false)
            ->getStatement()
            ->fetch($this->getModelOrClass());
    }


    /**
     * 修改点
     * @param AppPointModel $model
     * @return bool
     * @throws Exception
     */
    public function setPoint(AppPointModel $model)
    {
        return $this->set([
            'number' => $model->getNumber(),
            'frozen' => $model->getFrozen(),
            'updated_id' => $model->getBindId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $model->getId())->execute();
    }
}
