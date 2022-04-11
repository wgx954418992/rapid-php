<?php

namespace apps\core\classier\bean;


use apps\core\classier\options\CourseOptions;

class CourseListCondition extends BaseListCondition
{
    /**
     * pager
     */
    use PageListCondition;

    /**
     * 专业id
     * @var array|null
     */
    protected $major_id;

    /**
     * 课程状态
     * @var int[]|null
     */
    protected $status;

    /**
     * @var CourseOptions|null
     */
    protected $options;

    /**
     * @return array|null
     */
    public function getMajorId(): ?array
    {
        return $this->major_id;
    }

    /**
     * @param $major_id
     */
    public function setMajorId($major_id): void
    {
        $this->major_id = $this->parseArray($major_id);
    }

    /**
     * @return int[]|null
     */
    public function getStatus(): ?array
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
     * @return CourseOptions|null
     */
    public function getOptions(): ?CourseOptions
    {
        return $this->options;
    }

    /**
     * @param $options
     */
    public function setOptions($options): void
    {
        if (is_numeric($options)) $options = CourseOptions::i($options);

        $this->options = $options;
    }
}
