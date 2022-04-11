<?php

namespace apps\core\classier\dao\master\user;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\UserQuestionModel;
use Exception;
use ReflectionException;
use function rapidPHP\Cal;

class QuestionDao extends MasterDao
{

    /**
     * cache prefix
     */
    public const CACHE_PREFIX = 'user_question';

    /**
     * QuestionDao
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(UserQuestionModel::class);
    }

    /**
     * 添加刷题
     * @param UserQuestionModel $questionModel
     * @return bool
     * @throws Exception
     */
    public function addQuestion(UserQuestionModel $questionModel): bool
    {
        $data = [
            'user_id' => $questionModel->getUserId(),
            'course_id' => $questionModel->getCourseId(),
            'question_id' => $questionModel->getQuestionId(),
            'result' => $questionModel->getResult(),
            'is_delete' => false,
            'created_id' => $questionModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        $result = $this->add($data, $insertId);

        if ($result) {
            $questionModel->setId($insertId);

            $this->delCache($this->getCacheId('id', $questionModel->getId()));
        }

        return $result;
    }

    /**
     * 设置刷题结果
     * @param UserQuestionModel $questionModel
     * @return bool
     * @throws Exception
     */
    public function setQuestionRight(UserQuestionModel $questionModel): bool
    {
        $data = [
            'result' => $questionModel->getResult(),
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
     * 删除刷题
     * @param UserQuestionModel $questionModel
     * @return bool
     * @throws Exception
     */
    public function delQuestion(UserQuestionModel $questionModel): bool
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
     * 获取题库题库
     * @param $id
     * @return UserQuestionModel|null
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
                ->fetch(UserQuestionModel::class);
        });
    }

}
