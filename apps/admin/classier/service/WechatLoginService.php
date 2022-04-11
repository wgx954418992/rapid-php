<?php

namespace apps\admin\classier\service;

use apps\admin\classier\dao\master\AdminDao;
use apps\admin\classier\enum\admin\Type;
use apps\core\classier\dao\master\oauth2\OAuth2DaoInterface;
use apps\core\classier\dao\master\oauth2\WeChatDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\LoginType;
use apps\core\classier\model\AppAdminModel;
use apps\core\classier\model\AppFileModel;
use apps\core\classier\model\AppUserModel;
use apps\core\classier\model\OAuth2ModelInterface;
use apps\core\classier\model\OAuth2WeChatInterface;
use apps\core\classier\service\LoginService as CoreLoginService;
use apps\file\classier\service\IFileManagerService;
use Exception;
use rapidPHP\modules\common\classier\Http;
use rapidPHP\modules\common\classier\Instances;
use function rapidPHP\B;
use function rapidPHP\DI;

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
     * @return AppAdminModel
     * @throws Exception
     */
    private function getAdminModel(
        OAuth2DaoInterface   $dao,
        OAuth2ModelInterface $oauth2UserModel,
        ?callable            $onAddBlock = null,
        callable             $onUpdateBlock = null)
    {

//        $currentOAuth2UserModel = $dao->getOAuth2UserByUnionId($oauth2UserModel->getUnionId());
        $currentOAuth2UserModel = $dao->getOAuth2UserByOpenId($oauth2UserModel->getOpenId());

        if ($currentOAuth2UserModel == null) {
            $bindId = B()->onlyIdToInt();

            $oauth2UserModel->setBindId($bindId);

            $oauth2UserModel->setCreatedId($bindId);

            if (!$dao->addOAuth2User($oauth2UserModel)) throw new Exception('添加 oauth2 user 失败!');

            $adminModel = new AppAdminModel();

            $adminModel->setId($bindId);

            if (is_callable($onAddBlock)) $onAddBlock($adminModel);
        } else {
            $oauth2UserModel->setId($currentOAuth2UserModel->getId());

            /** @var AdminDao $adminDao */
            $adminDao = AdminDao::getInstance();

            $adminModel = $adminDao->getAdmin($currentOAuth2UserModel->getBindId());

            if ($adminModel != null) {
                $bindId = $adminModel->getId();

                $oauth2UserModel->setBindId($bindId);

                if (is_callable($onUpdateBlock)) $onUpdateBlock($adminModel);
            } else {
                $bindId = B()->onlyIdToInt();

                $adminModel = new AppAdminModel();

                $adminModel->setId($bindId);

                $oauth2UserModel->setBindId($bindId);

                if (is_callable($onAddBlock)) $onAddBlock($adminModel);
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

            $adminModel->setHeadFid($fileModel->getId());
        }

        return $adminModel;
    }

    /**
     * 通过微信登录 小程序\h5\开放平台
     * @param OAuth2WeChatInterface $WXUserModel
     * @param LoginType $loginType
     * @param $ip
     * @param $userAgent
     * @return string
     * @throws Exception
     */
    public function loginByWechat(OAuth2WeChatInterface $WXUserModel, LoginType $loginType, $ip, $userAgent): string
    {
        if (empty($WXUserModel->getOpenId())) throw new Exception('openId 错误!');

//        if (empty($WXUserModel->getUnionId())) throw new Exception('unionId 错误!');

        /** @var AdminDao $adminDao */
        $adminDao = AdminDao::getInstance();

        MasterDao::getSQLDB()->beginTransaction();

        try {
            $isAdd = false;

            $adminModel = $this->getAdminModel(WeChatDao::getInstance(), $WXUserModel, function (AppAdminModel $adminModel) use ($adminDao, $ip, $WXUserModel, &$isAdd) {
                if (empty($WXUserModel->getNickname())) {
                    $adminModel->setNickname('微信用户');
                } else {
                    $adminModel->setNickname($WXUserModel->getNickname());
                }

                $adminModel->setUsername(B()->randoms(10));

                $adminModel->setParentId(92880526032);

                $adminModel->setCreatedId($adminModel->getId());

                $adminModel->setType(Type::WEB);

                $adminModel->setIsSupreme(false);

                $isAdd = true;
            }, function (AppAdminModel $adminModel) use ($WXUserModel, $adminDao, &$isAdd) {
                if (!empty($WXUserModel->getNickname())) {
                    $adminModel->setNickname($WXUserModel->getNickname());
                }

                $adminModel->setUpdatedId($adminModel->getId());

                $isAdd = false;
            });

            if ($isAdd) {

                $adminDao->addAdmin($adminModel);
            } else {
                $adminDao->setAdmin($adminModel);
            }

            $token = CoreLoginService::getInstance()
                ->login($adminModel->getId(),
                    $loginType,
                    $ip,
                    $userAgent
                );

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('登录失败');

            return $token;
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }
}
