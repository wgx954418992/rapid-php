<?php

namespace apps\tests;

use apps\core\classier\bean\RelationshipListCondition;
use apps\core\classier\dao\master\user\FollowDao;
use apps\core\classier\model\AppCourseModel;
use apps\core\classier\service\CourseService;
use apps\core\classier\service\FollowService;
use Exception;

class CourseTest extends BaseTest
{

    /**
     * 测试添加课程
     * @throws Exception
     */
    public function testAddCourse()
    {
        $courses = [
            ['title' => '工商管理入门到精通', 'major_id' => 1000056],
            ['title' => '工商专业英语', 'major_id' => 1000056],

            ['title' => '工商管理入门到精通', 'major_id' => 1000059],
            ['title' => '工商商务英语', 'major_id' => 1000059],
            ['title' => '工商数学', 'major_id' => 1000059],
            ['title' => '理工英语', 'major_id' => 1000059],
            ['title' => '理工数学', 'major_id' => 1000059],
            ['title' => 'C/C++入门到精通', 'major_id' => 1000059],
            ['title' => 'PHP全栈开发', 'major_id' => 1000059],
        ];

        foreach ($courses as $course) {
            $courseModel = new AppCourseModel();

            $courseModel->setMajorId($course['major_id']);

            $courseModel->setTitle($course['title']);

            CourseService::getInstance()
                ->addedCourse($courseModel);
        }

        $this->assertIsBool(true);
    }

    /**
     * 测试删除课程
     * @throws Exception
     */
    public function testDelCourse()
    {
        $courseModel = CourseService::getInstance()
            ->getCourse(58995139018);

        CourseService::getInstance()
            ->delCourse($courseModel);

        $this->assertIsBool(true);
    }


}
