<?php

namespace apps\core\classier\dao\master\user;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\UserCourseModel;
use apps\core\classier\wrapper\CourseWrapper;
use Exception;
use ReflectionException;
use function rapidPHP\Cal;

class CourseDao extends MasterDao
{

    /**
     * cache prefix
     */
    public const CACHE_PREFIX = 'user_course';

    /**
     * CourseDao
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(UserCourseModel::class);
    }

    /**
     * 添加课程
     * @param UserCourseModel $courseModel
     * @return bool
     * @throws Exception
     */
    public function addCourse(UserCourseModel $courseModel): bool
    {
        $data = [
            'user_id' => $courseModel->getUserId(),
            'course_id' => $courseModel->getCourseId(),
            'brushed_count' => $courseModel->getBrushedCount(),
            'right_count' => $courseModel->getRightCount(),
            'error_count' => $courseModel->getErrorCount(),
            'skip_count' => $courseModel->getSkipCount(),
            'last_qid' => $courseModel->getLastQid(),
            'is_delete' => false,
            'created_id' => $courseModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        $result = $this->add($data, $insertId);

        if ($result) {
            $courseModel->setId($insertId);

            $this->delCache($this->getCacheId('id', $courseModel->getId()));
        }

        return $result;
    }

    /**
     * 设置课程
     * @param UserCourseModel $courseModel
     * @return bool
     * @throws Exception
     */
    public function setCourse(UserCourseModel $courseModel): bool
    {
        $data = [
            'brushed_count' => $courseModel->getBrushedCount(),
            'right_count' => $courseModel->getRightCount(),
            'error_count' => $courseModel->getErrorCount(),
            'skip_count' => $courseModel->getSkipCount(),
            'last_qid' => $courseModel->getLastQid(),
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
     * 设置已刷题数量
     * @param $id
     * @param int $count
     * @param null $actionId
     * @return bool
     * @throws Exception
     */
    public function setBrushedCount($id, int $count = 1, $actionId = null): bool
    {
        return parent::set([
            'brushed_count' => ":\$brushed_count+{$count}",
            'updated_id' => $actionId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)->execute();
    }

    /**
     * 设置正确题数量
     * @param $id
     * @param int $count
     * @param null $actionId
     * @return bool
     * @throws Exception
     */
    public function setRightCount($id, int $count = 1, $actionId = null): bool
    {
        return parent::set([
            'right_count' => ":\$right_count+{$count}",
            'updated_id' => $actionId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)->execute();
    }

    /**
     * 设置错误题数量
     * @param $id
     * @param int $count
     * @param null $actionId
     * @return bool
     * @throws Exception
     */
    public function setErrorCount($id, int $count = 1, $actionId = null): bool
    {
        return parent::set([
            'error_count' => ":\$error_count+{$count}",
            'updated_id' => $actionId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)->execute();
    }

    /**
     * 设置跳过题数量
     * @param $id
     * @param int $count
     * @param null $actionId
     * @return bool
     * @throws Exception
     */
    public function setSkipCount($id, int $count = 1, $actionId = null): bool
    {
        return parent::set([
            'skip_count' => ":\$skip_count+{$count}",
            'updated_id' => $actionId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)->execute();
    }


    /**
     * 删除课程
     * @param UserCourseModel $courseModel
     * @return bool
     * @throws Exception
     */
    public function delCourse(UserCourseModel $courseModel): bool
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

    /**
     * 获取课程
     * @param $id
     * @return CourseWrapper|null
     * @throws ReflectionException
     * @throws Exception
     */
    public function getCourse($id)
    {
        $cacheId = $this->getCacheId('id', $id);

        return $this->getCacheWithCallback($cacheId, function () use ($id) {
            return $this->get()
                ->where('id', $id)
                ->where('is_delete', false)
                ->getStatement()
                ->fetch(CourseWrapper::class);
        });
    }

}
