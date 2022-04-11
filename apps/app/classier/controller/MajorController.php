<?php

namespace apps\app\classier\controller;

use apps\app\classier\context\UserContext;
use apps\app\classier\service\BaseService;
use apps\core\classier\config\wechat\MiniConfig;
use apps\core\classier\enum\CodeType;
use apps\core\classier\enum\ErrorCode;
use apps\core\classier\helper\CommonHelper;
use apps\core\classier\model\AppFeedbackModel;
use apps\core\classier\model\AppReportModel;
use apps\core\classier\service\BannerService;
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
 * Class MajorController
 * @route /major
 * @package apps\app\classier\controller
 */
class MajorController extends BaseController
{

    /**
     * 获取全部专业列表
     * @route /all
     * @return RESTFulApi
     * @throws Exception
     */
    public function getAllMajorList()
    {
        $data = MajorService::getInstance()
            ->getAllMajorList();

        return RESTFulApi::success($data);
    }
}
