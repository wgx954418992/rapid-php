<?php

namespace apps\core\classier\dao\master\oauth2;

use apps\core\classier\model\OAuth2ModelInterface;
use Exception;

interface OAuth2DaoInterface
{

    /**
     * 添加 oauth2 user
     * @param  $oauth2UserModel $OAuth2UserModel
     * @return bool
     * @throws Exception
     */
    public function addOAuth2User(OAuth2ModelInterface $oauth2UserModel): bool;

    /**
     * 添加 oauth2 用户
     * @param  $oauth2UserModel $OAuth2UserModel
     * @return bool
     * @throws Exception
     */
    public function setOAuth2User(OAuth2ModelInterface $oauth2UserModel): bool;

    /**
     * 通过userId获取 oauth2 user
     * @param $bindId
     * @return OAuth2ModelInterface|null
     * @throws Exception
     */
    public function getOAuth2UserByBindId($bindId): ?OAuth2ModelInterface;

    /**
     * 通过unionId 获取 oauth2 user
     * @param $unionId
     * @return OAuth2ModelInterface|null
     * @throws Exception
     */
    public function getOAuth2UserByUnionId($unionId): ?OAuth2ModelInterface;

    /**
     * 通过openId获取 oauth2 user
     * @param $openId
     * @return OAuth2ModelInterface|null
     * @throws Exception
     */
    public function getOAuth2UserByOpenId($openId): ?OAuth2ModelInterface;
}
