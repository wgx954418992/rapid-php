<?php

namespace apps\core\classier\service;

use apps\core\classier\bean\UserListCondition;
use apps\core\classier\dao\master\UserDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\CodeType;
use apps\core\classier\enum\major\Level;
use apps\core\classier\enum\user\Status;
use apps\core\classier\helper\CommonHelper;
use apps\core\classier\model\AppUserModel;
use apps\core\classier\options\UserOptions;
use apps\core\classier\service\user\MemberService as UserMemberService;
use apps\core\classier\wrapper\UserWrapper;
use apps\file\classier\config\FileConfig;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use ReflectionException;
use function rapidPHP\B;
use function rapidPHP\Str;

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
     * 添加或编辑用户信息
     * @param AppUserModel $userModel
     * @return AppUserModel
     * @throws Exception
     */
    public function addedUser(AppUserModel $userModel)
    {
        $telephone = CommonHelper::validTelephone($userModel->getTelephone());

        $userModel->setTelephone($telephone);

        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        $cUserModel = $userModel->getId() ? $userDao->getUser($userModel->getId()) : null;

        if ($cUserModel == null) {
            if (empty($userModel->getPassword()) || strlen($userModel->getPassword()) < 6)
                throw new Exception('密码不能少于6位!');

            if ($userDao->getUserByTel($userModel->getTelephone()) != null)
                throw new Exception('手机号码已经存在!');

            $userModel->setId(B()->onlyIdToInt());

            if (!$userDao->addUser($userModel))
                throw new Exception('添加失败!');
        } else {
            if ($cUserModel->getTelephone() != $userModel->getTelephone()) {
                if ($userDao->getUserByTel($userModel->getTelephone()) != null)
                    throw new Exception('手机号码已经存在!');
            }

            $data = array_filter($userModel->toData(), function ($item) {
                return !empty($item);
            });

            if (!$userDao->setUserByData($userModel->getId(), $data))
                throw new Exception('更新失败!');
        }

        return $userModel;
    }

    /**
     * 通过手机号码获取用户信息
     * @param $telephone
     * @param null $selfUid
     * @param UserOptions|null $options
     * @return AppUserModel|UserWrapper
     * @throws Exception
     */
    public function getUserByTel($telephone, $selfUid = null, ?UserOptions $options = null)
    {
        if (empty($telephone)) throw new Exception('telephone 错误!');

        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        $userModel = $userDao->getUserByTel($telephone);

        if ($userModel == null) throw new Exception('帐号不存在!');

        $this->setUserOptions($userModel, $selfUid, $options);

        return $userModel;
    }


    /**
     * 设置粉丝数量
     * @param $userId
     * @param int $count
     * @param null $actionId
     * @throws Exception
     */
    public function setFollowerCount($userId, int $count = 1, $actionId = null)
    {
        if (empty($userId)) throw new Exception('user id错误!');

        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        if (!$userDao->setFollowerCount($userId, $count, $actionId))
            throw new Exception('设置粉丝数量失败!');
    }

    /**
     * 设置关注数量
     * @param $userId
     * @param int $count
     * @param null $actionId
     * @throws Exception
     */
    public function setFollowingCount($userId, int $count = 1, $actionId = null)
    {
        if (empty($userId)) throw new Exception('user id错误!');

        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        if (!$userDao->setFollowingCount($userId, $count, $actionId))
            throw new Exception('设置关注数量失败!');
    }

    /**
     * 设置状态
     * @param $userId
     * @param Status $status
     * @param null $actionId
     * @throws Exception
     */
    public function setUserStatus($userId, Status $status, $actionId = null)
    {
        if (empty($userId)) throw new Exception('user id错误!');

        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        if (!$userDao->setUserStatus($userId, $status->getRawValue(), $actionId))
            throw new Exception('设置状态失败!');
    }

    /**
     * 设置用户属性
     * @param AppUserModel $currentUserModel
     * @param $data
     * @throws Exception
     */
    public function setProfile(AppUserModel $currentUserModel, $data)
    {
        if (empty($data)) throw new Exception('profile 错误!');

        $profile = [];

        $allowFields = [
            'username',
            'nickname',
            'password',
            'explain',
            'head_fid',
            'gender',
            'birthday',
            'major_id'
        ];

        foreach ($allowFields as $field) {
            if (isset($data[$field])) $profile[$field] = $data[$field];
        }

        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        MasterDao::getSQLDB()->beginTransaction();

        if (isset($profile['username']) && $profile['username'] != $currentUserModel->getUsername()) {
            if (preg_match("/^[a-zA-Z0-9_-]{6,16}$/i", $profile['username']) !== 1) {
                throw new Exception('用户名不合法');
            }

            if ($userDao->existsUsername($profile['username']))
                throw new Exception('用户名已经存在!');
        }

        if (isset($profile['major_id']) && $profile['major_id'] != $currentUserModel->getMajorId()) {
            $specificMajor = MajorService::getInstance()->getSpecificMajor($profile['major_id']);

            if ($specificMajor->getSelf()->getLevel() != Level::MAJOR) throw new Exception('专业级别错误!');

            if ($specificMajor->getTop()->getLevel() != Level::LEVEL_1) throw new Exception('专业级别错误(T)!');

            $profile['top_mid'] = $specificMajor->getTop()->getId();
        }

        try {

            $userDao->setUserByData($currentUserModel->getId(), $profile);

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('设置资料失败!');
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }

    /**
     * 绑定手机
     * @param AppUserModel $currentUserModel
     * @param $telephone
     * @param $code
     * @throws ReflectionException
     * @throws Exception
     */
    public function bindTelephone(AppUserModel $currentUserModel, $telephone, $code)
    {
        if (empty($telephone)) throw new Exception('手机号码不能为空!');

        if (empty($code)) throw new Exception('验证码不能为空!');

        $telephone = CommonHelper::validTelephone($telephone);

        VerifyCodeService::getInstance()
            ->checkCode($telephone, CodeType::i(CodeType::BIND_TELEPHONE), $code);

        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        MasterDao::getSQLDB()->beginTransaction();

        if ($userDao->getUserByTel($telephone))
            throw new Exception('号码已经存在，请换个手机号码绑定，如有疑问，请联系客服处理!');

        try {

            $userDao->setUserByData($currentUserModel->getId(), ['telephone' => $telephone]);

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('设置资料失败!');
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }

    /**
     * 删除用户
     * @param AppUserModel $userModel
     * @throws Exception
     */
    public function delUser(AppUserModel $userModel)
    {
        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        if (!$userDao->delUser($userModel))
            throw new Exception('删除失败！');
    }

    /**
     * 更新用户信息
     * @param UserWrapper|AppUserModel $userModel
     * @throws Exception
     */
    public function setUserOptions(UserWrapper $userModel, $selfUid = null, ?UserOptions $options = null)
    {
        $userModel->setAvatar(FileConfig::getFileUrl($userModel->getHeadFid()));

        $userModel->setAge(CommonHelper::getDateDiffYear($userModel->getBirthday()));

        if (!$options || !$options->then(UserOptions::PRIVATE)) {

            $userModel->setPassword(null);

            $userModel->setSource(null);

            if ($userModel->getTelephone()) {
                $userModel->setTelephone(Str()->hideTel($userModel->getTelephone()));
            }
        }

        if (!$options) return;

        $options
            ->then(UserOptions::FOLLOW, function () use ($userModel, $selfUid) {
                if (empty($selfUid) || $selfUid == $userModel->getId()) return;

                try {
                    $followModel = FollowService::getInstance()->getFollowByFT($selfUid, $userModel->getId());
                } catch (Exception $e) {
                    try {
                        $followModel = FollowService::getInstance()->getFollowByFT($userModel->getId(), $selfUid);
                    } catch (Exception $e) {
                        $followModel = null;
                    }
                }

                $userModel->setFollow($followModel);
            })
            ->then(UserOptions::WALLET, function () use ($userModel) {
                $walletService = new WalletService($userModel->getId());

                $userModel->setWallet($walletService->getPoint());
            })
            ->then(UserOptions::INTEGRAL, function () use ($userModel) {
                $integralService = new IntegralService($userModel->getId());

                $userModel->setIntegral($integralService->getPoint());
            })
            ->then(UserOptions::MAJOR, function () use ($userModel) {
                if (!$userModel->getMajorId()) return;

                $majorModel = MajorService::getInstance()
                    ->getMajor($userModel->getMajorId());

                $userModel->setMajor($majorModel);
            })
            ->then(UserOptions::TOP_MAJOR, function () use ($userModel) {
                if (!$userModel->getTopMid()) return;

                $majorModel = MajorService::getInstance()
                    ->getMajor($userModel->getTopMid());

                $userModel->setTopMajor($majorModel);
            })
            ->then(UserOptions::SPECIFIC_MAJOR, function () use ($userModel) {
                $majorModel = MajorService::getInstance()
                    ->getSpecificMajor($userModel->getMajorId());

                $userModel->setSpecificMajor($majorModel);
            })->then(UserOptions::MEMBER, function () use ($userModel) {

                if (!$userModel->getTopMid()) return;

                $memberModel = UserMemberService::getInstance()
                    ->getMemberByUM($userModel->getId(), $userModel->getTopMid());

                $userModel->setMember($memberModel);
            });
    }


    /**
     * 获取用户列表
     * @param UserListCondition $condition
     * @return array
     * @throws ReflectionException
     * @throws Exception
     */
    public function getUserList(UserListCondition $condition)
    {
        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        $list = $userDao->getUserList($condition);

        foreach ($list as $value) {

            $this->setUserOptions($value, null, $condition->getOptions());
        }

        return $list;
    }

    /**
     * 获取用户列表查询总数量
     * @param UserListCondition $condition
     * @return int
     * @throws ReflectionException
     * @throws Exception
     */
    public function getUserListCount(UserListCondition $condition)
    {
        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        return $userDao->getUserListCount($condition);
    }

    /**
     * 通过userId获取用户信息
     * @param $userId
     * @param null $selfUid
     * @param UserOptions|null $options
     * @return AppUserModel|UserWrapper
     * @throws Exception
     */
    public function getUser($userId, $selfUid = null, ?UserOptions $options = null)
    {
        if (empty($userId)) throw new Exception('id 错误!');

        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        $userModel = $userDao->getUser($userId);

        if ($userModel == null) throw new Exception('帐号不存在!' . $userId);

        $this->setUserOptions($userModel, $selfUid, $options);

        return $userModel;
    }
}
