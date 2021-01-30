<?php


namespace apps\core\classier\helper;


use Exception;
use libphonenumber\PhoneNumber;
use libphonenumber\PhoneNumberUtil;

class CommonHelper
{

    /**
     * 效验手机号码
     * @param $telephone
     * @param PhoneNumber $phoneNumber
     * @return string
     * @throws Exception
     */
    public static function validTelephone($telephone, &$phoneNumber = null)
    {
        if (empty($telephone)) throw new Exception('手机号码不能为空!');

        $phoneUtil = PhoneNumberUtil::getInstance();

        $regions = $phoneUtil->getSupportedRegions();

        foreach ($regions as $def) {
            try {
                $tempTel = substr($telephone, 0, 1) !== '+' ? '+' . $telephone : $telephone;

                $phoneNumber = $phoneUtil->parse($tempTel, $def);

                if ($phoneUtil->isValidNumber($phoneNumber)) {
                    return '+' . $phoneNumber->getCountryCode() . $phoneNumber->getNationalNumber();
                }
            } catch (Exception $e) {
                $phoneNumber = null;
            }
        }

        throw new Exception('手机号码不合法!');
    }

}