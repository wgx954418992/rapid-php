<?php

namespace apps\core\classier\bean;

class ResourceListCondition extends BaseListCondition
{

    /**
     * pager
     */
    use PageListCondition;

    /**
     * 绑定id
     * @var int|null
     */
    protected $bind_id;

    /**
     * 绑定类型
     * @var int[]|null
     */
    protected $bind_type;

    /**
     * 所有者
     * @var int|null
     */
    protected $owner_id;

    /**
     * 指定文件类型
     * @var int[]|null
     */
    protected $file_type;

    /**
     * @return int|null
     */
    public function getBindId(): ?int
    {
        return $this->bind_id;
    }

    /**
     * @param int|null $bind_id
     */
    public function setBindId(?int $bind_id): void
    {
        $this->bind_id = $bind_id;
    }

    /**
     * @return int[]|null
     */
    public function getBindType(): ?array
    {
        return $this->bind_type;
    }

    /**
     * @param string|array|null $bind_type
     */
    public function setBindType($bind_type): void
    {
        if (!empty($bind_type)) {
            if (is_string($bind_type)) {
                $bind_type = explode(',', $bind_type);
            } else if (is_numeric($bind_type)) {
                $bind_type = [$bind_type];
            }
        } else {
            $bind_type = null;
        }

        $this->bind_type = $bind_type;
    }

    /**
     * @return int|null
     */
    public function getOwnerId(): ?int
    {
        return $this->owner_id;
    }

    /**
     * @param int|null $owner_id
     */
    public function setOwnerId(?int $owner_id): void
    {
        $this->owner_id = $owner_id;
    }

    /**
     * @return int[]|null
     */
    public function getFileType(): ?array
    {
        return $this->file_type;
    }

    /**
     * @param string|array|null $file_type
     */
    public function setFileType($file_type): void
    {
        $this->file_type = $this->parseArray($file_type);
    }

}
