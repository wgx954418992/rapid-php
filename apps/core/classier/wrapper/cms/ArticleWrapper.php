<?php

namespace apps\core\classier\wrapper\cms;



use apps\core\classier\model\CmsArticleModel;
use apps\core\classier\model\CmsColumnModel;

class ArticleWrapper extends CmsArticleModel
{

    /**
     * @var CmsColumnModel|null
     */
    protected $column;

    /**
     * @return CmsColumnModel|null
     */
    public function getColumn(): ?CmsColumnModel
    {
        return $this->column;
    }

    /**
     * @param CmsColumnModel|null $column
     */
    public function setColumn(?CmsColumnModel $column): void
    {
        $this->column = $column;
    }
}
