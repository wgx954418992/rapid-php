<?php

namespace apps\app\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 作品表
 * @table app_work
 * rapidPHP auto generate Model 2020-12-13 00:03:18
 */
class AppWorkModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'app_work';
        
    
    /**
     * 主键
     * @length 
     * @typed bigint
     */
    public $id;    
    
    /**
     * 用户id
     * @length 
     * @typed bigint
     */
    public $user_id;    
    
    /**
     * 合集id
     * @length 
     * @typed bigint
     */
    public $wrapper_id;    
    
    /**
     * 标题
     * @length 255
     * @typed varchar
     */
    public $title;    
    
    /**
     * 类型 1 图片 2 视频
     * @length 
     * @typed tinyint
     */
    public $type;    
    
    /**
     * 点赞总数
     * @length 
     * @typed int
     */
    public $like_count;    
    
    /**
     * 收藏数量
     * @length 
     * @typed int
     */
    public $collection_count;    
    
    /**
     * 评论数量
     * @length 
     * @typed int
     */
    public $comment_count;    
    
    /**
     * 转发数量
     * @length 
     * @typed int
     */
    public $forward_count;    
    
    /**
     * 分享数量
     * @length 
     * @typed int
     */
    public $share_count;    
    
    /**
     * 账户隐私类型 1 公开，2私密，3 好友可见
     * @length 
     * @typed tinyint
     */
    public $privacy_type;    
    
    /**
     * 地点id
     * @length 
     * @typed bigint
     */
    public $place_id;    
    
    /**
     * 定位
     * @length 
     * @typed point
     */
    public $location;    
    
    /**
     * 作品标签id
     * @length 
     * @typed bigint
     */
    public $tag_id;    
    
    /**
     * 是否删除
     * @length 
     * @typed bit
     */
    public $is_delete;    
    
    /**
     * 创建人Id
     * @length 
     * @typed bigint
     */
    public $created_id;    
    
    /**
     * 创建时间
     * @length 
     * @typed datetime
     */
    public $created_time;    
    
    /**
     * 修改人Id
     * @length 
     * @typed bigint
     */
    public $updated_id;    
    
    /**
     * 修改时间
     * @length 
     * @typed datetime
     */
    public $updated_time;    
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
     * 获取 用户id
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }
    
    /**
     * 设置 用户id
     * @param $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    
    /**
     * 效验 用户id
     * @param string $msg
     * @throws Exception
     */
    public function validUserId(string $msg = 'user_id Cannot be empty!')
    {
        if(empty($this->user_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 合集id
     * @return mixed
     */
    public function getWrapperId()
    {
        return $this->wrapper_id;
    }
    
    /**
     * 设置 合集id
     * @param $wrapper_id
     */
    public function setWrapperId($wrapper_id)
    {
        $this->wrapper_id = $wrapper_id;
    }
    
    /**
     * 效验 合集id
     * @param string $msg
     * @throws Exception
     */
    public function validWrapperId(string $msg = 'wrapper_id Cannot be empty!')
    {
        if(empty($this->wrapper_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 标题
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }
    
    /**
     * 设置 标题
     * @param string|null $title
     */
    public function setTitle(?string $title)
    {
        $this->title = $title;
    }
    
    /**
     * 效验 标题
     * @param string $msg
     * @throws Exception
     */
    public function validTitle(string $msg = 'title Cannot be empty!')
    {
        if(empty($this->title)) throw new Exception($msg);
    }
    
    /**
     * 获取 类型 1 图片 2 视频
     * @return int
     */
    public function getType(): ?int
    {
        return $this->type;
    }
    
    /**
     * 设置 类型 1 图片 2 视频
     * @param int|null $type
     */
    public function setType(?int $type)
    {
        $this->type = $type;
    }
    
    /**
     * 效验 类型 1 图片 2 视频
     * @param string $msg
     * @throws Exception
     */
    public function validType(string $msg = 'type Cannot be empty!')
    {
        if(empty($this->type)) throw new Exception($msg);
    }
    
    /**
     * 获取 点赞总数
     * @return int
     */
    public function getLikeCount(): ?int
    {
        return $this->like_count;
    }
    
    /**
     * 设置 点赞总数
     * @param int|null $like_count
     */
    public function setLikeCount(?int $like_count)
    {
        $this->like_count = $like_count;
    }
    
    /**
     * 效验 点赞总数
     * @param string $msg
     * @throws Exception
     */
    public function validLikeCount(string $msg = 'like_count Cannot be empty!')
    {
        if(empty($this->like_count)) throw new Exception($msg);
    }
    
    /**
     * 获取 收藏数量
     * @return int
     */
    public function getCollectionCount(): ?int
    {
        return $this->collection_count;
    }
    
    /**
     * 设置 收藏数量
     * @param int|null $collection_count
     */
    public function setCollectionCount(?int $collection_count)
    {
        $this->collection_count = $collection_count;
    }
    
    /**
     * 效验 收藏数量
     * @param string $msg
     * @throws Exception
     */
    public function validCollectionCount(string $msg = 'collection_count Cannot be empty!')
    {
        if(empty($this->collection_count)) throw new Exception($msg);
    }
    
    /**
     * 获取 评论数量
     * @return int
     */
    public function getCommentCount(): ?int
    {
        return $this->comment_count;
    }
    
    /**
     * 设置 评论数量
     * @param int|null $comment_count
     */
    public function setCommentCount(?int $comment_count)
    {
        $this->comment_count = $comment_count;
    }
    
    /**
     * 效验 评论数量
     * @param string $msg
     * @throws Exception
     */
    public function validCommentCount(string $msg = 'comment_count Cannot be empty!')
    {
        if(empty($this->comment_count)) throw new Exception($msg);
    }
    
    /**
     * 获取 转发数量
     * @return int
     */
    public function getForwardCount(): ?int
    {
        return $this->forward_count;
    }
    
    /**
     * 设置 转发数量
     * @param int|null $forward_count
     */
    public function setForwardCount(?int $forward_count)
    {
        $this->forward_count = $forward_count;
    }
    
    /**
     * 效验 转发数量
     * @param string $msg
     * @throws Exception
     */
    public function validForwardCount(string $msg = 'forward_count Cannot be empty!')
    {
        if(empty($this->forward_count)) throw new Exception($msg);
    }
    
    /**
     * 获取 分享数量
     * @return int
     */
    public function getShareCount(): ?int
    {
        return $this->share_count;
    }
    
    /**
     * 设置 分享数量
     * @param int|null $share_count
     */
    public function setShareCount(?int $share_count)
    {
        $this->share_count = $share_count;
    }
    
    /**
     * 效验 分享数量
     * @param string $msg
     * @throws Exception
     */
    public function validShareCount(string $msg = 'share_count Cannot be empty!')
    {
        if(empty($this->share_count)) throw new Exception($msg);
    }
    
    /**
     * 获取 账户隐私类型 1 公开，2私密，3 好友可见
     * @return int
     */
    public function getPrivacyType(): ?int
    {
        return $this->privacy_type;
    }
    
    /**
     * 设置 账户隐私类型 1 公开，2私密，3 好友可见
     * @param int|null $privacy_type
     */
    public function setPrivacyType(?int $privacy_type)
    {
        $this->privacy_type = $privacy_type;
    }
    
    /**
     * 效验 账户隐私类型 1 公开，2私密，3 好友可见
     * @param string $msg
     * @throws Exception
     */
    public function validPrivacyType(string $msg = 'privacy_type Cannot be empty!')
    {
        if(empty($this->privacy_type)) throw new Exception($msg);
    }
    
    /**
     * 获取 地点id
     * @return mixed
     */
    public function getPlaceId()
    {
        return $this->place_id;
    }
    
    /**
     * 设置 地点id
     * @param $place_id
     */
    public function setPlaceId($place_id)
    {
        $this->place_id = $place_id;
    }
    
    /**
     * 效验 地点id
     * @param string $msg
     * @throws Exception
     */
    public function validPlaceId(string $msg = 'place_id Cannot be empty!')
    {
        if(empty($this->place_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 定位
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }
    
    /**
     * 设置 定位
     * @param $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }
    
    /**
     * 效验 定位
     * @param string $msg
     * @throws Exception
     */
    public function validLocation(string $msg = 'location Cannot be empty!')
    {
        if(empty($this->location)) throw new Exception($msg);
    }
    
    /**
     * 获取 作品标签id
     * @return mixed
     */
    public function getTagId()
    {
        return $this->tag_id;
    }
    
    /**
     * 设置 作品标签id
     * @param $tag_id
     */
    public function setTagId($tag_id)
    {
        $this->tag_id = $tag_id;
    }
    
    /**
     * 效验 作品标签id
     * @param string $msg
     * @throws Exception
     */
    public function validTagId(string $msg = 'tag_id Cannot be empty!')
    {
        if(empty($this->tag_id)) throw new Exception($msg);
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