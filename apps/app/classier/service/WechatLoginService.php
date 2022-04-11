<?php

namespace apps\app\classier\service;

use apps\core\classier\dao\master\oauth2\OAuth2DaoInterface;
use apps\core\classier\dao\master\oauth2\WeChatDao;
use apps\core\classier\dao\master\UserDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\LoginType;
use apps\core\classier\enum\setting\attribute\point\IntegralRule;
use apps\core\classier\model\AppFileModel;
use apps\core\classier\model\AppUserModel;
use apps\core\classier\model\OAuth2ModelInterface;
use apps\core\classier\model\OAuth2WeChatInterface;
use apps\core\classier\service\IntegralService;
use apps\core\classier\service\LoginService as CoreLoginService;
use apps\file\classier\service\IFileManagerService;
use Exception;
use rapidPHP\modules\common\classier\Http;
use rapidPHP\modules\common\classier\Instances;
use ReflectionException;
use function rapidPHP\B;
use function rapidPHP\DI;
use function rapidPHP\Str;

class WechatLoginService
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
     * @param OAuth2DaoInterface $dao
     * @param OAuth2ModelInterface $oauth2UserModel
     * @param callable|null $onAddBlock
     * @param callable|null $onUpdateBlock
     * @return AppUserModel
     * @throws Exception
     */
    private function getUserModel(
        OAuth2DaoInterface   $dao,
        OAuth2ModelInterface $oauth2UserModel,
        ?callable            $onAddBlock = null,
        callable             $onUpdateBlock = null)
    {

        $currentOAuth2UserModel = $dao->getOAuth2UserByUnionId($oauth2UserModel->getUnionId());

        if ($currentOAuth2UserModel == null) {
            $bindId = B()->onlyIdToInt();

            $oauth2UserModel->setBindId($bindId);

            $oauth2UserModel->setCreatedId($bindId);

            if (!$dao->addOAuth2User($oauth2UserModel)) throw new Exception('添加 oauth2 user 失败!');

            $userModel = new AppUserModel();

            $userModel->setId($bindId);

            if (is_callable($onAddBlock)) $onAddBlock($userModel);
        } else {
            $oauth2UserModel->setId($currentOAuth2UserModel->getId());

            /** @var UserDao $userDao */
            $userDao = UserDao::getInstance();

            $userModel = $userDao->getUser($currentOAuth2UserModel->getBindId());

            if ($userModel != null) {
                $bindId = $userModel->getId();

                $oauth2UserModel->setBindId($bindId);

                if (is_callable($onUpdateBlock)) $onUpdateBlock($userModel);
            } else {
                $bindId = B()->onlyIdToInt();

                $userModel = new AppUserModel();

                $userModel->setId($bindId);

                $oauth2UserModel->setBindId($bindId);

                if (is_callable($onAddBlock)) $onAddBlock($userModel);
            }

            $oauth2UserModel->setUpdatedId($bindId);

            if (!$dao->setOAuth2User($oauth2UserModel)) throw new Exception('修改 oauth2 user 失败!');
        }

        $currentAvatarUrl = $currentOAuth2UserModel ? $currentOAuth2UserModel->getHeadimgurl() : null;

        $avatarUrl = $oauth2UserModel->getHeadimgurl();

        if ($avatarUrl && $currentAvatarUrl != $avatarUrl) {
            $avatarData = Http::getInstance()->getHttpResponse($avatarUrl);

            $avatarPath = PATH_RUNTIME . 'data/wechat/avatar/' . md5($avatarData);

            if (!is_dir(dirname($avatarPath)) && !mkdir(dirname($avatarPath), 0777, true)) {
                throw new Exception(dirname($avatarPath) . '创建目录失败!');
            }

            if (!file_put_contents($avatarPath, $avatarData)) throw new Exception('写入头像错误!' . $avatarPath);

            /** @var IFileManagerService $fileManagerService */
            $fileManagerService = DI(IFileManagerService::class);

            $fileModel = new AppFileModel();

            $fileModel->setPath($avatarPath);

            $fileModel->setName($oauth2UserModel->getId());

            $fileModel->setCreatedId($oauth2UserModel->getId());

            $fileModel->setUpdatedId($oauth2UserModel->getId());

            $fileModel = $fileManagerService->upload($fileModel);

            if (is_file($avatarPath)) unlink($avatarPath);

            $userModel->setHeadFid($fileModel->getId());
        }

        return $userModel;
    }

    /**
     * 通过微信登录 小程序\h5\开放平台
     * @param OAuth2WeChatInterface $wechatModel
     * @param LoginType $loginType
     * @param $ip
     * @param $userAgent
     * @param null $recommendUid
     * @return string
     * @throws ReflectionException
     * @throws Exception
     */
    public function loginByWechat(OAuth2WeChatInterface $wechatModel, LoginType $loginType, $ip, $userAgent, $recommendUid = null): string
    {
        if (empty($wechatModel->getOpenId())) throw new Exception('openId 错误!');

        if (empty($wechatModel->getUnionId())) throw new Exception('unionId 错误!');

        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        $recommendUserModel = $recommendUid ? $userDao->getUser($recommendUid) : null;

        MasterDao::getSQLDB()->beginTransaction();

        try {
            $isAdd = false;

            $userModel = $this->getUserModel(WeChatDao::getInstance(), $wechatModel, function (AppUserModel $userModel) use ($recommendUserModel, $userDao, $recommendUid, $ip, $wechatModel, &$isAdd) {
                $userModel->setNickname($wechatModel->getNickname());

                $userModel->setUsername(B()->randoms(10));

                $userModel->setGender($wechatModel->getGender());

                $userModel->setRegisterIp($ip);

                if ($recommendUserModel) {
                    $userModel->setRecommendUid($recommendUserModel->getId());
                }

                $userModel->setCreatedId($userModel->getId());

                $isAdd = true;
            }, function (AppUserModel $userModel) use ($wechatModel, $userDao, &$isAdd) {
                $userModel->setNickname($wechatModel->getNickname());

                $userModel->setGender($wechatModel->getGender());

                $userModel->setUpdatedId($userModel->getId());

                $isAdd = false;
            });

            if ($isAdd) {

                $userDao->addUser($userModel);

                IntegralService::setPointByIU($userModel->getId(), IntegralRule::i(IntegralRule::REGISTER));

                try {
                    if ($recommendUserModel) {

                        $integral = IntegralRule::i(IntegralRule::INVITE_REGISTER);

                        $displayName = !empty($userModel->getNickname()) ? $userModel->getNickname() : $userModel->getUsername();

                        $integral->setText('邀请用户' . Str()->hideName($displayName));

                        IntegralService::setPointByIU($recommendUserModel->getId(), $integral);
                    }
                } catch (Exception $e) {
                    BaseService::getInstance()->addLog('wechat login recommend', $e);
                }
            } else {
                $userDao->setUser($userModel);
            }

            $token = CoreLoginService::getInstance()
                ->login($userModel->getId(),
                    $loginType,
                    $ip,
                    $userAgent);

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('添加小程序用户失败');

            return $token;
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }
}
