<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\bean\PageListCondition;
use apps\core\classier\bean\RelationshipListCondition;
use apps\core\classier\bean\UserListCondition;
use apps\core\classier\config\SaltConfig;
use apps\core\classier\dao\master\user\FollowDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\follow\Status;
use apps\core\classier\enum\follow\Type;
use apps\core\classier\enum\user\Source;
use apps\core\classier\model\AppUserModel;
use apps\core\classier\wrapper\UserWrapper;
use Exception;
use rapidPHP\modules\common\classier\AR;
use rapidPHP\modules\database\sql\classier\Driver;
use rapidPHP\modules\database\sql\classier\driver\Mysql;
use rapidPHP\modules\reflection\classier\Utils;
use function rapidPHP\Cal;

class UserDao extends MasterDao
{

    /**
     * cache prefix
     */
    public const CACHE_PREFIX = 'user';

    /**
     * UserDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppUserModel::class);
    }

    /**
     * 添加用户
     * @param AppUserModel $userModel
     * @return bool
     * @throws Exception
     */
    public function addUser(AppUserModel $userModel): bool
    {
        $data = [
            'id' => $userModel->getId(),
            'nickname' => $userModel->getNickname(),
            'source' => Source::REGISTER,
            'register_ip' => $userModel->getRegisterIp(),
            'is_delete' => false,
            'created_id' => $userModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        if (!empty($userModel->getUsername())) {
            $data['username'] = $userModel->getUsername();
        }

        if (!empty($userModel->getExplain())) {
            $data['explain'] = $userModel->getExplain();
        }

        if (!empty($userModel->getTelephone())) {
            $data['telephone'] = $userModel->getTelephone();
        }

        if (!empty($userModel->getPassword())) {
            $data['password'] = SaltConfig::getSaltPsw($userModel->getPassword());
        }

        if (!empty($userModel->getHeadFid())) {
            $data['head_fid'] = $userModel->getHeadFid();
        }

        if (!empty($userModel->getBirthday())) {
            $data['birthday'] = $userModel->getBirthday();
        }

        if (!empty($userModel->getRecommendUid())) {
            $data['recommend_uid'] = $userModel->getRecommendUid();
        }

        if (!empty($userModel->getTopMid())) {
            $data['top_mid'] = $userModel->getTopMid();
        }

        if (!empty($userModel->getMajorId())) {
            $data['major_id'] = $userModel->getMajorId();
        }

        $result = parent::add($data);

        if ($result) {
            $this->delCache($this->getCacheId('id', $userModel->getId()));
        }

        return $result;
    }

    /**
     * set 用户
     * @param $id
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function setUserByData($id, array $data): bool
    {
        $data = array_merge([
            'updated_time' => Cal()->getDate(),
        ], $data);

        unset($data['id']);

        $driver = parent::getDriver();

        $result = $driver->update($data)->where('id', $id)->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $id));
        }

        return $result;
    }

    /**
     * 添加用户
     * @param AppUserModel $userModel
     * @return bool
     * @throws Exception
     */
    public function setUser(AppUserModel $userModel): bool
    {
        $driver = parent::getDriver();

        $data = [
            'updated_id' => $userModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ];

        if (!empty($userModel->getPassword())) {
            $data['password'] = SaltConfig::getSaltPsw($userModel->getPassword());
        }

        if (!empty($userModel->getNickname())) {
            $data['nickname'] = $userModel->getNickname();
        }

        if (!empty($userModel->getHeadFid())) {
            $data['head_fid'] = $userModel->getHeadFid();
        }

        if (!empty($userModel->getBirthday())) {
            $data['birthday'] = $userModel->getBirthday();
        }

        if (!empty($userModel->getTopMid())) {
            $data['top_mid'] = $userModel->getTopMid();
        }

        if (!empty($userModel->getMajorId())) {
            $data['major_id'] = $userModel->getMajorId();
        }

        $result = $driver->update($data)
            ->where('id', $userModel->getId())
            ->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $userModel->getId()));
        }

        return $result;
    }

    /**
     * 通过手机号码获取用户信息
     * @param $telephone
     * @return AppUserModel|null
     * @throws Exception
     */
    public function getUserByTel($telephone): ?UserWrapper
    {
        return parent::get()
            ->where('is_delete', false)
            ->where('telephone', $telephone)
            ->getStatement()
            ->fetch(UserWrapper::class);
    }

    /**
     * 用户名是否存在
     * @param $username
     * @return bool
     * @throws Exception
     */
    public function existsUsername($username): bool
    {
        return !empty(parent::get()
            ->where('is_delete', false)
            ->where('username', $username)
            ->getStatement()
            ->fetch());
    }

    /**
     * 获取用户信息
     * @param $id
     * @return UserWrapper|null
     * @throws Exception
     */
    public function getUser($id): ?UserWrapper
    {
        $cacheId = $this->getCacheId('id', $id);

        return parent::getCacheWithCallback($cacheId, function () use ($id) {
            return parent::get()
                ->where('is_delete', false)
                ->where('id', $id)
                ->getStatement()
                ->fetch(UserWrapper::class);
        });
    }

    /**
     * 设置粉丝数量
     * @param $id
     * @param int $count
     * @param null $actionId
     * @return bool
     * @throws Exception
     */
    public function setFollowerCount($id, int $count = 1, $actionId = null): bool
    {
        $result = parent::set([
            'follower_count' => ":\$follower_count+{$count}",
            'updated_id' => $actionId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $id));
        }

        return $result;
    }

    /**
     * 设置关注数量
     * @param $id
     * @param int $count
     * @param null $actionId
     * @return bool
     * @throws Exception
     */
    public function setFollowingCount($id, int $count = 1, $actionId = null): bool
    {
        $result = parent::set([
            'following_count' => ":\$following_count+{$count}",
            'updated_id' => $actionId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $id));
        }

        return $result;
    }

    /**
     * 设置用户状态
     * @param $id
     * @param $status
     * @param $actionId
     * @return bool
     * @throws Exception
     */
    public function setUserStatus($id, $status, $actionId)
    {
        $result = parent::set([
            'status' => $status,
            'updated_id' => $actionId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)
            ->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $id));
        }

        return $result;
    }

    /**
     * 更改密码
     * @param $id
     * @param $password
     * @param $actionId
     * @return bool
     * @throws Exception
     */
    public function setPassword($id, $password, $actionId): bool
    {
        $result = parent::set([
            'password' => SaltConfig::getSaltPsw($password),
            'updated_id' => $actionId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)
            ->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $id));
        }

        return $result;
    }


    /**
     * 删除用户
     * @param AppUserModel $userModel
     * @return bool
     * @throws Exception
     */
    public function delUser(AppUserModel $userModel): bool
    {
        $result = $this->set([
            'is_delete' => true,
            'updated_id' => $userModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $userModel->getId())->execute();

        if ($result) {
            $this->delCache($this->getCacheId($userModel->getId()));
        }

        return $result;
    }

    /**
     * 获取多个用户
     * @param $ids
     * @return UserWrapper[]
     * @throws Exception
     */
    public function getUsersByIds($ids): array
    {
        return (array)parent::get()
            ->where('is_delete', false)
            ->in('id', $ids)
            ->getStatement()
            ->fetchAll(UserWrapper::class);
    }


    /**
     * 获取用户列表查询对象
     * @param UserListCondition $condition
     * @return Driver|Mysql
     * @throws Exception
     */
    private function getUserListSelect(UserListCondition $condition)
    {
        $select = $this->get();

        if (!empty($condition->getKeyword())) {

            $keyName = $select->getOptionsKey('keyword');

            $select->addOptions("%{$condition->getKeyword()}%", $keyName);

            $select->where("(concat(id,ifnull(nickname,''),ifnull(username,''),ifnull(telephone,''))) LIKE :{$keyName} ");
        }

        if ($condition->getIds()) $select->in('id', $condition->getIds());

        if (!empty($condition->getStartTime())) $select->where("created_time", $condition->getStartTime(), '>=:');

        if (!empty($condition->getEndTime())) $select->where("created_time", $condition->getEndTime(), '<:');

        return $select->where('is_delete', false);
    }


    /**
     * 获取用户列表
     * @param UserListCondition $condition
     * @return UserWrapper[]
     * @throws Exception
     */
    public function getUserList(UserListCondition $condition): array
    {
        $select = $this->getUserListSelect($condition);

        $select->limit($condition->getPage(), $condition->getSize());

        return (array)$select->order($condition->getOrderName(), $condition->getOrderType())
            ->getStatement()
            ->fetchAll(UserWrapper::class);
    }

    /**
     * 获取用户列表查询总数量
     * @param UserListCondition $condition
     * @return int
     * @throws Exception
     */
    public function getUserListCount(UserListCondition $condition): int
    {
        $select = $this->getUserListSelect($condition);

        return (int)$select->resetSql('select')
            ->select('count(id) as count')
            ->getStatement()
            ->fetchValue('count');
    }

    /**
     * 获取关系列表
     * @param RelationshipListCondition $condition
     * @return UserWrapper[]
     * @throws Exception
     */
    public function getRelationshipList(RelationshipListCondition $condition): array
    {
        $followFiled = "`follow`.`id` as follow_id,
                    `follow`.`from_id` as follow_from_id,
                    `follow`.`to_id` as follow_to_id,
                    `follow`.`status` as follow_status,
                    `follow`.`apply_time` as follow_apply_time,( 
                        CASE 
                            WHEN `follow`.`id` IS NOT NULL 
                                AND `follow_p`.`id` IS NOT NULL 
                                THEN " . Type::DOUBLE .
            " ELSE " . Type::ONE . " END
            ) AS `follow_type`";

        $driver = parent::getDriver()
            ->select("user.*,{$followFiled},(
                case 
                    when user.nickname != '' then user.nickname 
                else 
                    user.username
                end
            ) as display_name")->alias('user');

        $driver->join(function () use ($driver, $condition) {
            return FollowDao::getInstance()
                ->getFollowDriver('follow', 'follow_p', true, null, function ($driver) use ($condition) {
                    $driver->on('follow.status', Status::RELATION);

                    switch ($condition->getMode()) {
                        case RelationshipListCondition::MODE_FOLLOW:
                            $driver
                                ->on('follow.from_id', $condition->getUserId())
                                ->on('`user`.`id`=`follow`.`to_id`');
                            break;
                        case RelationshipListCondition::MODE_FANS:
                            $driver
                                ->on('follow.to_id', $condition->getUserId())
                                ->on('`user`.`id`=`follow`.`from_id`');
                            break;
                    }
                });
        });


        if (in_array(Type::DOUBLE, $condition->getType()) && in_array(Type::ONE, $condition->getType())) {
            $driver->where('follow.id IS NOT NULL OR follow_p.id IS NOT NULL');
        } else if (in_array(Type::DOUBLE, $condition->getType())) {
            $driver->where('follow.id IS NOT NULL AND follow_p.id IS NOT NULL');
        } else if (in_array(Type::ONE, $condition->getType())) {
            $driver->where('follow.id IS NOT NULL AND follow_p.id IS NULL');
        }

        if (!empty($condition->getKeyword())) {

            $keyName = $driver->getOptionsKey('keyword');

            $driver->addOptions("%{$condition->getKeyword()}%", $keyName);

            $driver->where("(concat(follow.id,follow.from_id,follow.to_id,display_name)) LIKE :{$keyName} ");
        }

        if ($condition->getIds()) $driver->in('follow.id', $condition->getIds());

        if (!empty($condition->getStartTime())) $driver->where("follow.apply_time", $condition->getStartTime(), '>=:');

        if (!empty($condition->getEndTime())) $driver->where("follow.apply_time", $condition->getEndTime(), '<:');

        $result = (array)$driver
            ->where('user.is_delete', false)
            ->limit($condition->getPage(), $condition->getSize())
            ->order('follow.apply_time', $condition->getOrderType())
            ->getStatement()
            ->fetchAll();

        if (empty($result)) return $result;

        $followFiledList = [
            'follow_id' => 'id',
            'follow_from_id' => 'from_id',
            'follow_to_id' => 'to_id',
            'follow_status' => 'status',
            'follow_apply_time' => 'apply_time',
            'follow_type' => 'type',
        ];

        foreach ($result as $index => $value) {

            $follow = AR::getInstance()->rename(AR::getInstance()->getArray($value, array_keys($followFiledList)), $followFiledList);

            $value = AR::getInstance()->delete($value, array_keys($followFiledList));

            $value['follow'] = $follow;

            $result[$index] = $value;
        }

        Utils::getInstance()->toObjects(UserWrapper::class, $result);

        return $result;
    }

}
