<?php


namespace apps\core\classier\config;

class SaltConfig
{

    /**
     * 获取加盐后的密码值
     * @param $psw
     * @return string
     */
    public static function getSaltPsw($psw): string
    {
        $salt = '';

        $psw = sha1($psw);

        for ($i = 0; $i < strlen($psw); $i++) if ($i % 2) $salt .= $psw[$i];

        return sha1($psw . $salt);
    }

}