<?php

namespace apps\core\classier\dao\master\user;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\follow\Status;
use apps\core\classier\enum\follow\Type;
use apps\core\classier\model\UserFollowModel;
use apps\core\classier\wrapper\user\FollowWrapper;
use Exception;
use rapidPHP\modules\database\sql\classier\Driver;
use rapidPHP\modules\database\sql\classier\driver\Mysql;
use function rapidPHP\Cal;

class FollowDao extends MasterDao
{

    /**
     * cache prefix
     */
    public const CACHE_PREFIX = 'user_follow';

    /**
     * FollowDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(UserFollowModel::class);
    }

    /**
     * 获取缓存id
     * @param $fromId
     * @param $toId
     * @return string
     */
    public function getCacheIdByFT($fromId, $toId): string
    {
        return $this->getCacheId('from_to', $fromId, $toId);
    }

    /**
     * 添加关注
     * @param UserFollowModel $followModel
     * @return bool
     * @throws Exception
     */
    public function addFollow(UserFollowModel $followModel): bool
    {
        $result = parent::add([
            'from_id' => $followModel->getFromId(),
            'to_id' => $followModel->getToId(),
            'status' => $followModel->getStatus(),
            'apply_time' => Cal()->getDate(),
        ], $inserId);

        if ($result) {
            $followModel->setId($inserId);

            $this->delCache($this->getCacheIdByFT($followModel->getFromId(), $followModel->getToId()));

            $this->delCache($this->getCacheIdByFT($followModel->getToId(), $followModel->getFromId()));
        }

        return $result;
    }

    /**
     * 设置关注状态
     * @param UserFollowModel $followModel
     * @return bool
     * @throws Exception
     */
    public function setFollowStatus(UserFollowModel $followModel): bool
    {
        $result = parent::set(['status' => $followModel->getStatus()])
            ->where('id', $followModel->getId())
            ->execute();

        if ($result) {
            $this->delCache($this->getCacheIdByFT($followModel->getFromId(), $followModel->getToId()));

            $this->delCache($this->getCacheIdByFT($followModel->getToId(), $followModel->getFromId()));
        }

        return $result;
    }

    /**
     * 删除关注
     * @param UserFollowModel $followModel
     * @return bool
     * @throws Exception
     */
    public function delFollow(UserFollowModel $followModel): bool
    {
        $result = parent::del()
            ->where('id', $followModel->getId())
            ->execute();

        if ($result) {
            $this->delCache($this->getCacheIdByFT($followModel->getFromId(), $followModel->getToId()));

            $this->delCache($this->getCacheIdByFT($followModel->getToId(), $followModel->getFromId()));
        }

        return $result;
    }

    /**
     * 获取关注驱动
     * @param string $asSelf
     * @param string $asParty
     * @param bool $isJoin
     * @param null $filed
     * @param callable|null $call
     * @return Driver|Mysql
     * @throws Exception
     */
    public function getFollowDriver(string $asSelf = 'f', string $asParty = 'p', bool $isJoin = false, $filed = null, ?callable $call = null)
    {
        $driver = parent::getDriver();

        if (!$isJoin) {
            if (!$filed) {
                $driver->select("
                    `{$asSelf}`.`id`,
                    `{$asSelf}`.`from_id`,
                    `{$asSelf}`.`to_id`,
                    `{$asSelf}`.`status`,
                    `{$asSelf}`.`apply_time`,( 
                        CASE 
                            WHEN `{$asSelf}`.`id` IS NOT NULL 
                                AND `{$asParty}`.`id` IS NOT NULL 
                                THEN " . Type::DOUBLE .
                    " ELSE " . Type::ONE . " END) AS `type`");
            } else {
                $driver->select($filed);
            }
        }

        $driver->alias($asSelf);

        if (is_callable($call)) {
            $call($driver);
        }

        $driver->leftJoin(function () use ($asSelf, $asParty) {
            return $this->getDriver()
                ->alias($asParty)
                ->on("`{$asParty}`.`from_id`=`{$asSelf}`.`to_id`")
                ->on("`{$asParty}`.`to_id`=`{$asSelf}`.`from_id`")
                ->on("{$asParty}.status", Status::RELATION);
        });

        return $driver;
    }


    /**
     * 获取关注信息
     * @param $fromId
     * @param $toId
     * @return FollowWrapper|null
     * @throws Exception
     */
    public function getFollowByFT($fromId, $toId): ?FollowWrapper
    {
        $cacheId = $this->getCacheIdByFT($fromId, $toId);

        return parent::getCacheWithCallback($cacheId, function () use ($fromId, $toId) {
            return $this->getFollowDriver()
                ->where('f.from_id', $fromId)
                ->where('f.to_id', $toId)
                ->forUpdate()
                ->getStatement()
                ->fetch(FollowWrapper::class);
        });
    }

    /**
     * 获取关注信息
     * @param $id
     * @return FollowWrapper|null
     * @throws Exception
     */
    public function getFollow($id): ?FollowWrapper
    {
        return $this->getFollowDriver()
            ->where('f.id', $id)
            ->getStatement()
            ->fetch(FollowWrapper::class);
    }

    /**
     * 获取关注数量
     * @param $fromId
     * @param $type
     * @return int
     * @throws Exception
     */
    public function getFollowCount($fromId, $type): int
    {
        return (int)parent::getDriver()
            ->select('count(id) as count', function () use ($fromId, $type) {
                $driver = $this->getFollowDriver()
                    ->where('f.from_id', $fromId);

                switch ($type) {
                    case Type::ONE:
                        $driver->where("`f`.`id` IS NOT NULL AND `p`.`id` IS NULL");
                        break;
                    case Type::DOUBLE:
                        $driver->where("`f`.`id` IS NOT NULL AND `p`.`id` IS NOT NULL");
                        break;
                }

                return $driver;
            })
            ->alias('ct')
            ->getStatement()
            ->fetchValue('count');
    }

}
