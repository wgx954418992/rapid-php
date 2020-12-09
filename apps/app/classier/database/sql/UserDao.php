<?php


namespace apps\app\classier\database\sql;

use apps\app\classier\model\UserModel;
use Exception;

class UserDao extends BaseDao
{
    /**
     * @var self
     */
    private static $instance;

    /**
     * UserDao constructor.
     */
    public function __construct()
    {
        parent::__construct(UserModel::class);
    }

    /**
     * @return UserDao
     */
    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }

    /**
     * @return mixed|object|void|null
     */
    public function getUsers()
    {
        try {
            return parent::get()
                ->where('is_delete', 0)
                ->getStatement()
                ->fetchAll(UserModel::class);
        } catch (Exception $e) {
            return [];
        }
    }
}