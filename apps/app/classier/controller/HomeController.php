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
use apps\core\classier\service\NoticeService;
use apps\core\classier\service\RedisCacheService;
use apps\core\classier\service\SettingService;
use apps\core\classier\service\UserService;
use apps\core\classier\service\VerifyCodeService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use wxsdk\mini\classier\Mini;

class HomeController extends BaseController
{

    /**
     * 用户协议
     * @route /agreement/user
     * @method get
     * @typed view
     */
    public function agreementByUser()
    {
        return parent::display('agreement/user');
    }

    /**
     * 信息保护政策
     * @route /agreement/info
     * @method get
     * @typed view
     */
    public function agreementBySave()
    {
        return parent::display('agreement/user');
    }

    /**
     * 发送短信验证码
     * @route /code/sms/send
     * @method post
     * @param $telephone
     * @param $codeType
     * @return RESTFulApi
     * @throws Exception
     */
    public function sendSMSCode($telephone, $codeType)
    {
        VerifyCodeService::getInstance()->sendSMSCode($telephone, CodeType::i($codeType));

        return RESTFulApi::success(null, '发送成功');
    }

    /**
     * 添加反馈
     * @route /feedback/add
     * @method post
     * @param UserContext $context
     * @param AppFeedbackModel $feedbackModel
     * @return RESTFulApi
     * @throws Exception
     */
    public function addFeedback(UserContext $context, AppFeedbackModel $feedbackModel)
    {
        $currentUser = $context->getCurrentUser();

        if ($currentUser != null) {
            $feedbackModel->setUserId($currentUser->getId());

            $feedbackModel->setCreatedId($currentUser->getId());
        }

        BaseService::getInstance()->addFeedback($feedbackModel);

        return RESTFulApi::success();
    }

    /**
     * 添加举报
     * @route /report/add
     * @method post
     * @param UserContext $context
     * @param AppReportModel $reportModel
     * @return RESTFulApi
     * @throws Exception
     */
    public function addReport(UserContext $context, AppReportModel $reportModel)
    {
        $currentUser = $context->getCurrentUser();

        if (!$currentUser) throw new Exception('举报必须先登录哦!', ErrorCode::USER_LOGIN_NOT);

        $reportModel->setUserId($currentUser->getId());

        $reportModel->setCreatedId($currentUser->getId());

        BaseService::getInstance()->addReport($reportModel);

        return RESTFulApi::success();
    }

    /**
     * 二维码
     * @route /code
     * @method get
     * @typed raw
     * @param $content
     * @param array|int $rect get json
     * @param array $color get json
     * @param string $label
     * @param int[] $labelColor
     * @return string|void
     * @throws Exception
     */
    public function code(
        $content,
        $rect = [300, 25],
        array $color = [
            'f' => ['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0],
            'b' => ['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0],
        ],
        string $label = '',
        array $labelColor = ['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0])
    {
        return parent::buildCode(
            $content,
            $rect,
            [PATH_APP . 'public/res/assets/logo.png', [50, 50]],
            $color,
            $label,
            $labelColor
        );
    }

    /**
     * 获取小程序二维码
     * @route /mini/code
     * @method get
     * @typed raw
     * @return void
     * @throws Exception
     */
    public function getMiniCode($scene, string $page = '', int $width = 400)
    {
        $config = MiniConfig::getInstance();

        $mini = new Mini(RedisCacheService::getInstance(), $config->getAppId(), $config->getSecret());

        $data = $mini->getProgramQCode($scene, $page, $width,
            true,
            ['r' => 34, 'g' => 201, 'b' => 147],
            false
        );

        $this->getResponse()->header('Content-Type: image/png');

        $this->getResponse()->write($data);
    }

    /**
     * 获取setting list
     * @route /setting/list
     * @method get
     * @return RESTFulApi
     * @throws Exception
     */
    public function getSettiong()
    {
        $data = SettingService::getInstance()->getList();

        return RESTFulApi::success($data);
    }

    /**
     * 获取banner list
     * @route /banner/list
     * @method get
     * @return RESTFulApi
     * @throws Exception
     */
    public function getBannerList($type = null, $bindId = null)
    {
        $data = BannerService::getInstance()
            ->getBannerList($type, $bindId);

        return RESTFulApi::success($data);
    }

    /**
     * 获取notice list
     * @route /notice/list
     * @method get
     * @return RESTFulApi
     * @throws Exception
     */
    public function getNoticeList($type = null, $bindId = null)
    {
        $data = NoticeService::getInstance()
            ->getNoticeList($type, $bindId);

        return RESTFulApi::success($data);
    }

    /**
     * 通知消息详情页面
     * @route /notice/{noticeId}/content
     * @method get
     * @template /notice/content
     * @throws Exception
     */
    public function getNoticeContent($noticeId)
    {
        $data = NoticeService::getInstance()->getNotice($noticeId);

        return ['title' => $data->getTitle(), 'content' => $data->getContent()];
    }

    /**
     * 通过手机号码获取用户id
     * @route /user/id/get
     * @method get
     * @param $telephone
     * @return RESTFulApi
     * @throws Exception
     */
    public function getUserIdByTel($telephone)
    {
        if (empty($telephone)) throw new Exception('手机号码不能为空!');

        $telephone = CommonHelper::validTelephone($telephone);

        $data = UserService::getInstance()->getUserByTel($telephone);

        return RESTFulApi::success($data->getId());
    }
}
