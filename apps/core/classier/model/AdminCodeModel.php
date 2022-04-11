<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 后台权限code表
 * @table admin_code
 * rapidPHP auto generate Model 2022-04-11 11:39:17
 */

class AdminCodeModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'admin_code';

    
    /**
     * 主键
     * @var 
     * @length 
     * @typed bigint
     */
    protected $id;

    /**
     * 设置 主键
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 获取 主键
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 效验 主键
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if (empty($this->id)) throw new Exception($msg);
    }

    /**
     * 父id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $parent_id;

    /**
     * 设置 父id
     * @param $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }

    /**
     * 获取 父id
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * 效验 父id
     * @param string $msg
     * @throws Exception
     */
    public function validParentId(string $msg = 'parent_id Cannot be empty!')
    {
        if (empty($this->parent_id)) throw new Exception($msg);
    }

    /**
     * 名称
     * @var string|null 
     * @length 50
     * @typed varchar
     */
    protected $name;

    /**
     * 设置 名称
     * @param string|null $name
     */
    public function setName(?string $name)
    {
        $this->name = $name;
    }

    /**
     * 获取 名称
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * 效验 名称
     * @param string $msg
     * @throws Exception
     */
    public function validName(string $msg = 'name Cannot be empty!')
    {
        if (empty($this->name)) throw new Exception($msg);
    }

    /**
     * code
     * @var string|null 
     * @length 100
     * @typed varchar
     */
    protected $code;

    /**
     * 设置 code
     * @param string|null $code
     */
    public function setCode(?string $code)
    {
        $this->code = $code;
    }

    /**
     * 获取 code
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * 效验 code
     * @param string $msg
     * @throws Exception
     */
    public function validCode(string $msg = 'code Cannot be empty!')
    {
        if (empty($this->code)) throw new Exception($msg);
    }

    /**
     * 备注
     * @var string|null 
     * @length 256
     * @typed varchar
     */
    protected $remarks;

    /**
     * 设置 备注
     * @param string|null $remarks
     */
    public function setRemarks(?string $remarks)
    {
        $this->remarks = $remarks;
    }

    /**
     * 获取 备注
     * @return string|null
     */
    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    /**
     * 效验 备注
     * @param string $msg
     * @throws Exception
     */
    public function validRemarks(string $msg = 'remarks Cannot be empty!')
    {
        if (empty($this->remarks)) throw new Exception($msg);
    }

}
