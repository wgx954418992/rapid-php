<?php

namespace apps\app\classier\service;

use apps\core\classier\dao\master\FeedbackDao;
use apps\core\classier\dao\master\ReportDao;
use apps\core\classier\dao\master\TokenDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\ErrorCode;
use apps\core\classier\enum\feedback\Status;
use apps\core\classier\model\AppFeedbackModel;
use apps\core\classier\model\AppReportModel;
use apps\core\classier\options\UserOptions;
use apps\core\classier\service\BaseService as CoreBaseService;
use apps\core\classier\service\SettingService;
use apps\core\classier\service\UserService as CoreUserService;
use apps\core\classier\wrapper\UserWrapper;
use Exception;
use function rapidPHP\Cal;

class BaseService extends CoreBaseService
{

    /**
     * 效验用户是否登录
     * @param UserWrapper|null $userModel
     * @throws Exception
     */
    public static function validaUserModel(?UserWrapper $userModel)
    {
        if ($userModel == null) throw new Exception('请先登录!', ErrorCode::USER_LOGIN_NOT);
    }

    /**
     * 通过token获取用户信息
     * @param $token
     * @param UserOptions|null $options
     * @return UserWrapper
     * @throws Exception
     */
    public function getUserByToken($token, ?UserOptions $options = null): UserWrapper
    {
        if (empty($token)) throw new Exception('请先登录!');

        $tokenDao = TokenDao::getInstance();

        if (!$userId = $tokenDao::getInstance()->getTokenBindId($token))
            throw new Exception('你的帐号已在异地登录,如果不是本人登录，请修改密码后，重新登录!');

        return CoreUserService::getInstance()
            ->getUser($userId, null, $options);
    }

    /**
     * 添加反馈
     * @param AppFeedbackModel $feedbackModel
     * @return bool
     * @throws Exception
     */
    public function addFeedback(AppFeedbackModel $feedbackModel): bool
    {
        if (strlen($feedbackModel->getContent()) < 10) throw new Exception('内容不能少于10个字哦!');

        $feedbackModel->setStatus(Status::WAITING);

        /** @var FeedbackDao $feedbackDao */
        $feedbackDao = FeedbackDao::getInstance();

        if (!$feedbackDao->addFeedback($feedbackModel))
            throw new Exception('提交失败!');

        return true;
    }

    /**
     * 添加举报
     * @param AppReportModel $reportModel
     * @throws Exception
     */
    public function addReport(AppReportModel $reportModel)
    {
        if (empty($reportModel->getBindId())) throw new Exception("举报id错误!");

        if (empty($reportModel->getContent())) throw new Exception('举报内容错误!');

        if (empty($reportModel->getType())) throw new Exception('举报类型不能为空!');

        /** @var ReportDao $reportDao */
        $reportDao = ReportDao::getInstance();

        if ($reportModel->getUserId()) {
            if ($reportDao->getReportByUB($reportModel->getUserId(), $reportModel->getBindId()) != null)
                throw new Exception('您已经举报过了哦，不能再次举报了!');

            $todayReportCount = $reportDao->getReportCountByUserId($reportModel->getUserId(),
                Cal()->getDate(time(), 'Y-m-d 00:00:00'),
                Cal()->getDate(time(), 'Y-m-d 23:59:59')
            );

            $everyDayReportCount = (int)SettingService::getInstance()
                ->getUserEveryDayReportCount();

            if ($todayReportCount >= $everyDayReportCount) {
                throw new Exception('今日举报次数已达上线，不能举报了哦!');
            }
        }

        MasterDao::getSQLDB()->beginTransaction();

        try {
            $reportDao->addReport($reportModel);

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('提交失败!');
        } catch (Exception$e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }
}
