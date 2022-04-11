<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppMajorModel;
use Exception;
use ReflectionException;
use function rapidPHP\Cal;

class MajorDao extends MasterDao
{

    /**
     * cache prefix
     */
    public const CACHE_PREFIX = 'app_major';

    /**
     * MajorDao
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppMajorModel::class);
    }

    /**
     * 添加专业
     * @param AppMajorModel $majorModel
     * @return bool
     * @throws Exception
     */
    public function addMajor(AppMajorModel $majorModel): bool
    {
        $data = [
            'id' => $majorModel->getId(),
            'name' => $majorModel->getName(),
            'level' => $majorModel->getLevel(),
            'course_count' => $majorModel->getCourseCount(),
            'question_count' => $majorModel->getQuestionCount(),
            'is_delete' => false,
            'created_id' => $majorModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        if ($majorModel->getParentId()) {
            $data['parent_id'] = $majorModel->getParentId();
        } else {
            $data['parent_id'] = null;
        }

        if ($majorModel->getOptions()) $data['options'] = $majorModel->getOptions();

        $result = $this->add($data);

        if ($result) {
            $this->delCache($this->getCacheIdList('/list.*/i'));
        }

        return $result;
    }

    /**
     * 设置专业
     * @param AppMajorModel $majorModel
     * @return bool
     * @throws Exception
     */
    public function setMajor(AppMajorModel $majorModel): bool
    {
        $data = [
            'name' => $majorModel->getName(),
            'level' => $majorModel->getLevel(),
            'course_count' => $majorModel->getCourseCount(),
            'question_count' => $majorModel->getQuestionCount(),
            'updated_id' => $majorModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ];

        if ($majorModel->getParentId()) {
            $data['parent_id'] = $majorModel->getParentId();
        } else {
            $data['parent_id'] = null;
        }

        if ($majorModel->getOptions()) $data['options'] = $majorModel->getOptions();

        $result = $this->set($data)
            ->where('id', $majorModel->getId())
            ->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $majorModel->getId()));

            $this->delCache($this->getCacheIdList('/list.*/i'));
        }

        return $result;
    }

    /**
     * 设置课程数量
     * @param $id
     * @param int $count
     * @param null $actionId
     * @return bool
     * @throws Exception
     */
    public function setCourseCount($id, int $count = 1, $actionId = null): bool
    {
        $result = parent::set([
            'course_count' => ":\$course_count+{$count}",
            'updated_id' => $actionId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $id));
        }

        return $result;
    }

    /**
     * 设置题数量
     * @param $id
     * @param int $count
     * @param null $actionId
     * @return bool
     * @throws Exception
     */
    public function setQuestionCount($id, int $count = 1, $actionId = null): bool
    {
        $result = parent::set([
            'question_count' => ":\$question_count+{$count}",
            'updated_id' => $actionId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $id));
        }

        return $result;
    }

    /**
     * 删除专业
     * @param AppMajorModel $courseModel
     * @return bool
     * @throws Exception
     */
    public function delMajor(AppMajorModel $courseModel): bool
    {
        $result = $this->set([
            'is_delete' => true,
            'updated_id' => $courseModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $courseModel->getId())->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $courseModel->getId()));

            $this->delCache($this->getCacheIdList('/list.*/i'));
        }

        return $result;
    }

    /**
     * 获取全部专业信息
     * @return AppMajorModel[]
     * @throws Exception
     */
    public function getAllMajorList(): array
    {
        $cacheId = $this->getCacheId('list');

        return (array)$this->getCacheWithCallback($cacheId, function () {
            return $this->get()
                ->where('is_delete', false)
                ->getStatement()
                ->fetchAll($this->getModelOrClass());
        });
    }

    /**
     * 获取专业信息
     * @param $id
     * @return AppMajorModel
     * @throws ReflectionException
     * @throws Exception
     */
    public function getMajor($id)
    {
        $cacheId = $this->getCacheId('id', $id);

        return $this->getCacheWithCallback($cacheId, function () use ($id) {
            return $this->get()
                ->where('id', $id)
                ->where('is_delete', false)
                ->getStatement()
                ->fetch($this->getModelOrClass());
        });
    }
}
