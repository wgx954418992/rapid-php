<?php


namespace apps\core\classier\model;

interface OAuth2ModelInterface
{
    /**
     * 获取 id
     * @return mixed
     */
    public function getId();

    /**
     * 设置 id
     * @param $id
     */
    public function setId($id);

    /**
     * 获取 bindId
     * @return mixed
     */
    public function getBindId();

    /**
     * 设置 bindId
     * @param $user_id
     */
    public function setBindId($user_id);

    /**
     * 设置 unionid
     * @param string|null $union_id
     */
    public function setUnionId(?string $union_id);

    /**
     * 获取 unionid
     * @return string
     */
    public function getUnionId(): ?string;

    /**
     * 获取 openid
     * @return string
     */
    public function getOpenId(): ?string;

    /**
     * 设置 openid
     * @param string|null $open_id
     */
    public function setOpenId(?string $open_id);

    /**
     * 获取 QQ头像
     * @return string
     */
    public function getHeadimgurl(): ?string;

    /**
     * 设置 QQ头像
     * @param string|null $headimgurl
     */
    public function setHeadimgurl(?string $headimgurl);

    /**
     * 获取 创建人Id
     * @return mixed
     */
    public function getCreatedId();

    /**
     * 设置 创建人Id
     * @param $created_id
     */
    public function setCreatedId($created_id);

    /**
     * 获取 修改人Id
     * @return mixed
     */
    public function getUpdatedId();

    /**
     * 设置 修改人Id
     * @param $updated_id
     */
    public function setUpdatedId($updated_id);
}
