<?php

namespace apps\core\classier\bean;


use apps\core\classier\options\QuestionOptions;

class QuestionListCondition extends BaseListCondition
{
    /**
     * pager
     */
    use PageListCondition;

    /**
     * 课程id
     * @var array|null
     */
    protected $course_id;

    /**
     * 课程状态
     * @var int[]|null
     */
    protected $status;

    /**
     * @var QuestionOptions|null
     */
    protected $options;

    /**
     * @return array|null
     */
    public function getCourseId(): ?array
    {
        return $this->course_id;
    }

    /**
     * @param $course_id
     */
    public function setCourseId($course_id): void
    {
        $this->course_id = $this->parseArray($course_id);
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param $status
     */
    public function setStatus($status): void
    {
        $this->status = $this->parseArray($status);
    }

    /**
     * @return QuestionOptions|null
     */
    public function getOptions(): ?QuestionOptions
    {
        return $this->options;
    }

    /**
     * @param $options
     */
    public function setOptions($options): void
    {
        if (is_numeric($options)) $options = QuestionOptions::i($options);

        $this->options = $options;
    }
}
