<?php

namespace apps\app\classier\dao\master;

use apps\app\classier\dao\MasterDao;
use apps\app\classier\model\AppTokenModel;
use Exception;
use function rapidPHP\Cal;

class TokenDao extends MasterDao
{

    /**
     * TokenDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppTokenModel::class);
    }

    /**
     * 添加token
     * @param $token
     * @param $userId
     * @param $type
     * @return bool
     * @throws Exception
     */
    public function addToken($token, $userId, $type): bool
    {
        return parent::add([
            'token' => $token,
            'bind_id' => $userId,
            'type' => $type,
            'is_delete' => 0,
            'created_id' => $userId,
            'created_time' => Cal()->getDate(),
        ]);
    }


    /**
     * 删除用户token
     * @param $userId
     * @param $type
     * @return bool
     * @throws Exception
     */
    public function delUserToken($userId, $type = null): bool
    {
        $update = parent::set([
            'is_delete' => 1,
            'updated_id' => $userId,
            'updated_time' => Cal()->getDate(),
        ])->where('bind_id', $userId);

        if (!empty($type)) $update->where('type', $type);

        return $update->where('is_delete', 0)
            ->execute();
    }

    /**
     * 获取token绑定的userId
     * @param $token
     * @return string|int|mixed|null
     * @throws Exception
     */
    public function getTokenBindId($token)
    {
        return parent::get(['bind_id'])
            ->where('token', $token)
            ->where('is_delete', 0)
            ->getStatement()
            ->fetchValue('bind_id');
    }
}