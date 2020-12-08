<?php


namespace rapidPHP\modules\application\wrapper\application;

use rapidPHP\modules\core\config\web\ViewConfig;

class WebWrapper
{

    /**
     * @var ViewConfig|null
     */
    private $view;

    /**
     * @return ViewConfig|null
     */
    public function getView(): ?ViewConfig
    {
        return $this->view;
    }

    /**
     * @param ViewConfig|null $view
     */
    public function setView(?ViewConfig $view): void
    {
        $this->view = $view;
    }

}