<?php

namespace apps\app\classier\service;


use apps\core\classier\config\BaseConfig;
use apps\core\classier\dao\master\user\WeixinDao;
use apps\core\classier\dao\master\UserDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppUserModel;
use apps\core\classier\model\UserWeixinModel;
use apps\core\classier\service\AreaService;
use apps\core\classier\service\FileService;
use apps\core\classier\service\SettingService;
use apps\core\classier\service\UserService as CoreUserService;
use apps\core\classier\wrapper\UserWrapper;
use Exception;
use rapidPHP\modules\common\classier\Http;
use rapidPHP\modules\common\classier\Instances;
use function rapidPHP\B;

class UserService
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
     * 获取 UserModel
     * @param UserWeixinModel $WXUserModel
     * @param $ip
     * @param false $isAdd
     * @return AppUserModel|UserWrapper
     * @throws Exception
     */
    private function getUserModel(UserWeixinModel $WXUserModel, $ip, &$isAdd = false)
    {
        /** @var WeixinDao $WXDao */
        $WXDao = WeixinDao::getInstance();

        $currentWXUserModel = $WXDao->getWXUserByUnionId($WXUserModel->getUnionId());

        if ($currentWXUserModel == null) {
            $userId = B()->onlyIdToInt();

            $WXUserModel->setUserId($userId);

            $WXUserModel->setCreatedId($userId);

            if (!$WXDao->addWXUser($WXUserModel)) throw new Exception('添加 wx user 失败!');

            $userModel = new AppUserModel();

            $userModel->setId($userId);

            $userModel->setRegisterIp($ip);

            $isAdd = true;
        } else {
            $WXUserModel->setId($currentWXUserModel->getId());

            /** @var UserDao $userDao */
            $userDao = UserDao::getInstance();

            $userModel = $userDao->getUser($currentWXUserModel->getUserId());

            if ($userModel != null) {
                $userId = $userModel->getId();

                $WXUserModel->setUserId($userId);
            } else {
                $userId = B()->onlyIdToInt();

                $userModel = new AppUserModel();

                $userModel->setId($userId);

                $userModel->setRegisterIp($ip);

                $WXUserModel->setUserId($userId);

                $isAdd = true;
            }

            $WXUserModel->setUpdatedId($userId);

            if (!$WXDao->setWXUser($WXUserModel)) throw new Exception('修改 wx user 失败!');
        }

        $headFid = $this->getHeadFid($currentWXUserModel, $WXUserModel);

        if ($headFid) $userModel->setHeadFid($headFid);

        return $userModel;
    }

    /**
     * 获取headFid
     * @param UserWeixinModel|null $currentWXUserModel
     * @param UserWeixinModel $WXUserModel
     * @return mixed|null
     * @throws Exception
     */
    private function getHeadFid(?UserWeixinModel $currentWXUserModel, UserWeixinModel $WXUserModel)
    {
        $currentHeadImgUrl = $currentWXUserModel ? $currentWXUserModel->getHeadimgurl() : null;

        $headImgUrl = $WXUserModel->getHeadimgurl();

        if ($headImgUrl && $currentHeadImgUrl != $headImgUrl) {
            $data = Http::getInstance()->getHttpResponse($headImgUrl);

            $path = SettingService::getStoragePath(md5($WXUserModel->getId()));

            if (!file_put_contents($path, $data)) throw new Exception('写入头像错误!');

            $fileService = new FileService();

            $fileModel = $fileService->addFile($WXUserModel->getId(), $path, $WXUserModel->getId());

            return $fileModel->getId();
        }


        return null;
    }

    /**
     * 小程序登录
     * @param UserWeixinModel $WXUserModel
     * @param $ip
     * @param $userAgent
     * @return string
     * @throws Exception
     */
    public function loginByMini(UserWeixinModel $WXUserModel, $ip, $userAgent): string
    {
        if (empty($WXUserModel->getOpenId())) throw new Exception('openId 错误!');

        if (empty($WXUserModel->getUnionId())) throw new Exception('unionId 错误!');

        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        MasterDao::getSQLDB()->beginTransaction();

        try {
            $userModel = $this->getUserModel($WXUserModel, $ip, $isAdd);

            $userModel->setNickname($WXUserModel->getNickname());

            $userModel->setGender($WXUserModel->getGender());

            if ($isAdd) {
                $userModel->setCreatedId($userModel->getId());

                $userDao->addUser($userModel);
            } else {
                $userModel->setUpdatedId($userModel->getId());

                $userDao->setUser($userModel);
            }

            $token = CoreUserService::getInstance()
                ->login($userModel->getId(), BaseConfig::LOGIN_MODE_MINI, $ip, $userAgent);

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('添加小程序用户失败');

            return $token;
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }
}