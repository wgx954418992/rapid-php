<?php

namespace apps\core\classier\service;

use apps\core\classier\bean\QuestionListCondition;
use apps\core\classier\dao\master\QuestionDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppQuestionModel;
use apps\core\classier\options\QuestionOptions;
use apps\core\classier\wrapper\QuestionWrapper;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use ReflectionException;
use function rapidPHP\B;

class QuestionService
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
     * 添加题
     * @param AppQuestionModel $questionModel
     * @throws Exception
     */
    public function addedQuestion(AppQuestionModel $questionModel)
    {
        if (empty($questionModel->getCourseId())) throw new Exception('课程id错误!');

        if (empty($questionModel->getTitle())) throw new Exception('标题错误!');

        $courseModel = CourseService::getInstance()
            ->getCourse($questionModel->getCourseId());

        $specificMajor = MajorService::getInstance()
            ->getSpecificMajor($courseModel->getMajorId());
        
        /** @var QuestionDao $questionDao */
        $questionDao = QuestionDao::getInstance();

        MasterDao::getSQLDB()->beginTransaction();

        try {

            if ($questionModel->getId()) {

                $questionDao->setQuestion($questionModel);
            } else {
                $questionModel->setId(B()->onlyIdToInt());

                $questionDao->addQuestion($questionModel);

                CourseService::getInstance()
                    ->setQuestionCount($questionModel->getCourseId(), 1, $questionModel->getUpdatedId());

                foreach ($specificMajor->getPath() as $major) {

                    MajorService::getInstance()
                        ->setCourseCount($major->getId(), 1, $questionModel->getUpdatedId());
                }
            }

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('操作失败');

        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }

    /**
     * 删除题
     * @param AppQuestionModel $questionModel
     * @throws Exception
     */
    public function delQuestion(AppQuestionModel $questionModel)
    {
        if (empty($questionModel->getId())) throw new Exception('题Id错误!');

        if (empty($questionModel->getCourseId())) throw new Exception('课程id错误!');

        $courseModel = CourseService::getInstance()
            ->getCourse($questionModel->getCourseId());

        $specificMajor = MajorService::getInstance()
            ->getSpecificMajor($courseModel->getMajorId());

        /** @var QuestionDao $questionDao */
        $questionDao = QuestionDao::getInstance();

        MasterDao::getSQLDB()->beginTransaction();

        try {
            $questionDao->delQuestion($questionModel);

            CourseService::getInstance()
                ->setQuestionCount($questionModel->getCourseId(), -1, $questionModel->getUpdatedId());

            foreach ($specificMajor->getPath() as $major) {

                MajorService::getInstance()
                    ->setCourseCount($major->getId(), -1, $questionModel->getUpdatedId());
            }

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('删除失败');

        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }


    /**
     * 设置题可选options
     * @param QuestionWrapper $questionModel
     * @param QuestionOptions|null $options
     * @throws Exception
     */
    public function setQuestionOptions(QuestionWrapper $questionModel, ?QuestionOptions $options = null)
    {
        if (!$options) return;

        $options
            ->then(QuestionOptions::COURSE, function () use ($questionModel) {
                $courseModel = CourseService::getInstance()
                    ->getCourse($questionModel->getCourseId());

                $questionModel->setCourse($courseModel);
            });
    }

    /**
     * 获取题列表
     * @param QuestionListCondition $condition
     * @return array
     * @throws ReflectionException
     * @throws Exception
     */
    public function getQuestionList(QuestionListCondition $condition)
    {
        /** @var QuestionDao $questionDao */
        $questionDao = QuestionDao::getInstance();

        $list = $questionDao->getQuestionList($condition);

        foreach ($list as $value) {

            $this->setQuestionOptions($value, $condition->getOptions());
        }

        return $list;
    }

    /**
     * 获取题列表查询总数量
     * @param QuestionListCondition $condition
     * @return int
     * @throws ReflectionException
     * @throws Exception
     */
    public function getQuestionListCount(QuestionListCondition $condition)
    {
        /** @var QuestionDao $questionDao */
        $questionDao = QuestionDao::getInstance();

        return $questionDao->getQuestionListCount($condition);
    }

    /**
     * 获取题信息
     * @param $questionId
     * @param QuestionOptions|null $options
     * @return QuestionWrapper
     * @throws ReflectionException
     * @throws Exception
     */
    public function getQuestion($questionId, ?QuestionOptions $options = null)
    {
        if (empty($questionId)) throw new Exception('题id错误!');

        /** @var QuestionDao $questionDao */
        $questionDao = QuestionDao::getInstance();

        $questionModel = $questionDao->getQuestion($questionId);

        if ($questionModel == null) throw new Exception('题不存在!');

        $this->setQuestionOptions($questionModel, $options);

        return $questionModel;
    }

}
