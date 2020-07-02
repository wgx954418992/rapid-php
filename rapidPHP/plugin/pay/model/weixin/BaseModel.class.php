<?php

namespace rapidPHP\plugin\pay\model\weixin;

use Exception;
use rapidPHP\library\AB;
use rapidPHP\plugin\pay\weixin\Utils;

class BaseModel extends AB
{
    public $sign;

    /**
     * @param Utils $utils
     * @return string
     * @throws Exception
     */
    public function getSign(Utils $utils)
    {
        return $utils->getSign($this->getData());
    }

    /**
     * @param Utils $utils
     * @return $this
     * @throws Exception
     */
    public function setSign(Utils $utils)
    {
        $this->sign = $this->getSign($utils);

        return $this;
    }

    /**
     * @param Utils $utils
     * @return bool
     * @throws Exception
     */
    public function verifySign(Utils $utils)
    {
        return $utils->verifySign($this->getData());
    }


    /**
     * @param array|null $names
     * @return string
     * @throws Exception
     */
    public function toXml(?array $names = null): string
    {
        if (!is_array(parent::getData()) || count(parent::getData()) <= 0)
            throw new Exception("数组数据异常！");

        return X()->encode($this->getData());
    }
}