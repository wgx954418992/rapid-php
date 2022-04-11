<?php

namespace apps\app\classier\controller;

use apps\core\classier\bean\QuestionListCondition;
use apps\core\classier\options\QuestionOptions;
use apps\core\classier\service\QuestionService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;

/**
 * Class QuestionController
 * @route /question
 * @package apps\app\classier\controller
 */
class QuestionController extends BaseController
{

    /**
     * 获取题列表
     * @route /list
     * @method get
     * @param QuestionListCondition $condition
     * @return RESTFulApi
     * @throws Exception
     */
    public function getQuestionList(QuestionListCondition $condition)
    {
        $list = QuestionService::getInstance()
            ->getQuestionList($condition);

        return RESTFulApi::success($list);
    }

    /**
     * 获取题详情
     * @route /{questionId}/get
     * @method get
     * @param $questionId
     * @param $options
     * @return RESTFulApi
     * @throws Exception
     */
    public function getQuestion($questionId, $options)
    {
        $options = $options ? QuestionOptions::i($options) : null;

        $data = QuestionService::getInstance()
            ->getQuestion($questionId, $options);

        return RESTFulApi::success($data);
    }
}
