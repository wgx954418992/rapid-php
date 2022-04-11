<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\bean\CourseListCondition;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppCourseModel;
use apps\core\classier\wrapper\CourseWrapper;
use Exception;
use rapidPHP\modules\database\sql\classier\Driver;
use rapidPHP\modules\database\sql\classier\driver\Mysql;
use rapidPHP\modules\reflection\classier\Utils;
use ReflectionException;
use function rapidPHP\Cal;

class CourseDao extends MasterDao
{

    /**
     * cache prefix
     */
    public const CACHE_PREFIX = 'app_course';

    /**
     * CourseDao
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppCourseModel::class);
    }

    /**
     * 添加课程
     * @param AppCourseModel $courseModel
     * @return bool
     * @throws Exception
     */
    public function addCourse(AppCourseModel $courseModel): bool
    {
        $data = [
            'id' => $courseModel->getId(),
            'major_id' => $courseModel->getMajorId(),
            'title' => $courseModel->getTitle(),
            'desc' => $courseModel->getDesc(),
            'status' => $courseModel->getStatus(),
            'is_delete' => false,
            'created_id' => $courseModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        if (is_object($courseModel->getTag())) {
            $data['tag'] = json_encode(Utils::getInstance()->toArray($courseModel->getTag()));
        } else if (is_array($courseModel->getTag())) {
            $data['tag'] = json_encode($courseModel->getTag());
        } else {
            $data['tag'] = null;
        }

        $result = $this->add($data);

        if ($result) {
            $this->delCache($this->getCacheId('id', $courseModel->getId()));
        }

        return $result;
    }

    /**
     * 设置课程
     * @param AppCourseModel $courseModel
     * @return bool
     * @throws Exception
     */
    public function setCourse(AppCourseModel $courseModel): bool
    {
        $data = [
            'major_id' => $courseModel->getMajorId(),
            'title' => $courseModel->getTitle(),
            'desc' => $courseModel->getDesc(),
            'status' => $courseModel->getStatus(),
            'updated_id' => $courseModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ];

        if (is_object($courseModel->getTag())) {
            $data['tag'] = json_encode(Utils::getInstance()->toArray($courseModel->getTag()));
        } else if (is_array($courseModel->getTag())) {
            $data['tag'] = json_encode($courseModel->getTag());
        } else {
            $data['tag'] = null;
        }

        $result = $this->set($data)
            ->where('id', $courseModel->getId())
            ->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $courseModel->getId()));
        }

        return $result;
    }

    /**
     * 设置题库数量
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
     * 删除课程
     * @param AppCourseModel $courseModel
     * @return bool
     * @throws Exception
     */
    public function delCourse(AppCourseModel $courseModel): bool
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
     * 获取课程列表查询对象
     * @param CourseListCondition $condition
     * @return Driver|Mysql
     * @throws Exception
     */
    private function getCourseListSelect(CourseListCondition $condition)
    {
        $select = $this->get('course.*')
            ->alias('course');

        $select->where('course.is_delete', false);

        if (!empty($condition->getKeyword())) {

            $keyName = $select->getOptionsKey('keyword');

            $select->addOptions("%{$condition->getKeyword()}%", $keyName);

            $select->where("(concat(course.id,course.title)) LIKE :{$keyName} ");
        }

        if ($condition->getMajorId()) $select->in('course.major_id', $condition->getMajorId());

        if ($condition->getIds()) $select->in('course.id', $condition->getIds());

        if ($condition->getStatus()) $select->in('course.status', $condition->getStatus());

        if (!empty($condition->getStartTime())) $select->where("course.created_time", $condition->getStartTime(), '>=:');

        if (!empty($condition->getEndTime())) $select->where("course.created_time", $condition->getEndTime(), '<:');

        return $select;
    }

    /**
     * 获取课程列表
     * @param CourseListCondition $condition
     * @return CourseWrapper[]|null
     * @throws Exception
     */
    public function getCourseList(CourseListCondition $condition): array
    {
        $select = $this->getCourseListSelect($condition);

        $select->limit($condition->getPage(), $condition->getSize());

        $statement = $select
            ->order($condition->getOrderName(), $condition->getOrderType())
            ->getStatement();

        return (array)$statement
            ->fetchAll(CourseWrapper::class);
    }

    /**
     * 获取课程列表查询总数量
     * @param CourseListCondition $condition
     * @return int
     * @throws Exception
     */
    public function getCourseListCount(CourseListCondition $condition): int
    {
        return (int)parent::getDriver()
            ->select('count(id) as count', $this->getCourseListSelect($condition))
            ->alias('c')
            ->getStatement()
            ->fetchValue('count');
    }

    /**
     * 通过专业id获取课程列表
     * @param $majorId
     * @return CourseWrapper[]
     * @throws Exception
     */
    public function getCourseListByMajorId($majorId): array
    {
        return (array)$this->get()
            ->in('major_id', $majorId)
            ->where('is_delete', false)
            ->getStatement()
            ->fetchAll(CourseWrapper::class);
    }

    /**
     * 获取课程课程
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
