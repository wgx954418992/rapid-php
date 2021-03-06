<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 后台系统route表
 * @table admin_route
 * rapidPHP auto generate Model 2021-01-25 21:19:26
 */
class AdminRouteModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'admin_route';
        
    
    /**
     * 主键
     * @length 
     * @typed bigint
     */
    private $id;    
    
    /**
     * 父id
     * @length 
     * @typed bigint
     */
    private $parent_id;    
    
    /**
     * 名称
     * @length 50
     * @typed varchar
     */
    private $name;    
    
    /**
     * route
     * @length 50
     * @typed varchar
     */
    private $route;    
    
    /**
     * 可选参数
     * @length 
     * @typed json
     */
    private $options;    
    
    /**
     * 类型 1 menu 2 api接口 3 其他
     * @length 
     * @typed tinyint
     */
    private $type;    
    
    /**
     * 备注
     * @length 256
     * @typed varchar
     */
    private $remark;    
    
    /**
     * 排序
     * @length 
     * @typed int
     */
    private $rank;    
    
    /**
     * 是否系统
     * @length 
     * @typed bit
     */
    private $is_system;    
    
    /**
     * 是否删除
     * @length 
     * @typed bit
     */
    private $is_delete;    
    
    /**
     * 创建人Id
     * @length 
     * @typed bigint
     */
    private $created_id;    
    
    /**
     * 创建时间
     * @length 
     * @typed datetime
     */
    private $created_time;    
    
    /**
     * 修改人Id
     * @length 
     * @typed bigint
     */
    private $updated_id;    
    
    /**
     * 修改时间
     * @length 
     * @typed datetime
     */
    private $updated_time;    
    /**
     * 获取 主键
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * 设置 主键
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * 效验 主键
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if(empty($this->id)) throw new Exception($msg);
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
     * 设置 父id
     * @param $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }
    
    /**
     * 效验 父id
     * @param string $msg
     * @throws Exception
     */
    public function validParentId(string $msg = 'parent_id Cannot be empty!')
    {
        if(empty($this->parent_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 名称
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    
    /**
     * 设置 名称
     * @param string|null $name
     */
    public function setName(?string $name)
    {
        $this->name = $name;
    }
    
    /**
     * 效验 名称
     * @param string $msg
     * @throws Exception
     */
    public function validName(string $msg = 'name Cannot be empty!')
    {
        if(empty($this->name)) throw new Exception($msg);
    }
    
    /**
     * 获取 route
     * @return string
     */
    public function getRoute(): ?string
    {
        return $this->route;
    }
    
    /**
     * 设置 route
     * @param string|null $route
     */
    public function setRoute(?string $route)
    {
        $this->route = $route;
    }
    
    /**
     * 效验 route
     * @param string $msg
     * @throws Exception
     */
    public function validRoute(string $msg = 'route Cannot be empty!')
    {
        if(empty($this->route)) throw new Exception($msg);
    }
    
    /**
     * 获取 可选参数
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * 设置 可选参数
     * @param $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }
    
    /**
     * 效验 可选参数
     * @param string $msg
     * @throws Exception
     */
    public function validOptions(string $msg = 'options Cannot be empty!')
    {
        if(empty($this->options)) throw new Exception($msg);
    }
    
    /**
     * 获取 类型 1 menu 2 api接口 3 其他
     * @return int
     */
    public function getType(): ?int
    {
        return $this->type;
    }
    
    /**
     * 设置 类型 1 menu 2 api接口 3 其他
     * @param int|null $type
     */
    public function setType(?int $type)
    {
        $this->type = $type;
    }
    
    /**
     * 效验 类型 1 menu 2 api接口 3 其他
     * @param string $msg
     * @throws Exception
     */
    public function validType(string $msg = 'type Cannot be empty!')
    {
        if(empty($this->type)) throw new Exception($msg);
    }
    
    /**
     * 获取 备注
     * @return string
     */
    public function getRemark(): ?string
    {
        return $this->remark;
    }
    
    /**
     * 设置 备注
     * @param string|null $remark
     */
    public function setRemark(?string $remark)
    {
        $this->remark = $remark;
    }
    
    /**
     * 效验 备注
     * @param string $msg
     * @throws Exception
     */
    public function validRemark(string $msg = 'remark Cannot be empty!')
    {
        if(empty($this->remark)) throw new Exception($msg);
    }
    
    /**
     * 获取 排序
     * @return int
     */
    public function getRank(): ?int
    {
        return $this->rank;
    }
    
    /**
     * 设置 排序
     * @param int|null $rank
     */
    public function setRank(?int $rank)
    {
        $this->rank = $rank;
    }
    
    /**
     * 效验 排序
     * @param string $msg
     * @throws Exception
     */
    public function validRank(string $msg = 'rank Cannot be empty!')
    {
        if(empty($this->rank)) throw new Exception($msg);
    }
    
    /**
     * 获取 是否系统
     * @return bool
     */
    public function getIsSystem(): ?bool
    {
        return $this->is_system;
    }
    
    /**
     * 设置 是否系统
     * @param bool|null $is_system
     */
    public function setIsSystem(?bool $is_system)
    {
        $this->is_system = $is_system;
    }
    
    /**
     * 效验 是否系统
     * @param string $msg
     * @throws Exception
     */
    public function validIsSystem(string $msg = 'is_system Cannot be empty!')
    {
        if(empty($this->is_system)) throw new Exception($msg);
    }
    
    /**
     * 获取 是否删除
     * @return bool
     */
    public function getIsDelete(): ?bool
    {
        return $this->is_delete;
    }
    
    /**
     * 设置 是否删除
     * @param bool|null $is_delete
     */
    public function setIsDelete(?bool $is_delete)
    {
        $this->is_delete = $is_delete;
    }
    
    /**
     * 效验 是否删除
     * @param string $msg
     * @throws Exception
     */
    public function validIsDelete(string $msg = 'is_delete Cannot be empty!')
    {
        if(empty($this->is_delete)) throw new Exception($msg);
    }
    
    /**
     * 获取 创建人Id
     * @return mixed
     */
    public function getCreatedId()
    {
        return $this->created_id;
    }
    
    /**
     * 设置 创建人Id
     * @param $created_id
     */
    public function setCreatedId($created_id)
    {
        $this->created_id = $created_id;
    }
    
    /**
     * 效验 创建人Id
     * @param string $msg
     * @throws Exception
     */
    public function validCreatedId(string $msg = 'created_id Cannot be empty!')
    {
        if(empty($this->created_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 创建时间
     * @return string
     */
    public function getCreatedTime(): ?string
    {
        return $this->created_time;
    }
    
    /**
     * 设置 创建时间
     * @param string|null $created_time
     */
    public function setCreatedTime(?string $created_time)
    {
        $this->created_time = $created_time;
    }
    
    /**
     * 效验 创建时间
     * @param string $msg
     * @throws Exception
     */
    public function validCreatedTime(string $msg = 'created_time Cannot be empty!')
    {
        if(empty($this->created_time)) throw new Exception($msg);
    }
    
    /**
     * 获取 修改人Id
     * @return mixed
     */
    public function getUpdatedId()
    {
        return $this->updated_id;
    }
    
    /**
     * 设置 修改人Id
     * @param $updated_id
     */
    public function setUpdatedId($updated_id)
    {
        $this->updated_id = $updated_id;
    }
    
    /**
     * 效验 修改人Id
     * @param string $msg
     * @throws Exception
     */
    public function validUpdatedId(string $msg = 'updated_id Cannot be empty!')
    {
        if(empty($this->updated_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 修改时间
     * @return string
     */
    public function getUpdatedTime(): ?string
    {
        return $this->updated_time;
    }
    
    /**
     * 设置 修改时间
     * @param string|null $updated_time
     */
    public function setUpdatedTime(?string $updated_time)
    {
        $this->updated_time = $updated_time;
    }
    
    /**
     * 效验 修改时间
     * @param string $msg
     * @throws Exception
     */
    public function validUpdatedTime(string $msg = 'updated_time Cannot be empty!')
    {
        if(empty($this->updated_time)) throw new Exception($msg);
    }
}