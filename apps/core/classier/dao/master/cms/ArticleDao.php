<?php

namespace apps\core\classier\dao\master\cms;


use apps\core\classier\bean\CMSArticleListCondition;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\CmsArticleModel;
use apps\core\classier\wrapper\cms\ArticleWrapper;
use Exception;
use rapidPHP\modules\database\sql\classier\Driver;
use function rapidPHP\Cal;

class ArticleDao extends MasterDao
{

    /**
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(CmsArticleModel::class);
    }

    /**
     * 添加文章
     * @param CmsArticleModel $articleModel
     * @return bool
     * @throws Exception
     */
    public function addArticle(CmsArticleModel $articleModel): bool
    {
        $result = parent::add([
            'column_id' => $articleModel->getColumnId(),
            'title' => $articleModel->getTitle(),
            'content' => $articleModel->getContent(),
            'rank' => $articleModel->getRank(),
            'is_delete' => false,
            'created_id' => $articleModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ], $insertId);

        if ($result) $articleModel->setId($insertId);

        return $result;
    }

    /**
     * 修改文章
     * @param CmsArticleModel $articleModel
     * @return bool
     * @throws Exception
     */
    public function setArticle(CmsArticleModel $articleModel): bool
    {
        return parent::set([
            'column_id' => $articleModel->getColumnId(),
            'title' => $articleModel->getTitle(),
            'content' => $articleModel->getContent(),
            'rank' => $articleModel->getRank(),
            'updated_id' => $articleModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $articleModel->getId())->execute();
    }

    /**
     * 删除文章
     * @param CmsArticleModel $articleModel
     * @return bool
     * @throws Exception
     */
    public function delArticle(CmsArticleModel $articleModel): bool
    {
        return parent::set([
            'is_delete' => true,
            'updated_id' => $articleModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $articleModel->getId())->execute();
    }


    /**
     * 获取文章列表查询对象
     * @param CMSArticleListCondition $condition
     * @return Driver
     * @throws Exception
     */
    private function getArticleListSelect(CMSArticleListCondition $condition)
    {
        $select = parent::get();

        if (!empty($condition->getKeyword())) {

            $keyName = $select->getOptionsKey('keyword');

            $select->addOptions("%{$condition->getKeyword()}%", $keyName);

            $select->where("(concat(id,title,content)) LIKE :{$keyName} ");
        }

        if (!empty($condition->getStartTime())) $select->where("created_time", $condition->getStartTime(), '>=:');

        if (!empty($condition->getEndTime())) $select->where("created_time", $condition->getEndTime(), '<:');

        if (!empty($condition->getColumnId())) $select->where("column_id", $condition->getColumnId());

        return $select->where('is_delete', false);
    }


    /**
     * 获取文章列表
     * @param CMSArticleListCondition $condition
     * @return ArticleWrapper[]
     * @throws Exception
     */
    public function getArticleList(CMSArticleListCondition $condition): array
    {
        $select = $this->getArticleListSelect($condition);

        $select->limit($condition->getPage(), $condition->getSize());

        return (array)$select->order($condition->getOrderName(), $condition->getOrderType())
            ->getStatement()
            ->fetchAll(ArticleWrapper::class);
    }

    /**
     * 获取栏目下的全部文章略不
     * @param $columnId
     * @return CmsArticleModel[]
     * @throws Exception
     */
    public function getColumnAllArticleList($columnId): array
    {
        return (array)parent::get()
            ->where('column_id', $columnId)
            ->where('is_delete', false)
            ->getStatement()
            ->fetchAll($this->getModelOrClass());
    }

    /**
     * 获取文章列表查询总数量
     * @param CMSArticleListCondition $condition
     * @return int
     * @throws Exception
     */
    public function getArticleListCount(CMSArticleListCondition $condition): int
    {
        $select = $this->getArticleListSelect($condition);

        return (int)$select->resetSql('select')
            ->select('count(id) as count')
            ->getStatement()
            ->fetchValue('count');
    }

    /**
     * 获取文章信息
     * @param $id
     * @return ArticleWrapper
     * @throws Exception
     */
    public function getArticle($id)
    {
        return parent::get()
            ->where('is_delete', false)
            ->where('id', $id)
            ->getStatement()
            ->fetch(ArticleWrapper::class);
    }
}
