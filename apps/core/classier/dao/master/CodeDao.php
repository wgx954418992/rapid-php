<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\CodeType;
use apps\core\classier\model\AppCodeModel;
use Exception;
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
     * @param AppCodeModel $codeModel
     * @return bool
     * @throws Exception
     */
    public function addCode(AppCodeModel $codeModel): bool
    {
        return $this->add([
            'code_type' => $codeModel->getCodeType(),
            'receiver' => $codeModel->getReceiver(),
            'code' => $codeModel->getCode(),
            'content' => $codeModel->getContent(),
            'send_type' => $codeModel->getSendType(),
            'send_time' => time(),
            'is_delete' => false,
            'created_id' => $codeModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ]);
    }

    /**
     * 获取最后验证码发送时间
     * @param CodeType $codeType
     * @param $receiver
     * @return int
     * @throws Exception
     */
    public function getCodeLastSendTime(CodeType $codeType, $receiver): int
    {
        return (int)$this->get(['send_time'])
            ->where('code_type', $codeType->getRawValue())
            ->where('receiver', $receiver)
            ->where('is_delete', false)
            ->order('send_time', 'DESC')
            ->getStatement()
            ->fetchValue('send_time');
    }

    /**
     * 获取检查验证码信息
     * @param CodeType $codeType
     * @param $receiver
     * @param $code
     * @return AppCodeModel|null
     * @throws Exception
     */
    public function getCheckCode(CodeType $codeType, $receiver, $code): ?AppCodeModel
    {
        return $this->get()
            ->where('code_type', $codeType->getRawValue())
            ->where('receiver', $receiver)
            ->where('code', $code)
            ->where('is_delete', false)
            ->getStatement()
            ->fetch($this->getModelOrClass());
    }

    /**
     * 使用验证码
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function checkedCode($id): bool
    {
        return $this->set([
            'is_delete' => true,
            'check_time' => time(),
            'updated_id' => session_id(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)->execute();
    }
}
