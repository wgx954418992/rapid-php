<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\config\BaseConfig;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppFeedbackModel;
use Exception;
use function rapidPHP\Cal;

class FeedbackDao extends MasterDao
{

    /**
     * FeedbackDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppFeedbackModel::class);
    }

    /**
     * 添加反馈
     * @param AppFeedbackModel $feedbackModel
     * @return bool
     * @throws Exception
     */
    public function addFeedback(AppFeedbackModel $feedbackModel): bool
    {
        return parent::add([
            'user_id' => $feedbackModel->getUserId(),
            'content' => $feedbackModel->getContent(),
            'contact' => $feedbackModel->getContact(),
            'status' => $feedbackModel->getStatus(),
            'is_delete' => false,
            'created_id' => $feedbackModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ]);
    }
}