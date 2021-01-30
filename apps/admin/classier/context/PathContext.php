<?php

namespace apps\admin\classier\context;

use apps\core\classier\context\PathContextInterface;
use function rapidPHP\V;

class PathContext implements PathContextInterface
{

    /**
     * @var WebContext
     */
    private $context;

    /**
     * PathContext constructor.
     * @param WebContext $context
     */
    public function __construct(WebContext $context)
    {
        $this->context = $context;
    }

    /**
     * 获取文件url地址
     * @param $fileId
     * @return string
     */
    public function getFileUrl($fileId): string
    {
        if (empty($fileId)) return '';

        if (V()->website($fileId)) {
            return $fileId;
        } else {
            return $this->context->getRequest()->toUrl('admin/file/' . $fileId);
        }
    }
}