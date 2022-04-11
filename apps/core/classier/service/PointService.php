<?php

namespace apps\core\classier\service;

use apps\core\classier\dao\master\point\DetailDao;
use apps\core\classier\dao\master\PointDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\point\Type as PointType;
use apps\core\classier\model\AppPointModel;
use apps\core\classier\model\PointDetailModel;
use Exception;
use ReflectionException;
use function rapidPHP\B;

class PointService
{

    /**
     * @var mixed
     */
    protected $bindId;

    /**
     * @var PointType
     */
    protected $type;

    /**
     * IntegralService constructor.
     * @param $bindId
     * @param PointType $type
     */
    public function __construct($bindId, PointType $type)
    {
        $this->bindId = $bindId;

        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getBindId()
    {
        return $this->bindId;
    }

    /**
     * @return PointType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * 积分更改
     * @param AppPointModel $pointModel
     * @param PointDetailModel $detailModel
     */
    public function onChange(AppPointModel $pointModel, PointDetailModel $detailModel)
    {

    }

    /**
     * 添加(修改)点
     * @param float $number
     * @param string $describe
     * @param float $frozen
     * @param string|null $tag
     * @return PointDetailModel
     * @throws Exception
     */
    public function addPoint(float $number, string $describe, float $frozen = 0, ?string $tag = null)
    {
        $isThingIn = MasterDao::getSQLDB()->isInThing();

        if (!$isThingIn) MasterDao::getSQLDB()->beginTransaction();

        try {

            /** @var PointDao $pointDao */
            $pointDao = PointDao::getInstance();

            $pointModel = $pointDao->getPointByBind($this->bindId, $this->type);

            $realNumber = max(0, $pointModel ? $pointModel->getNumber() + $number : 0 + $number);

            $realFrozen = max(0, $pointModel ? $pointModel->getFrozen() + $frozen : 0 + $frozen);

            if ($pointModel == null) {

                $pointModel = new AppPointModel();

                $pointModel->setBindId($this->bindId);

                $pointModel->setType($this->type->getRawValue());

                $pointModel->setNumber($realNumber);

                $pointModel->setFrozen($realFrozen);

                $pointDao->addPoint($pointModel);
            } else {

                $pointModel->setNumber($realNumber);

                $pointModel->setFrozen($realFrozen);

                $pointDao->setPoint($pointModel);
            }

            /** @var DetailDao $detailDao */
            $detailDao = DetailDao::getInstance();

            $detailModel = new PointDetailModel();

            $detailModel->setPointId($pointModel->getId());

            $detailModel->setNumber($number);

            $detailModel->setFrozen($frozen);

            $detailModel->setDescribe($describe);

            $detailModel->setTag($tag);

            $detailModel->setCreatedId($this->bindId);

            $detailDao->addDetail($detailModel);

            $this->onChange($pointModel, $detailModel);

            if (!$isThingIn && !MasterDao::getSQLDB()->commit()) throw new Exception('添加修改失败!');

            return $detailModel;
        } catch (Exception $e) {
            if (!$isThingIn) MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }


    /**
     * 获取点
     * @return AppPointModel
     * @throws ReflectionException
     * @throws Exception
     */
    public function getPoint()
    {
        /** @var PointDao $pointsModel */
        $pointsModel = PointDao::getInstance();

        $pointModel = $pointsModel->getPointByBind($this->bindId, $this->type);

        if ($pointModel == null) {
            $pointModel = new AppPointModel();

            $pointModel->setId(B()->onlyIdToInt());

            $pointModel->setBindId($this->bindId);

            $pointModel->setType($this->type->getRawValue());

            $pointModel->setNumber(0.00);

            $pointModel->setFrozen(0.00);

            /** @var PointDao $pointDao */
            $pointDao = PointDao::getInstance();

            if (!$pointDao->addPoint($pointModel))
                throw new Exception('add point error!');
        } else {
            if (is_null($pointModel->getNumber())) $pointModel->setNumber(0.00);

            if (is_null($pointModel->getFrozen())) $pointModel->setFrozen(0.00);
        }

        return $pointModel;
    }

    /**
     * 获取点明细列表
     * @param $page
     * @param array|null $tag
     * @return PointDetailModel[]
     * @throws Exception
     */
    public function getDetailsList($page, ?array $tag = null): array
    {
        $page = max(1, $page);

        /** @var PointDao $pointsModel */
        $pointsModel = PointDao::getInstance();

        $pointModel = $pointsModel->getPointByBind($this->bindId, $this->type);

        if ($pointModel == null) return [];

        /** @var DetailDao $detailDao */
        $detailDao = DetailDao::getInstance();

        return $detailDao->getList($pointModel->getId(), $page, 50, $tag);
    }

    /**
     * 批量添加(修改)点
     * @param $data
     * @param mixed ...$desc
     * @return bool
     * @throws Exception
     */
    public static function batchAddPoint($data, ...$desc)
    {
        if ($data instanceof AppPointModel) $data = [$data];

        $isThingIn = MasterDao::getSQLDB()->isInThing();

        if (!$isThingIn) MasterDao::getSQLDB()->beginTransaction();

        try {

            /** @var AppPointModel $item */
            foreach ($data as $index => $item) {
                $potionService = new PointService($item->getBindId(), PointType::i($item->getType()));

                $text = B()->contrast(B()->getData($desc, $index), B()->getData($desc, 0));

                $potionService->addPoint($item->getNumber(), $text, $item->getFrozen());
            }

            if (!$isThingIn && !MasterDao::getSQLDB()->commit()) throw new Exception('批量添加修改失败!');

            return true;
        } catch (Exception $e) {
            if (!$isThingIn) MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }
}
