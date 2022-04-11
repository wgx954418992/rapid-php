<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\bean\QuestionListCondition;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppQuestionModel;
use apps\core\classier\wrapper\QuestionWrapper;
use Exception;
use rapidPHP\modules\database\sql\classier\Driver;
use rapidPHP\modules\database\sql\classier\driver\Mysql;
use ReflectionException;
use function rapidPHP\Cal;

class QuestionDao extends MasterDao
{

    /**
     * cache prefix
     */
    public const CACHE_PREFIX = 'app_question';

    /**
     * QuestionDao
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppQuestionModel::class);
    }

    /**
     * 添加题库
     * @param AppQuestionModel $questionModel
     * @return bool
     * @throws Exception
     */
    public function addQuestion(AppQuestionModel $questionModel): bool
    {
        $data = [
            'id' => $questionModel->getId(),
            'question_id' => $questionModel->getCourseId(),
            'title' => $questionModel->getTitle(),
            'is_delete' => false,
            'created_id' => $questionModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        $result = $this->add($data);

        if ($result) {
            $this->delCache($this->getCacheId('id', $questionModel->getId()));
        }

        return $result;
    }

    /**
     * 设置题库
     * @param AppQuestionModel $questionModel
     * @return bool
     * @throws Exception
     */
    public function setQuestion(AppQuestionModel $questionModel): bool
    {
        $data = [
            'title' => $questionModel->getTitle(),
            'updated_id' => $questionModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ];

        $result = $this->set($data)
            ->where('id', $questionModel->getId())
            ->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $questionModel->getId()));
        }

        return $result;
    }

    /**
     * 设置收藏数量
     * @param $id
     * @param int $count
     * @param null $actionId
     * @return bool
     * @throws Exception
     */
    public function setCollectionCount($id, int $count = 1, $actionId = null): bool
    {
        $result = parent::set([
            'collection_count' => ":\$collection_count+{$count}",
            'updated_id' => $actionId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $id));
        }

        return $result;
    }

    /**
     * 删除题库
     * @param AppQuestionModel $questionModel
     * @return bool
     * @throws Exception
     */
    public function delQuestion(AppQuestionModel $questionModel): bool
    {
        $result = parent::set([
            'is_delete' => true,
            'updated_id' => $questionModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $questionModel->getId())->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $questionModel->getId()));
        }

        return $result;
    }

    /**
     * 获取题库列表查询对象
     * @param QuestionListCondition $condition
     * @return Driver|Mysql
     * @throws Exception
     */
    private function getQuestionListSelect(QuestionListCondition $condition)
    {
        $select = $this->get('question.*')
            ->alias('question');

        $select->where('question.is_delete', false);

        if (!empty($condition->getKeyword())) {

            $keyName = $select->getOptionsKey('keyword');

            $select->addOptions("%{$condition->getKeyword()}%", $keyName);

            $select->where("(concat(question.id,question.title)) LIKE :{$keyName} ");
        }

        if ($condition->getCourseId()) $select->in('question.course_id', $condition->getCourseId());

        if ($condition->getIds()) $select->in('question.id', $condition->getIds());

        if ($condition->getStatus()) $select->in('question.status', $condition->getStatus());

        if (!empty($condition->getStartTime())) $select->where("question.created_time", $condition->getStartTime(), '>=:');

        if (!empty($condition->getEndTime())) $select->where("question.created_time", $condition->getEndTime(), '<:');

        return $select;
    }

    /**
     * 获取题库列表
     * @param QuestionListCondition $condition
     * @return QuestionWrapper[]|null
     * @throws Exception
     */
    public function getQuestionList(QuestionListCondition $condition): array
    {
        $select = $this->getQuestionListSelect($condition);

        $select->limit($condition->getPage(), $condition->getSize());

        $statement = $select
            ->order($condition->getOrderName(), $condition->getOrderType())
            ->getStatement();

        return (array)$statement
            ->fetchAll(QuestionWrapper::class);
    }

    /**
     * 获取题库列表查询总数量
     * @param QuestionListCondition $condition
     * @return int
     * @throws Exception
     */
    public function getQuestionListCount(QuestionListCondition $condition): int
    {
        return (int)parent::getDriver()
            ->select('count(id) as count', $this->getQuestionListSelect($condition))
            ->alias('c')
            ->getStatement()
            ->fetchValue('count');
    }

    /**
     * 获取题库题库
     * @param $id
     * @return QuestionWrapper|null
     * @throws ReflectionException
     * @throws Exception
     */
    public function getQuestion($id)
    {
        $cacheId = $this->getCacheId('id', $id);

        return $this->getCacheWithCallback($cacheId, function () use ($id) {
            return $this->get()
                ->where('id', $id)
                ->where('is_delete', false)
                ->getStatement()
                ->fetch(QuestionWrapper::class);
        });
    }



}
