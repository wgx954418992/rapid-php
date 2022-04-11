<?php

namespace apps\core\classier\service;


use apps\core\classier\bean\CMSArticleListCondition;
use apps\core\classier\dao\master\cms\ArticleDao;
use apps\core\classier\dao\master\cms\ColumnDao;
use apps\core\classier\model\CmsArticleModel;
use apps\core\classier\model\CmsColumnModel;
use apps\core\classier\options\CMSArticleOptions;
use apps\core\classier\wrapper\cms\ArticleWrapper;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use ReflectionException;

class CMSService
{


    /**
     * 单例模式
     */
    use Instances;

    /**
     * 初始化当前
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * 获取栏目
     * @param $type
     * @return CmsColumnModel[]
     * @throws Exception
     */
    public function getColumnList($type = null): array
    {
        /** @var ColumnDao $columnDao */
        $columnDao = ColumnDao::getInstance();

        return $columnDao->getColumnList($type);
    }

    /**
     * 获取栏目
     * @param $columnId
     * @return CmsColumnModel
     * @throws Exception
     */
    public function getColumn($columnId)
    {
        if (empty($columnId)) throw new Exception('栏目id 错误!');

        /** @var ColumnDao $columnDao */
        $columnDao = ColumnDao::getInstance();

        $columnModel = $columnDao->getColumn($columnId);

        if ($columnModel == null) throw new Exception('栏目不存在!');

        return $columnModel;
    }


    /**
     * 添加或者修改栏目
     * @param CmsColumnModel $columnModel
     * @throws ReflectionException
     * @throws Exception
     */
    public function addedColumn(CmsColumnModel $columnModel)
    {
        if (empty($columnModel->getTitle())) throw new Exception('名称错误!');

        /** @var ColumnDao $columnDao */
        $columnDao = ColumnDao::getInstance();

        if ($columnModel->getId()) {
            if (!$columnDao->setColumn($columnModel))
                throw new Exception('修改失败!');
        } else {
            if (!$columnDao->addColumn($columnModel))
                throw new Exception('添加失败!');
        }
    }


    /**
     * 删除栏目
     * @param CmsColumnModel $columnModel
     * @throws Exception
     */
    public function delColumn(CmsColumnModel $columnModel)
    {
        if (empty($columnModel->getId())) throw new Exception('栏目id 错误!');

        /** @var ColumnDao $columnDao */
        $columnDao = ColumnDao::getInstance();

        if (!$columnDao->delColumn($columnModel))
            throw new Exception('删除失败!');
    }

    /**
     * 获取文章列表
     * @param CMSArticleListCondition $condition
     * @param CMSArticleOptions|null $articleOptions
     * @return ArticleWrapper[]
     * @throws Exception
     */
    public function getArticleList(CMSArticleListCondition $condition, ?CMSArticleOptions $articleOptions = null): array
    {
        /** @var ArticleDao $articleDao */
        $articleDao = ArticleDao::getInstance();

        $list = $articleDao->getArticleList($condition);

        foreach ($list as $value) {

            if (!$articleOptions) continue;

            $articleOptions->then(CMSArticleOptions::COLUMN, function () use ($value) {
                $columnModel = $this->getColumn($value->getColumnId());

                $value->setColumn($columnModel);
            });
        }

        return $list;
    }

    /**
     * 获取文章列表
     * @param $columnId
     * @return ArticleWrapper[]
     * @throws Exception
     */
    public function getColumnAllArticleList($columnId): array
    {
        if (empty($columnId)) throw new Exception('栏目错误!');

        /** @var ArticleDao $articleDao */
        $articleDao = ArticleDao::getInstance();

        return $articleDao->getColumnAllArticleList($columnId);
    }


    /**
     * 获取文章列表查询总数量
     * @param CMSArticleListCondition $condition
     * @return int
     * @throws ReflectionException
     * @throws Exception
     */
    public function getArticleListCount(CMSArticleListCondition $condition): int
    {
        /** @var ArticleDao $articleDao */
        $articleDao = ArticleDao::getInstance();

        return $articleDao->getArticleListCount($condition);
    }


    /**
     * 获取文章
     * @param $articleId
     * @return ArticleWrapper
     * @throws ReflectionException
     * @throws Exception
     */
    public function getArticle($articleId)
    {
        if (empty($articleId)) throw new Exception('帮助文章id 错误!');

        /** @var ArticleDao $articleDao */
        $articleDao = ArticleDao::getInstance();

        $articleModel = $articleDao->getArticle($articleId);

        if ($articleModel == null) throw new Exception('帮助文章不存在!');

        return $articleModel;
    }


    /**
     * 添加或者修改文章
     * @param CmsArticleModel $articleModel
     * @throws ReflectionException
     * @throws Exception
     */
    public function addedArticle(CmsArticleModel $articleModel)
    {
        if (empty($articleModel->getColumnId())) throw new Exception('栏目id 错误!');

        if (empty($articleModel->getTitle())) throw new Exception('标题 错误!');

        if (empty($articleModel->getContent())) throw new Exception('内容 错误!');

        /** @var ArticleDao $articleDao */
        $articleDao = ArticleDao::getInstance();

        if ($articleModel->getId()) {
            if (!$articleDao->setArticle($articleModel))
                throw new Exception('修改失败!');
        } else {
            if (!$articleDao->addArticle($articleModel))
                throw new Exception('添加失败!');
        }
    }

    /**
     * 删除文章
     * @param CmsArticleModel $articleModel
     * @throws Exception
     */
    public function delArticle(CmsArticleModel $articleModel)
    {
        if (empty($articleModel->getId())) throw new Exception('帮助文章id 错误!');

        /** @var ArticleDao $articleDao */
        $articleDao = ArticleDao::getInstance();

        if (!$articleDao->delArticle($articleModel))
            throw new Exception('删除失败!');
    }
}
