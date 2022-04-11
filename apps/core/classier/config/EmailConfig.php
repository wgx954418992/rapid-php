<?php


namespace apps\core\classier\config;

use apps\core\classier\enum\CodeType;

class EmailConfig
{

    /**
     * Configure
     */
    use Configure;

    /**
     * service
     * @var string
     * @config email.service
     */
    protected $service = '';

    /**
     * limit
     * @var int
     * @config email.limit
     */
    protected $limit = 0;

    /**
     * valida
     * @var int
     * @config email.valida
     */
    protected $valida = 0;

    /**
     * templates
     * @var array[]
     * @config email.templates
     */
    protected $templates = [];

    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getValida(): int
    {
        return $this->valida;
    }

    /**
     * 获取模板
     * @param CodeType $codeType
     * @return array|null
     */
    public function getTemplate(CodeType $codeType): ?array
    {
        if (!array_key_exists($codeType->getRawValue(), $this->templates)) {
            return null;
        }

        $template = $this->templates[$codeType->getRawValue()];

        if (!$template) return null;

        $template = array_merge([
            'title' => '',
            'body' => '',
            'attachments' => '',
        ], $template);

        if (!empty($template['body']) && is_file($template['body'])) {
            $template['body'] = file_get_contents($template['body']);
        }

        return $template;
    }
}
