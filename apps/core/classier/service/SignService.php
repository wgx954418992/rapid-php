<?php

namespace apps\core\classier\service;

use apps\core\classier\bean\SignListCondition;
use apps\core\classier\dao\master\SignDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\setting\attribute\point\IntegralRule;
use apps\core\classier\model\AppSignModel;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use function rapidPHP\Cal;

class SignService
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
     * 是否已经签到过了
     * @param AppSignModel $signModel
     * @return bool
     * @throws Exception
     */
    public function checkSign(AppSignModel $signModel): bool
    {
        if (empty($signModel->getUserId())) throw new Exception('user id error!');

        if (!$signModel->getYmd()) {
            $signModel->setYmd(Cal()->getDate(time(), 'Y-m-d'));
        }

        /** @var SignDao $signDao */
        $signDao = SignDao::getInstance();

        return $signDao->checkSign($signModel->getUserId(), $signModel->getYmd());
    }

    /**
     * 签到
     * @param AppSignModel $signModel
     * @throws Exception
     */
    public function addSign(AppSignModel $signModel)
    {
        if (empty($signModel->getUserId())) throw new Exception('user id error!');

        if (!$signModel->getYmd()) {
            $signModel->setYmd(Cal()->getDate(time(), 'Y-m-d'));
        }

        /** @var SignDao $signDao */
        $signDao = SignDao::getInstance();

        if ($this->checkSign($signModel)) throw new Exception('今日已经签到过了哦!');

        MasterDao::getSQLDB()->beginTransaction();

        try {
            $signDao->addSign($signModel);

            IntegralService::setPointByIU($signModel->getUserId(), IntegralRule::i(IntegralRule::SIGN));

            if (!MasterDao::getSQLDB()->commit())
                throw new Exception('签到失败!');
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }

    /**
     * 获取签到列表
     * @param SignListCondition $condition
     * @return AppSignModel[]
     * @throws Exception
     */
    public function getSignList(SignListCondition $condition): array
    {
        /** @var SignDao $signDao */
        $signDao = SignDao::getInstance();

        return $signDao->getSignList($condition);
    }
}
