<?php

namespace apps\admin\classier\controller\account;

use apps\core\classier\bean\CMSArticleListCondition;
use apps\core\classier\helper\CommonHelper;
use apps\core\classier\model\CmsArticleModel;
use apps\core\classier\model\CmsColumnModel;
use apps\core\classier\options\CMSArticleOptions;
use apps\core\classier\service\CMSService;
use apps\core\classier\wrapper\cms\ArticleWrapper;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use ReflectionException;
use function rapidPHP\B;

/**
 * @route /account/cms
 */
class CMSController extends ValidaAccountController
{

    /**
     * 栏目
     * @route /column/list
     * @typed auto
     * @template account/cms/list
     * @throws Exception
     */
    public function getColumnList()
    {
        $list = CMSService::getInstance()->getColumnList();

        return ['list' => $list];
    }

    /**
     * 添加或者编辑栏目
     * @route /column/added
     * @typed api
     * @method post
     * @param CmsColumnModel $columnModel
     * @return RESTFulApi
     * @throws ReflectionException
     * @throws Exception
     */
    public function addedColumn(CmsColumnModel $columnModel)
    {
        $columnModel->setCreatedId(parent::getAccountId());

        $columnModel->setUpdatedId(parent::getAccountId());

        CMSService::getInstance()->addedColumn($columnModel);

        return RESTFulApi::success($columnModel);
    }

    /**
     * 删除栏目
     * @route /column/{columnId}/del
     * @typed api
     * @method post
     * @param $columnId
     * @return RESTFulApi
     * @throws Exception
     */
    public function delColumn($columnId)
    {
        $columnModel = CMSService::getInstance()->getColumn($columnId);

        $columnModel->setUpdatedId(parent::getAccountId());

        CMSService::getInstance()->delColumn($columnModel);

        return RESTFulApi::success();
    }

    /**
     * 文章列表
     * @route /article/list
     * @typed auto
     * @template account/cms/article/list
     * @param CMSArticleListCondition $condition
     * @return array
     * @throws ReflectionException
     * @throws Exception
     */
    public function getArticleList(CMSArticleListCondition $condition)
    {
        $columnList = CMSService::getInstance()->getColumnList();

        $list = CMSService::getInstance()
            ->getArticleList(
                $condition,
                CMSArticleOptions::i(CMSArticleOptions::COLUMN)
            );

        $count = CMSService::getInstance()->getArticleListCount($condition);

        $pager = CommonHelper::pager($count, $condition->getPage(), $condition->getSize());

        return [
            'condition' => $condition,
            'count' => $count,
            'pager' => $pager,
            'list' => $list,
            'columnList' => $columnList,
        ];
    }

    /**
     * 添加或者编辑文章
     * @route /article/added
     * @typed auto
     * @template account/cms/article/added
     * @param $submit
     * @param CmsArticleModel $articleModel
     * @return array|CmsArticleModel
     * @throws ReflectionException
     * @throws Exception
     */
    public function addedArticle($submit, CmsArticleModel $articleModel)
    {
        $content = B()->getData($this->getRequest()->post, 'content');

        $articleModel->setContent($content);

        if (!empty($submit)) {
            CMSService::getInstance()->addedArticle($articleModel);

            return $articleModel;
        } else {
            if (!empty($articleModel->getId())) {
                $articleModel = CMSService::getInstance()->getArticle($articleModel->getId());
            } else {
                $articleModel = new ArticleWrapper();
            }
        }

        $columnList = CMSService::getInstance()->getColumnList();

        return [
            'article' => $articleModel,
            'columnList' => $columnList
        ];
    }

    /**
     * 删除文章
     * @route /article/{articleId}/del
     * @typed api
     * @method post
     * @param $articleId
     * @return RESTFulApi
     * @throws ReflectionException|Exception
     */
    public function delArticle($articleId)
    {
        $articleModel = CMSService::getInstance()->getArticle($articleId);

        $articleModel->setUpdatedId(parent::getAccountId());

        CMSService::getInstance()->delArticle($articleModel);

        return RESTFulApi::success();
    }
}
