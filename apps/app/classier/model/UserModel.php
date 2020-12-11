<?php


namespace apps\app\classier\model;


use rapidPHP\modules\core\classier\Model;

class UserModel extends Model
{

    /**
     * 对应的表名字
     */
    const NAME = 'app_user';

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $is_delete;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getIsDelete(): int
    {
        return $this->is_delete;
    }

    /**
     * @param int $is_delete
     */
    public function setIsDelete(int $is_delete): void
    {
        $this->is_delete = $is_delete;
    }
}