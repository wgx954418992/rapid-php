<?php

namespace apps\app\classier\dao\master;

use apps\app\classier\dao\MasterDao;
use apps\app\classier\model\AppCodeModel;
use Exception;
use function rapidPHP\B;
use function rapidPHP\Cal;

class CodeDao extends MasterDao
{

    /**
     * CodeDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppCodeModel::class);
    }

    /**
     * 发送验证码
     * @param $templateId
     * @param $bindId
     * @param $code
     * @param string $content
     * @return bool
     * @throws Exception
     */
    public function addVerifyCode($templateId, $bindId, $code, $content = ''): bool
    {
        return parent::add([
            'id' => B()->onlyIdToInt(),
            'template_id' => $templateId,
            'bind_id' => $bindId,
            'code' => $code,
            'content' => $content,
            'send_time' => time(),
            'is_delete' => 0,
            'created_id' => $bindId,
            'created_time' => Cal()->getDate(),
        ]);
    }

    /**
     * 获取最后验证码发送时间
     * @param $templateId
     * @param $tel
     * @return int
     * @throws Exception
     */
    public function getVerifyCodeLastSendTime($templateId, $tel): int
    {
        return (int)parent::get(['send_time'])
            ->where('template_id', $templateId)
            ->where('bind_id', $tel)
            ->where('is_delete', 0)
            ->order('send_time', 'DESC')
            ->getStatement()
            ->fetchValue('send_time');
    }

    /**
     * 获取检查验证码信息
     * @param $templateId
     * @param $bindId
     * @param $code
     * @return AppCodeModel|null
     * @throws Exception
     */
    public function getCheckVerifyCode($templateId, $bindId, $code): ?AppCodeModel
    {
        /** @var AppCodeModel $model */
        $model = parent::get()
            ->where('template_id', $templateId)
            ->where('bind_id', $bindId)
            ->where('code', $code)
            ->where('is_delete', 0)
            ->getStatement()
            ->fetch($this->getModelOrClass());

        return $model;
    }

    /**
     * 使用验证码
     * @param $codeId
     * @return bool
     * @throws Exception
     */
    public function useVerifyCode($codeId): bool
    {
        return parent::set([
            'is_delete' => 1,
            'check_time' => time(),
            'updated_id' => session_id(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $codeId)->execute();
    }
}