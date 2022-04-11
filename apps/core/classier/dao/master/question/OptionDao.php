<?php

namespace apps\core\classier\dao\master\question;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\QuestionOptionModel;
use Exception;
use ReflectionException;
use function rapidPHP\Cal;

class OptionDao extends MasterDao
{

    /**
     * cache prefix
     */
    public const CACHE_PREFIX = 'question_options';

    /**
     * OptionDao
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(QuestionOptionModel::class);
    }

    /**
     * 添加问题选项列表
     * @param QuestionOptionModel $courseModel
     * @return bool
     * @throws Exception
     */
    public function addOption(QuestionOptionModel $courseModel): bool
    {
        $data = [
            'id' => $courseModel->getId(),
            'is_delete' => false,
            'created_id' => $courseModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        $result = $this->add($data);

        if ($result) {
            $this->delCache($this->getCacheId('id', $courseModel->getId()));
        }

        return $result;
    }

    /**
     * 设置问题选项列表
     * @param QuestionOptionModel $courseModel
     * @return bool
     * @throws Exception
     */
    public function setOption(QuestionOptionModel $courseModel): bool
    {
        $data = [
            'title' => $courseModel->getTitle(),
            'updated_id' => $courseModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ];

        $result = $this->set($data)
            ->where('id', $courseModel->getId())
            ->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $courseModel->getId()));
        }

        return $result;
    }

    /**
     * 获取问题选项列表问题选项列表
     * @param $id
     * @return QuestionOptionModel|null
     * @throws ReflectionException
     * @throws Exception
     */
    public function getOption($id)
    {
        $cacheId = $this->getCacheId('id', $id);

        return $this->getCacheWithCallback($cacheId, function () use ($id) {
            return $this->get()
                ->where('id', $id)
                ->where('is_delete', false)
                ->getStatement()
                ->fetch(QuestionOptionModel::class);
        });
    }

    /**
     * 删除问题选项列表
     * @param QuestionOptionModel $courseModel
     * @return bool
     * @throws Exception
     */
    public function delOption(QuestionOptionModel $courseModel): bool
    {
        $result = parent::set([
            'is_delete' => true,
            'updated_id' => $courseModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $courseModel->getId())->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $courseModel->getId()));
        }

        return $result;
    }

}
