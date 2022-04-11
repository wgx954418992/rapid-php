<?php


namespace apps\core\classier\wrapper;


use apps\core\classier\bean\SpecificMajorBean;
use apps\core\classier\model\AppCourseModel;
use apps\core\classier\model\AppMajorModel;

class CourseWrapper extends AppCourseModel
{

    /**
     * 专业
     * @var AppMajorModel|null
     */
    protected $major;

    /**
     * 专业
     * @var SpecificMajorBean|null
     */
    protected $specific_major;

    /**
     * @return AppMajorModel|null
     */
    public function getMajor(): ?AppMajorModel
    {
        return $this->major;
    }

    /**
     * @param AppMajorModel|null $major
     */
    public function setMajor(?AppMajorModel $major): void
    {
        $this->major = $major;
    }

    /**
     * @return SpecificMajorBean|null
     */
    public function getSpecificMajor(): ?SpecificMajorBean
    {
        return $this->specific_major;
    }

    /**
     * @param SpecificMajorBean|null $specific_major
     */
    public function setSpecificMajor(?SpecificMajorBean $specific_major): void
    {
        $this->specific_major = $specific_major;
    }
}
