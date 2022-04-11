<?php

namespace apps\core\classier\service;

use apps\core\classier\bean\CourseListCondition;
use apps\core\classier\dao\master\CourseDao;
use apps\core\classier\dao\master\MajorDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\major\Level;
use apps\core\classier\model\AppCourseModel;
use apps\core\classier\options\CourseOptions;
use apps\core\classier\wrapper\CourseWrapper;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use ReflectionException;
use function rapidPHP\B;

class CourseService
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
     * 添加课程
     * @param AppCourseModel $courseModel
     * @throws Exception
     */
    public function addedCourse(AppCourseModel $courseModel)
    {
        if (empty($courseModel->getMajorId())) throw new Exception('专业id错误!');

        if (empty($courseModel->getTitle())) throw new Exception('标题错误!');

        $specificMajor = MajorService::getInstance()
            ->getSpecificMajor($courseModel->getMajorId());

        if ($specificMajor->getSelf()->getLevel() != Level::MAJOR) throw new Exception('专业等级错误!');

        /** @var CourseDao $courseDao */
        $courseDao = CourseDao::getInstance();

        MasterDao::getSQLDB()->beginTransaction();

        try {

            if ($courseModel->getId()) {

                $courseDao->setCourse($courseModel);
            } else {
                $courseModel->setId(B()->onlyIdToInt());

                $courseDao->addCourse($courseModel);

                foreach ($specificMajor->getPath() as $major) {

                    MajorService::getInstance()
                        ->setCourseCount($major->getId(), 1, $courseModel->getUpdatedId());
                }
            }

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('操作失败');

        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }


    /**
     * 设置题数量
     * @param $courseId
     * @param int $count
     * @param null $actionId
     * @throws Exception
     */
    public function setQuestionCount($courseId, int $count = 1, $actionId = null)
    {
        if (empty($courseId)) throw new Exception('课程 id错误!');

        /** @var CourseDao $courseDao */
        $courseDao = CourseDao::getInstance();

        if (!$courseDao->setQuestionCount($courseId, $count, $actionId))
            throw new Exception('设置题数量失败!');
    }

    /**
     * 删除课程
     * @param AppCourseModel $courseModel
     * @throws Exception
     */
    public function delCourse(AppCourseModel $courseModel)
    {
        if (empty($courseModel->getId())) throw new Exception('课程Id错误!');

        if (empty($courseModel->getMajorId())) throw new Exception('专业Id错误!');

        $specificMajor = MajorService::getInstance()
            ->getSpecificMajor($courseModel->getMajorId());

        /** @var CourseDao $courseDao */
        $courseDao = CourseDao::getInstance();

        MasterDao::getSQLDB()->beginTransaction();

        try {
            $courseDao->delCourse($courseModel);

            foreach ($specificMajor->getPath() as $major) {

                MajorService::getInstance()
                    ->setCourseCount($major->getId(), -1, $courseModel->getUpdatedId());
            }

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('删除失败');

        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }


    /**
     * 设置课程可选options
     * @param CourseWrapper $courseModel
     * @param CourseOptions|null $options
     * @throws Exception
     */
    public function setCourseOptions(CourseWrapper $courseModel, ?CourseOptions $options = null)
    {
        if (!$options) return;

        $options
            ->then(CourseOptions::MAJOR, function () use ($courseModel) {
                if (!$courseModel->getMajorId()) return;

                $majorModel = MajorService::getInstance()
                    ->getMajor($courseModel->getMajorId());

                $courseModel->setMajor($majorModel);
            })
            ->then(CourseOptions::SPECIFIC_MAJOR, function () use ($courseModel) {
                $majorModel = MajorService::getInstance()
                    ->getSpecificMajor($courseModel->getMajorId());

                $courseModel->setSpecificMajor($majorModel);
            });
    }

    /**
     * 获取课程列表
     * @param CourseListCondition $condition
     * @return array
     * @throws ReflectionException
     * @throws Exception
     */
    public function getCourseList(CourseListCondition $condition)
    {
        /** @var CourseDao $courseDao */
        $courseDao = CourseDao::getInstance();

        $list = $courseDao->getCourseList($condition);

        foreach ($list as $value) {

            $this->setCourseOptions($value, $condition->getOptions());
        }

        return $list;
    }

    /**
     * 获取课程列表查询总数量
     * @param CourseListCondition $condition
     * @return int
     * @throws ReflectionException
     * @throws Exception
     */
    public function getCourseListCount(CourseListCondition $condition)
    {
        /** @var CourseDao $courseDao */
        $courseDao = CourseDao::getInstance();

        return $courseDao->getCourseListCount($condition);
    }

    /**
     * 通过专业id获取课程列表
     * @param $majorId
     * @param CourseOptions|null $options
     * @return CourseWrapper[]
     * @throws Exception
     */
    public function getCourseListByMajorId($majorId, ?CourseOptions $options = null)
    {
        if (empty($majorId)) throw new Exception('专业Id错误!');

        /** @var CourseDao $courseDao */
        $courseDao = CourseDao::getInstance();

        $list = $courseDao->getCourseListByMajorId($majorId);

        foreach ($list as $value) {

            $this->setCourseOptions($value, $options);
        }

        return $list;
    }

    /**
     * 获取课程信息
     * @param $courseId
     * @param CourseOptions|null $options
     * @return CourseWrapper
     * @throws ReflectionException
     * @throws Exception
     */
    public function getCourse($courseId, ?CourseOptions $options = null)
    {
        if (empty($courseId)) throw new Exception('课程id错误!');

        /** @var CourseDao $courseDao */
        $courseDao = CourseDao::getInstance();

        $courseModel = $courseDao->getCourse($courseId);

        if ($courseModel == null) throw new Exception('课程不存在!');

        $this->setCourseOptions($courseModel, $options);

        return $courseModel;
    }

}
