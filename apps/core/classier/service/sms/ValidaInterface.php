<?php


namespace apps\core\classier\service\sms;


use apps\core\classier\wrapper\UserWrapper;

interface ValidaInterface
{


    /**
     * 效验
     * @param UserWrapper|null $userModel
     * @param $telephone
     * @param null $telephones
     * @return bool
     */
    public function valida(?UserWrapper $userModel, $telephone, $telephones = null): bool;
}