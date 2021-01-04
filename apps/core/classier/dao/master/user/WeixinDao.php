<?php

namespace apps\core\classier\dao\master\user;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\UserWeixinModel;
use Exception;
use function rapidPHP\Cal;

class WeixinDao extends MasterDao
{

    /**
     * WeixinDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(UserWeixinModel::class);
    }

    /**
     * 添加 wx user
     * @param UserWeixinModel $WXUserModel $WXUserModel
     * @return bool
     * @throws Exception
     */
    public function addWXUser(UserWeixinModel $WXUserModel): bool
    {
        $result = parent::add([
            'user_id' => $WXUserModel->getUserId(),
            'open_id' => $WXUserModel->getOpenId(),
            'union_id' => $WXUserModel->getUnionId(),
            'nickname' => $WXUserModel->getNickname(),
            'headimgurl' => $WXUserModel->getHeadimgurl(),
            'gender' => $WXUserModel->getGender(),
            'language' => $WXUserModel->getLanguage(),
            'country' => $WXUserModel->getCountry(),
            'province' => $WXUserModel->getProvince(),
            'city' => $WXUserModel->getCity(),
            'is_delete' => false,
            'created_id' => $WXUserModel->getUserId(),
            'created_time' => Cal()->getDate(),
        ], $id);

        if ($result) $WXUserModel->setId($id);

        return $id;
    }

    /**
     * 添加用户
     * @param UserWeixinModel $WXUserModel $WXUserModel
     * @return bool
     * @throws Exception
     */
    public function setWXUser(UserWeixinModel $WXUserModel): bool
    {
        return parent::set([
            'user_id' => $WXUserModel->getUserId(),
            'open_id' => $WXUserModel->getOpenId(),
            'union_id' => $WXUserModel->getUnionId(),
            'nickname' => $WXUserModel->getNickname(),
            'headimgurl' => $WXUserModel->getHeadimgurl(),
            'gender' => $WXUserModel->getGender(),
            'language' => $WXUserModel->getLanguage(),
            'country' => $WXUserModel->getCountry(),
            'province' => $WXUserModel->getProvince(),
            'city' => $WXUserModel->getCity(),
            'updated_id' => $WXUserModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $WXUserModel->getId())->execute();
    }


    /**
     * 通过unionId 获取wx user
     * @param $unionId
     * @return UserWeixinModel|null
     * @throws Exception
     */
    public function getWXUserByUnionId($unionId): ?UserWeixinModel
    {
        /** @var UserWeixinModel $model */
        $model = parent::get()
            ->where('is_delete', false)
            ->where('union_id', $unionId)
            ->getStatement()
            ->fetch($this->getModelOrClass());

        return $model;
    }

    /**
     * 通过open获取WX user
     * @param $openId
     * @return UserWeixinModel|null
     * @throws Exception
     */
    public function getWXUserByOpenId($openId): ?UserWeixinModel
    {
        /** @var UserWeixinModel $model */
        $model = parent::get()
            ->where('is_delete', false)
            ->where('open_id', $openId)
            ->getStatement()
            ->fetch($this->getModelOrClass());

        return $model;
    }


    /**
     * 获取WX user信息
     * @param $id
     * @return UserWeixinModel|null
     * @throws Exception
     */
    public function getWXUser($id): ?UserWeixinModel
    {
        /** @var UserWeixinModel $model */
        $model = parent::get()
            ->where('is_delete', false)
            ->where('id', $id)
            ->getStatement()
            ->fetch($this->getModelOrClass());

        return $model;
    }

    /**
     * 删除WX user
     * @param $id
     * @param $updatedId
     * @return bool
     * @throws Exception
     */
    public function delWXUser($id, $updatedId): bool
    {
        return parent::set([
            'is_delete' => true,
            'updated_id' => $updatedId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)->execute();
    }

}