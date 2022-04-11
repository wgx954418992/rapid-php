<?php

namespace apps\core\classier\service\user;

use apps\core\classier\dao\master\member\OrderDao;
use apps\core\classier\dao\master\member\RecordDao;
use apps\core\classier\dao\master\user\MemberDao as UserMemberDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\cashier\BindType;
use apps\core\classier\model\AppCashierModel;
use apps\core\classier\model\CashierBindModel;
use apps\core\classier\model\MemberOrderModel;
use apps\core\classier\model\MemberRecordModel;
use apps\core\classier\model\UserMemberModel;
use apps\core\classier\service\MemberService as CoreMemberService;
use apps\core\classier\service\PayService;
use apps\core\classier\wrapper\user\MemberWrapper;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use function rapidPHP\B;
use function rapidPHP\Cal;

class MemberService
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
     * 创建开通订单
     * @param $memberId
     * @param $userId
     * @return AppCashierModel
     * @throws Exception
     */
    public function createOrder($memberId, $userId)
    {
        if (empty($userId)) throw new Exception('用户id错误!');

        $memberModel = CoreMemberService::getInstance()
            ->getMember($memberId);

        /** @var OrderDao $orderDao */
        $orderDao = OrderDao::getInstance();

        $orderModel = new MemberOrderModel();

        $orderModel->setId(B()->onlyIdToInt());

        $orderModel->setUserId($userId);

        $orderModel->setMemberId($memberModel->getId());

        $orderModel->setTotalFee($memberModel->getAmount());

        $cashierModel = new AppCashierModel();

        $cashierModel->setId(B()->onlyIdToInt());

        $cashierModel->setTotalAmount($memberModel->getAmount());

        $cashierModel->setTitle("开通{$memberModel->getName()}");

        $cashierModel->setCreatedId($userId);

        $bindModel = new CashierBindModel();

        $bindModel->setBindType(BindType::OPEN_MEMBER);

        $bindModel->setBindId($orderModel->getId());

        $bindModel->setCreatedId($userId);

        MasterDao::getSQLDB()->beginTransaction();

        try {
            $payService = new PayService();

            $payService->addCashier($cashierModel, $bindModel);

            $orderDao->addOrder($orderModel);

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('提交开通会员失败!');

            return $cashierModel;
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }

    /**
     * 开通会员
     * @param MemberRecordModel $recordModel
     * @throws Exception
     */
    public function openMember(MemberRecordModel $recordModel)
    {
        if (empty($recordModel->getUserId())) throw new Exception('用户id错误!');

        if (empty($recordModel->getMemberId())) throw new Exception('会员id错误!');

        $memberModel = CoreMemberService::getInstance()
            ->getMember($recordModel->getMemberId());

        $recordModel->setMajorId($memberModel->getMajorId());

        try {
            $userMemberModel = $this->getMemberByUM($recordModel->getUserId(), $memberModel->getMajorId());
        } catch (Exception $e) {
            $userMemberModel = null;
        }

        /** @var RecordDao $recordDao */
        $recordDao = RecordDao::getInstance();

        /** @var UserMemberDao $userMemberDao */
        $userMemberDao = UserMemberDao::getInstance();

        $isThingIn = MasterDao::getSQLDB()->isInThing();

        if (!$isThingIn) MasterDao::getSQLDB()->beginTransaction();

        try {
            if ($userMemberModel == null) {
                $userMemberModel = new UserMemberModel();

                $userMemberModel->setUserId($recordModel->getUserId());

                $userMemberModel->setMajorId($memberModel->getMajorId());

                $userMemberModel->setMemberId($memberModel->getId());

                $userMemberModel->setName($memberModel->getName());

                $userMemberModel->setOpenTime(Cal()->getDate());

                $userMemberModel->setEndTime(Cal()->getDate(time() + $memberModel->getValidTime()));

                $userMemberDao->addMember($userMemberModel);
            } else {

                /** @var  int $currentEndTime 当前到期时间（时间戳 ） */
                $currentEndTime = Cal()->dateToTime($userMemberModel->getEndTime());

                if (!$userMemberModel->getIsValid()) {
                    $userMemberModel->setOpenTime(Cal()->getDate());

                    $userMemberModel->setEndTime(Cal()->getDate(time() + $memberModel->getValidTime()));
                } else {
                    $userMemberModel->setEndTime(Cal()->getDate($currentEndTime + $memberModel->getValidTime()));
                }

                $userMemberDao->setMemberTime($userMemberModel);
            }

            $recordModel->setName($memberModel->getName());

            $recordModel->setOpenTime($userMemberModel->getOpenTime());

            $recordModel->setEndTime($userMemberModel->getEndTime());

            $recordDao->addRecord($recordModel);

            if (!$isThingIn && !MasterDao::getSQLDB()->commit()) {
                throw new Exception('开通会员失败!');
            }
        } catch (Exception $e) {
            if (!$isThingIn) MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }

    /**
     * 通过userId+majorId获取会员
     * @param $userId
     * @param $majorId
     * @return MemberWrapper
     * @throws Exception
     */
    public function getMemberByUM($userId, $majorId)
    {
        if (empty($userId)) throw new Exception('用户id 错误!');

        if (empty($majorId)) throw new Exception('专业id 错误!');

        /** @var UserMemberDao $memberDao */
        $memberDao = UserMemberDao::getInstance();

        $memberModel = $memberDao->getMemberByUM($userId, $majorId);

        if ($memberModel == null) throw new Exception('未开通会员!');

        $endTime = Cal()->dateToTime($memberModel->getEndTime());

        $memberModel->setIsValid($endTime > time());

        return $memberModel;
    }
}
