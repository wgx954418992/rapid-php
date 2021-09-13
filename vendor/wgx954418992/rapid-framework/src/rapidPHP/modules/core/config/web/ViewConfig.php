<?php


namespace rapidPHP\modules\core\config\web;


use Exception;
use rapidPHP\modules\cache\classier\CacheInterface;
use rapidPHP\modules\core\classier\web\template\TemplateService;
use rapidPHP\modules\reflection\classier\Classify;

class ViewConfig
{

    /**
     * @var TemplateService
     */
    protected $template_service;

    /**
     * ViewConfig constructor.
     * @param string[]|null $ext
     * @param string|null $template_path
     * @param string|null $cache_path
     * @param string $template_service
     * @throws Exception
     */
    public function __construct(?array $ext, ?string $template_path, ?string $cache_path, string $template_service)
    {
        /** @var TemplateService $service */
        $service = Classify::getInstance($template_service)->newInstance($ext, $template_path, $cache_path);

        $this->template_service = $service;
    }

    /**
     * @return TemplateService
     */
    public function getTemplateService(): TemplateService
    {
        return $this->template_service;
    }
}
