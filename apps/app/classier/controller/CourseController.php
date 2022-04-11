<?php

namespace apps\app\classier\controller;

use apps\app\classier\context\UserContext;
use apps\app\classier\service\BaseService;
use apps\core\classier\bean\CourseListCondition;
use apps\core\classier\config\wechat\MiniConfig;
use apps\core\classier\enum\CodeType;
use apps\core\classier\enum\ErrorCode;
use apps\core\classier\helper\CommonHelper;
use apps\core\classier\model\AppFeedbackModel;
use apps\core\classier\model\AppReportModel;
use apps\core\classier\options\CourseOptions;
use apps\core\classier\service\BannerService;
use apps\core\classier\service\CourseService;
use apps\core\classier\service\MajorService;
use apps\core\classier\service\NoticeService;
use apps\core\classier\service\RedisCacheService;
use apps\core\classier\service\SettingService;
use apps\core\classier\service\UserService;
use apps\core\classier\service\VerifyCodeService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use wxsdk\mini\classier\Mini;

/**
 * Class CourseController
 * @route /course
 * @package apps\app\classier\controller
 */
class CourseController extends BaseController
{

    /**
     * 通过专业id获取课程列表
     * @route /major/list
     * @method get
     * @param array|null $majorId get json
     * @param $options
     * @return RESTFulApi
     * @throws Exception
     */
    public function getCourseListByMajorId(?array $majorId, $options)
    {
        $options = $options ? CourseOptions::i($options) : null;

        $list = CourseService::getInstance()->getCourseListByMajorId($majorId, $options);

        return RESTFulApi::success($list);
    }

    /**
     * 获取课程详情
     * @route /{courseId}/get
     * @method get
     * @param $courseId
     * @param $options
     * @return RESTFulApi
     * @throws Exception
     */
    public function getCourse($courseId, $options)
    {
        $options = $options ? CourseOptions::i($options) : null;

        $data = CourseService::getInstance()->getCourse($courseId, $options);

        return RESTFulApi::success($data);
    }
}
