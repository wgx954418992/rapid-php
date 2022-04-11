<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 用户表
 * @table app_user
 * rapidPHP auto generate Model 2022-04-11 11:39:19
 */

class AppUserModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'app_user';

    
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
     * 用户名称（刚注册需要自动生成）
     * @var string|null 
     * @length 50
     * @typed varchar
     */
    protected $username;

    /**
     * 设置 用户名称（刚注册需要自动生成）
     * @param string|null $username
     */
    public function setUsername(?string $username)
    {
        $this->username = $username;
    }

    /**
     * 获取 用户名称（刚注册需要自动生成）
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * 效验 用户名称（刚注册需要自动生成）
     * @param string $msg
     * @throws Exception
     */
    public function validUsername(string $msg = 'username Cannot be empty!')
    {
        if (empty($this->username)) throw new Exception($msg);
    }

    /**
     * 名称
     * @var string|null 
     * @length 100
     * @typed varchar
     */
    protected $nickname;

    /**
     * 设置 名称
     * @param string|null $nickname
     */
    public function setNickname(?string $nickname)
    {
        $this->nickname = $nickname;
    }

    /**
     * 获取 名称
     * @return string|null
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * 效验 名称
     * @param string $msg
     * @throws Exception
     */
    public function validNickname(string $msg = 'nickname Cannot be empty!')
    {
        if (empty($this->nickname)) throw new Exception($msg);
    }

    /**
     * 区号+手机号
     * @var string|null 
     * @length 16
     * @typed varchar
     */
    protected $telephone;

    /**
     * 设置 区号+手机号
     * @param string|null $telephone
     */
    public function setTelephone(?string $telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * 获取 区号+手机号
     * @return string|null
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * 效验 区号+手机号
     * @param string $msg
     * @throws Exception
     */
    public function validTelephone(string $msg = 'telephone Cannot be empty!')
    {
        if (empty($this->telephone)) throw new Exception($msg);
    }

    /**
     * 密码
     * @var string|null 
     * @length 40
     * @typed varchar
     */
    protected $password;

    /**
     * 设置 密码
     * @param string|null $password
     */
    public function setPassword(?string $password)
    {
        $this->password = $password;
    }

    /**
     * 获取 密码
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * 效验 密码
     * @param string $msg
     * @throws Exception
     */
    public function validPassword(string $msg = 'password Cannot be empty!')
    {
        if (empty($this->password)) throw new Exception($msg);
    }

    /**
     * 签名
     * @var string|null 
     * @length 255
     * @typed varchar
     */
    protected $explain;

    /**
     * 设置 签名
     * @param string|null $explain
     */
    public function setExplain(?string $explain)
    {
        $this->explain = $explain;
    }

    /**
     * 获取 签名
     * @return string|null
     */
    public function getExplain(): ?string
    {
        return $this->explain;
    }

    /**
     * 效验 签名
     * @param string $msg
     * @throws Exception
     */
    public function validExplain(string $msg = 'explain Cannot be empty!')
    {
        if (empty($this->explain)) throw new Exception($msg);
    }

    /**
     * 头像文件Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $head_fid;

    /**
     * 设置 头像文件Id
     * @param $head_fid
     */
    public function setHeadFid($head_fid)
    {
        $this->head_fid = $head_fid;
    }

    /**
     * 获取 头像文件Id
     * @return mixed
     */
    public function getHeadFid()
    {
        return $this->head_fid;
    }

    /**
     * 效验 头像文件Id
     * @param string $msg
     * @throws Exception
     */
    public function validHeadFid(string $msg = 'head_fid Cannot be empty!')
    {
        if (empty($this->head_fid)) throw new Exception($msg);
    }

    /**
     * 性别 1男人 2 女人
     * @var int|null 
     * @length 
     * @typed tinyint
     */
    protected $gender;

    /**
     * 设置 性别 1男人 2 女人
     * @param int|null $gender
     */
    public function setGender(?int $gender)
    {
        $this->gender = $gender;
    }

    /**
     * 获取 性别 1男人 2 女人
     * @return int|null
     */
    public function getGender(): ?int
    {
        return $this->gender;
    }

    /**
     * 效验 性别 1男人 2 女人
     * @param string $msg
     * @throws Exception
     */
    public function validGender(string $msg = 'gender Cannot be empty!')
    {
        if (empty($this->gender)) throw new Exception($msg);
    }

    /**
     * 出生日期
     * @var string|null 
     * @length 
     * @typed date
     */
    protected $birthday;

    /**
     * 设置 出生日期
     * @param string|null $birthday
     */
    public function setBirthday(?string $birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * 获取 出生日期
     * @return string|null
     */
    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    /**
     * 效验 出生日期
     * @param string $msg
     * @throws Exception
     */
    public function validBirthday(string $msg = 'birthday Cannot be empty!')
    {
        if (empty($this->birthday)) throw new Exception($msg);
    }

    /**
     * 注册Ip
     * @var string|null 
     * @length 18
     * @typed varchar
     */
    protected $register_ip;

    /**
     * 设置 注册Ip
     * @param string|null $register_ip
     */
    public function setRegisterIp(?string $register_ip)
    {
        $this->register_ip = $register_ip;
    }

    /**
     * 获取 注册Ip
     * @return string|null
     */
    public function getRegisterIp(): ?string
    {
        return $this->register_ip;
    }

    /**
     * 效验 注册Ip
     * @param string $msg
     * @throws Exception
     */
    public function validRegisterIp(string $msg = 'register_ip Cannot be empty!')
    {
        if (empty($this->register_ip)) throw new Exception($msg);
    }

    /**
     * 来源
     * @var string|null 
     * @length 20
     * @typed varchar
     */
    protected $source;

    /**
     * 设置 来源
     * @param string|null $source
     */
    public function setSource(?string $source)
    {
        $this->source = $source;
    }

    /**
     * 获取 来源
     * @return string|null
     */
    public function getSource(): ?string
    {
        return $this->source;
    }

    /**
     * 效验 来源
     * @param string $msg
     * @throws Exception
     */
    public function validSource(string $msg = 'source Cannot be empty!')
    {
        if (empty($this->source)) throw new Exception($msg);
    }

    /**
     * 当前状态 1 正常 2 申请注销中 3 已注销
     * @var int|null 
     * @length 
     * @typed tinyint
     */
    protected $status;

    /**
     * 设置 当前状态 1 正常 2 申请注销中 3 已注销
     * @param int|null $status
     */
    public function setStatus(?int $status)
    {
        $this->status = $status;
    }

    /**
     * 获取 当前状态 1 正常 2 申请注销中 3 已注销
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * 效验 当前状态 1 正常 2 申请注销中 3 已注销
     * @param string $msg
     * @throws Exception
     */
    public function validStatus(string $msg = 'status Cannot be empty!')
    {
        if (empty($this->status)) throw new Exception($msg);
    }

    /**
     * 粉丝数量
     * @var int|null 
     * @length 
     * @typed int
     */
    protected $follower_count;

    /**
     * 设置 粉丝数量
     * @param int|null $follower_count
     */
    public function setFollowerCount(?int $follower_count)
    {
        $this->follower_count = $follower_count;
    }

    /**
     * 获取 粉丝数量
     * @return int|null
     */
    public function getFollowerCount(): ?int
    {
        return $this->follower_count;
    }

    /**
     * 效验 粉丝数量
     * @param string $msg
     * @throws Exception
     */
    public function validFollowerCount(string $msg = 'follower_count Cannot be empty!')
    {
        if (empty($this->follower_count)) throw new Exception($msg);
    }

    /**
     * 关注数量
     * @var int|null 
     * @length 
     * @typed int
     */
    protected $following_count;

    /**
     * 设置 关注数量
     * @param int|null $following_count
     */
    public function setFollowingCount(?int $following_count)
    {
        $this->following_count = $following_count;
    }

    /**
     * 获取 关注数量
     * @return int|null
     */
    public function getFollowingCount(): ?int
    {
        return $this->following_count;
    }

    /**
     * 效验 关注数量
     * @param string $msg
     * @throws Exception
     */
    public function validFollowingCount(string $msg = 'following_count Cannot be empty!')
    {
        if (empty($this->following_count)) throw new Exception($msg);
    }

    /**
     * 推荐人id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $recommend_uid;

    /**
     * 设置 推荐人id
     * @param $recommend_uid
     */
    public function setRecommendUid($recommend_uid)
    {
        $this->recommend_uid = $recommend_uid;
    }

    /**
     * 获取 推荐人id
     * @return mixed
     */
    public function getRecommendUid()
    {
        return $this->recommend_uid;
    }

    /**
     * 效验 推荐人id
     * @param string $msg
     * @throws Exception
     */
    public function validRecommendUid(string $msg = 'recommend_uid Cannot be empty!')
    {
        if (empty($this->recommend_uid)) throw new Exception($msg);
    }

    /**
     * top 专业id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $top_mid;

    /**
     * 设置 top 专业id
     * @param $top_mid
     */
    public function setTopMid($top_mid)
    {
        $this->top_mid = $top_mid;
    }

    /**
     * 获取 top 专业id
     * @return mixed
     */
    public function getTopMid()
    {
        return $this->top_mid;
    }

    /**
     * 效验 top 专业id
     * @param string $msg
     * @throws Exception
     */
    public function validTopMid(string $msg = 'top_mid Cannot be empty!')
    {
        if (empty($this->top_mid)) throw new Exception($msg);
    }

    /**
     * 专业id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $major_id;

    /**
     * 设置 专业id
     * @param $major_id
     */
    public function setMajorId($major_id)
    {
        $this->major_id = $major_id;
    }

    /**
     * 获取 专业id
     * @return mixed
     */
    public function getMajorId()
    {
        return $this->major_id;
    }

    /**
     * 效验 专业id
     * @param string $msg
     * @throws Exception
     */
    public function validMajorId(string $msg = 'major_id Cannot be empty!')
    {
        if (empty($this->major_id)) throw new Exception($msg);
    }

    /**
     * 是否删除
     * @var bool|null 
     * @length 
     * @typed bit
     */
    protected $is_delete;

    /**
     * 设置 是否删除
     * @param bool|null $is_delete
     */
    public function setIsDelete(?bool $is_delete)
    {
        $this->is_delete = $is_delete;
    }

    /**
     * 获取 是否删除
     * @return bool|null
     */
    public function getIsDelete(): ?bool
    {
        return $this->is_delete;
    }

    /**
     * 效验 是否删除
     * @param string $msg
     * @throws Exception
     */
    public function validIsDelete(string $msg = 'is_delete Cannot be empty!')
    {
        if (empty($this->is_delete)) throw new Exception($msg);
    }

    /**
     * 创建人Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $created_id;

    /**
     * 设置 创建人Id
     * @param $created_id
     */
    public function setCreatedId($created_id)
    {
        $this->created_id = $created_id;
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
     * 效验 创建人Id
     * @param string $msg
     * @throws Exception
     */
    public function validCreatedId(string $msg = 'created_id Cannot be empty!')
    {
        if (empty($this->created_id)) throw new Exception($msg);
    }

    /**
     * 创建时间
     * @var string|null 
     * @length 
     * @typed datetime
     */
    protected $created_time;

    /**
     * 设置 创建时间
     * @param string|null $created_time
     */
    public function setCreatedTime(?string $created_time)
    {
        $this->created_time = $created_time;
    }

    /**
     * 获取 创建时间
     * @return string|null
     */
    public function getCreatedTime(): ?string
    {
        return $this->created_time;
    }

    /**
     * 效验 创建时间
     * @param string $msg
     * @throws Exception
     */
    public function validCreatedTime(string $msg = 'created_time Cannot be empty!')
    {
        if (empty($this->created_time)) throw new Exception($msg);
    }

    /**
     * 修改人Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $updated_id;

    /**
     * 设置 修改人Id
     * @param $updated_id
     */
    public function setUpdatedId($updated_id)
    {
        $this->updated_id = $updated_id;
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
     * 效验 修改人Id
     * @param string $msg
     * @throws Exception
     */
    public function validUpdatedId(string $msg = 'updated_id Cannot be empty!')
    {
        if (empty($this->updated_id)) throw new Exception($msg);
    }

    /**
     * 修改时间
     * @var string|null 
     * @length 
     * @typed datetime
     */
    protected $updated_time;

    /**
     * 设置 修改时间
     * @param string|null $updated_time
     */
    public function setUpdatedTime(?string $updated_time)
    {
        $this->updated_time = $updated_time;
    }

    /**
     * 获取 修改时间
     * @return string|null
     */
    public function getUpdatedTime(): ?string
    {
        return $this->updated_time;
    }

    /**
     * 效验 修改时间
     * @param string $msg
     * @throws Exception
     */
    public function validUpdatedTime(string $msg = 'updated_time Cannot be empty!')
    {
        if (empty($this->updated_time)) throw new Exception($msg);
    }

}
