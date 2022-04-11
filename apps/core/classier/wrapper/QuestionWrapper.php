<?php


namespace apps\core\classier\wrapper;


use apps\core\classier\model\AppQuestionModel;

class QuestionWrapper extends AppQuestionModel
{

    /**
     * 课程信息
     * @var CourseWrapper|null
     */
    protected $course;

    /**
     * @return CourseWrapper|null
     */
    public function getCourse(): ?CourseWrapper
    {
        return $this->course;
    }

    /**
     * @param CourseWrapper|null $course
     */
    public function setCourse(?CourseWrapper $course): void
    {
        $this->course = $course;
    }
}
