<?php

namespace apps\core\classier\service;


use apps\core\classier\bean\SpecificMajorBean;
use apps\core\classier\dao\master\MajorDao;
use apps\core\classier\dao\master\UserDao;
use apps\core\classier\enum\major\Level;
use apps\core\classier\model\AppMajorModel;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use function rapidPHP\B;

class MajorService
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
     * 添加专业
     * @param AppMajorModel $majorModel
     * @return void
     * @throws Exception
     */
    public function addedMajor(AppMajorModel $majorModel)
    {
        if (empty($majorModel->getName())) throw new Exception('名称错误!');

        try {
            Level::i($majorModel->getLevel());
        } catch (Exception $e) {
            throw new Exception('专业等级错误!');
        }

        /** @var MajorDao $majorDao */
        $majorDao = MajorDao::getInstance();

        if (empty($majorModel->getId())) {

            if (!$majorDao->addMajor($majorModel))
                throw new Exception('添加失败!');
        } else {
            if (!$majorDao->setMajor($majorModel))
                throw new Exception('更新失败!');
        }
    }

    /**
     * 设置课程数量
     * @param $majorId
     * @param int $count
     * @param null $actionId
     * @throws Exception
     */
    public function setCourseCount($majorId, int $count = 1, $actionId = null)
    {
        if (empty($majorId)) throw new Exception('专业 id错误!');

        /** @var MajorDao $majorDao */
        $majorDao = MajorDao::getInstance();

        if (!$majorDao->setCourseCount($majorId, $count, $actionId))
            throw new Exception('设置课程数量失败!');
    }

    /**
     * 设置题数量
     * @param $majorId
     * @param int $count
     * @param null $actionId
     * @throws Exception
     */
    public function setQuestionCount($majorId, int $count = 1, $actionId = null)
    {
        if (empty($majorId)) throw new Exception('专业 id错误!');

        /** @var MajorDao $majorDao */
        $majorDao = MajorDao::getInstance();

        if (!$majorDao->setQuestionCount($majorId, $count, $actionId))
            throw new Exception('设置题数量失败!');
    }

    /**
     * 删除专业
     * @param AppMajorModel $majorModel
     * @return bool
     * @throws Exception
     */
    public function delMajor(AppMajorModel $majorModel)
    {
        if (empty($majorModel->getId())) throw new Exception('majorId错误!');

        /** @var MajorDao $majorDao */
        $majorDao = MajorDao::getInstance();

        if (!$majorDao->delMajor($majorModel))
            throw new Exception('删除失败!');

        return true;
    }

    /**
     * 获取全部专业信息
     * @return AppMajorModel[]
     * @throws Exception
     */
    public function getAllMajorList(): array
    {
        /** @var MajorDao $majorDao */
        $majorDao = MajorDao::getInstance();

        return $majorDao->getAllMajorList();
    }

    /**
     * 获取专业信息
     * @param $majorId
     * @return AppMajorModel
     * @throws Exception
     */
    public function getMajor($majorId)
    {
        if (empty($majorId)) throw new Exception('专业id错误!');

        /** @var MajorDao $majorDao */
        $majorDao = MajorDao::getInstance();

        $majorModel = $majorDao->getMajor($majorId);

        if ($majorModel == null) throw new Exception('专业不存在!');

        return $majorModel;
    }

    /**
     * 获取专业具体信息
     * @param $majorId
     * @param AppMajorModel[]|null $majorModels
     * @return SpecificMajorBean
     * @throws Exception
     */
    public function getSpecificMajor($majorId, ?array &$majorModels = [])
    {
        if (empty($majorId)) throw new Exception('专业id错误!');

        $loopMajorId = $majorId;

        while (!empty($loopMajorId)) {
            $majorModel = $this->getMajor($loopMajorId);

            $loopMajorId = $majorModel->getParentId();

            $majorModels[] = $majorModel;

            if ($majorModel->getLevel() == Level::LEVEL_1) break;
        }

        usort($majorModels, function (AppMajorModel $a, AppMajorModel $b) {
            return $a->getLevel() - $b->getLevel();
        });

        /** @var AppMajorModel|null $topModel */
        $topModel = B()->getData($majorModels, 0);

        /** @var AppMajorModel|null $selfModel */
        $selfModel = $majorModels[count($majorModels) - 1];

        $majorBean = new SpecificMajorBean();

        $majorBean->setTop($topModel);

        $majorBean->setSelf($selfModel);

        $majorBean->setPath($majorModels);

        return $majorBean;
    }

}
