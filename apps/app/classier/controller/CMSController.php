<?php

namespace apps\app\classier\controller;

use apps\core\classier\service\CMSService;
use Exception;
use ReflectionException;

/**
 * CMSController
 * @route /cms
 */
class CMSController extends BaseController
{

    /**
     * 栏目列表
     * @route /column/list
     * @typed auto
     * @template /cms/column/list
     * @throws Exception
     */
    public function getColumnList($type = null)
    {
        $articleList = [];

        $columnList = CMSService::getInstance()->getColumnList($type);

        foreach ($columnList as $value) {
            $articleList[$value->getId()] = CMSService::getInstance()
                ->getColumnAllArticleList($value->getId());
        }

        return ['columnList' => $columnList, 'articleList' => $articleList];
    }

    /**
     * 添加或者编辑文章
     * @route /article/{articleId}/content
     * @typed auto
     * @template /cms/article/content
     * @param $articleId
     * @return array
     * @throws ReflectionException
     */
    public function getArticle($articleId)
    {
        $articleModel = CMSService::getInstance()->getArticle($articleId);

        return ['article' => $articleModel];
    }
}
