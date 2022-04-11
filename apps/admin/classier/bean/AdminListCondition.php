<?php


namespace apps\admin\classier\bean;


use apps\admin\classier\options\AdminOptions;
use apps\core\classier\bean\BaseListCondition;
use apps\core\classier\bean\PageListCondition;

class AdminListCondition extends BaseListCondition
{

    /**
     * page
     */
    use PageListCondition;

    /**
     * @var string|int|null
     */
    protected $admin_id;

    /**
     * 管理员类型
     * @var int|null
     */
    protected $type;

    /**
     * 管理员类型
     * @var AdminOptions|null
     */
    protected $options;

    /**
     * @return int|string|null
     */
    public function getAdminId()
    {
        return $this->admin_id;
    }

    /**
     * @param int|string|null $admin_id
     */
    public function setAdminId($admin_id): void
    {
        $this->admin_id = $admin_id;
    }

    /**
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int|null $type
     */
    public function setType(?int $type): void
    {
        $this->type = $type;
    }


    /**
     * @param int|null $options
     */
    public function setOptions(?int $options): void
    {
        if (is_int($options)) {
            $this->options = AdminOptions::i($options);
        }else{
            $this->options = null;
        }
    }

    /**
     * @return AdminOptions|null
     */
    public function getOptions(): ?AdminOptions
    {
        return $this->options;
    }

}
