<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppTokenModel;
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
     * @param $bindId
     * @param $type
     * @return bool
     * @throws Exception
     */
    public function addToken($token, $bindId, $type): bool
    {
        return parent::add([
            'token' => $token,
            'bind_id' => $bindId,
            'type' => $type,
            'is_delete' => false,
            'created_id' => $bindId,
            'created_time' => Cal()->getDate(),
        ]);
    }

    /**
     * 删除用户token
     * @param $bindId
     * @param $type
     * @return bool
     * @throws Exception
     */
    public function delToken($bindId, $type = null): bool
    {
        $driver = parent::set([
            'is_delete' => true,
            'updated_id' => $bindId,
            'updated_time' => Cal()->getDate(),
        ])->where('bind_id', $bindId);

        if (!empty($type)) $driver->where('type', $type);

        return $driver->where('is_delete', false)
            ->execute();
    }

    /**
     * 获取token绑定的bindId
     * @param $token
     * @return string|int|mixed|null
     * @throws Exception
     */
    public function getTokenBindId($token)
    {
        return parent::get(['bind_id'])
            ->where('token', $token)
            ->where('is_delete', false)
            ->getStatement()
            ->fetchValue('bind_id');
    }
}