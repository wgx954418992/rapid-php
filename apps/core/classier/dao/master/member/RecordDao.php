<?php

namespace apps\core\classier\dao\master\member;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\MemberRecordModel;
use Exception;
use function rapidPHP\Cal;

class RecordDao  extends MasterDao
{

    /**
     * RecordDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(MemberRecordModel::class);
    }


    /**
     * 添加会员开通记录
     * @param MemberRecordModel $model
     * @return bool
     * @throws Exception
     */
    public function addRecord(MemberRecordModel $model): bool
    {
        return parent::add([
            'user_id' => $model->getUserId(),
            'order_id' => $model->getOrderId(),
            'major_id' => $model->getMajorId(),
            'member_id' => $model->getMemberId(),
            'name' => $model->getName(),
            'mode' => $model->getMode(),
            'open_time' => $model->getOpenTime(),
            'end_time' => $model->getEndTime(),
            'is_delete' => false,
            'created_id' => $model->getUserId(),
            'created_time' => Cal()->getDate(),
        ]);
    }
}
