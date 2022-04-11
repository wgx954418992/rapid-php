<?php


namespace apps\core\classier\enum\setting\attribute\point;


use apps\core\classier\enum\setting\IAttribute;
use Exception;

class IntegralRule extends IAttribute
{

    /**
     * 设置type名称，注册
     */
    const REGISTER = 'REGISTER';

    /**
     * 设置type名称，签到奖励
     */
    const SIGN = 'SIGN';

    /**
     * 设置type名称，邀请注册
     */
    const INVITE_REGISTER = 'INVITE_REGISTER';

    /**
     * 设置type名称，语音搜索
     */
    const SEARCH_SPEECH = 'SEARCH_SPEECH';

    /**
     * 设置type名称，图片搜索
     */
    const SEARCH_IMAGE = 'SEARCH_IMAGE';

    /**
     * 设置type名称，不是会员刷题扣除的积分
     */
    const BRUSH_QUESTION = 'BRUSH_QUESTION';

    /**
     * @var string|null
     */
    protected $text;

    /**
     * set text
     * @param string|null $text
     * @return IntegralRule
     */
    public function setText(?string $text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * 获取text
     * @return string
     * @throws Exception
     */
    public function getText()
    {
        if (!empty($this->text)) return $this->text;

        switch ($this->constValue) {
            case self::REGISTER:
                return '首次注册，赠送积分';
            case self::SIGN:
                return '每日签到，赠送积分';
            case self::INVITE_REGISTER:
                return '邀请注册成功，赠送积分';
            case self::SEARCH_SPEECH:
                return '语音搜索';
            case self::SEARCH_IMAGE:
                return '图片搜索';
            default:
                throw new Exception('类型错误!');
        }
    }
}
