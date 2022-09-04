<?php

namespace apps\core\classier\service;


use apps\core\classier\dao\master\MemberDao;
use apps\core\classier\model\AppMemberModel;
use Exception;
use rapidPHP\modules\common\classier\Instances;

class MemberService
{

    /**
     * 单例模式
     */
    use Instances;

    /**
     * 初始化当前
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * 添加会员
     * @param AppMemberModel $memberModel
     * @return void
     * @throws Exception
     */
    public function addedMember(AppMemberModel $memberModel)
    {
        if (empty($memberModel->getMajorId())) throw new Exception('会员id错误!');

        if (empty($memberModel->getName())) throw new Exception('名称错误!');

        if (empty($memberModel->getTitle())) throw new Exception('标题错误!');

        if (empty($memberModel->getDesc())) throw new Exception('介绍错误!');

        if ($memberModel->getAmount() <= 0) throw new Exception('价格不能少于0元!');

        if ($memberModel->getValidTime() <= 3600 * 24) throw new Exception('有效期不能少于1天!');

        /** @var MemberDao $memberDao */
        $memberDao = MemberDao::getInstance();

        if (empty($memberModel->getId())) {

            if (!$memberDao->addMember($memberModel))
                throw new Exception('添加失败!');
        } else {
            if (!$memberDao->setMember($memberModel))
                throw new Exception('更新失败!');
        }
    }

    /**
     * 删除会员
     * @param AppMemberModel $memberModel
     * @return bool
     * @throws Exception
     */
    public function delMember(AppMemberModel $memberModel)
    {
        if (empty($memberModel->getId())) throw new Exception('memberId错误!');

        /** @var MemberDao $memberDao */
        $memberDao = MemberDao::getInstance();

        if (!$memberDao->delMember($memberModel))
            throw new Exception('删除失败!');

        return true;
    }

    /**
     * 通过专业id获取会员列表
     * @param $majorId
     * @return AppMemberModel[]
     * @throws Exception
     */
    public function getMemberListByMajorId($majorId): array
    {
        if (empty($majorId)) throw new Exception('专业id错误!');

        /** @var MemberDao $memberDao */
        $memberDao = MemberDao::getInstance();

        return $memberDao->getMemberListByMajorId($majorId);
    }

    /**
     * 获取会员信息
     * @param $memberId
     * @return AppMemberModel
     * @throws Exception
     */
    public function getMember($memberId)
    {
        if (empty($memberId)) throw new Exception('会员id错误!');

        /** @var MemberDao $memberDao */
        $memberDao = MemberDao::getInstance();

        $memberModel = $memberDao->getMember($memberId);

        if ($memberModel == null) throw new Exception('会员不存在!');

        return $memberModel;
    }
}
