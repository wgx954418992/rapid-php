<?php

namespace apps\core\classier\bean;

use apps\core\classier\model\AppMajorModel;
use rapidPHP\modules\core\classier\Model;

class SpecificMajorBean extends Model
{
    /**
     * @var AppMajorModel|null
     */
    protected $top;

    /**
     * 当前
     * @var AppMajorModel|null
     */
    protected $self;

    /**
     * 路径,从top->self
     * @var AppMajorModel[]|null
     */
    protected $path;

    /**
     * @return AppMajorModel|null
     */
    public function getTop(): ?AppMajorModel
    {
        return $this->top;
    }

    /**
     * @param AppMajorModel|null $top
     */
    public function setTop(?AppMajorModel $top): void
    {
        $this->top = $top;
    }

    /**
     * @return AppMajorModel|null
     */
    public function getSelf(): ?AppMajorModel
    {
        return $this->self;
    }

    /**
     * @param AppMajorModel|null $self
     */
    public function setSelf(?AppMajorModel $self): void
    {
        $this->self = $self;
    }

    /**
     * @return AppMajorModel[]|null
     */
    public function getPath(): ?array
    {
        return $this->path;
    }

    /**
     * @param AppMajorModel[]|null $path
     */
    public function setPath(?array $path): void
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        if (empty($this->path)) return '';

        return join(array_map(function ($a) {
            return $a->getName();
        }, $this->path), '/');
    }
}
