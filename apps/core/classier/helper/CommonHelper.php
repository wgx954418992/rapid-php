<?php


namespace apps\core\classier\helper;


use DateTime;
use Exception;
use libphonenumber\PhoneNumber;
use libphonenumber\PhoneNumberUtil;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Variable;
use function rapidPHP\B;
use function rapidPHP\Cal;

class CommonHelper
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

    /**
     * 解包location
     * @param string|null $location
     * @return string
     */
    public static function unpackLocation(?string $location): string
    {
        if (!$location) return '';

        try {
            $unpack = @unpack('x/x/x/x/corder/Ltype/dlat/dlon', $location);

            if (isset($unpack['lat']) && isset($unpack['lon'])) {
                return $unpack['lat'] . ',' . $unpack['lon'];
            }
        } catch (Exception $e) {

        }

        return '';
    }


    /**
     * 效验手机号码
     * @param $telephone
     * @param PhoneNumber|null $phoneNumber
     * @return string
     * @throws Exception
     */
    public static function validTelephone($telephone, ?PhoneNumber &$phoneNumber = null): string
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


    /**
     * aes 128 ecb 加密
     * @param $data
     * @param $key
     * @return string
     */
    public static function AESEncrypt($data, $key)
    {
        $data = openssl_encrypt($data, 'aes-128-ecb', $key, OPENSSL_RAW_DATA);

        return base64_encode($data);
    }

    /***
     * aes 128 ecb 解密
     * @param $data
     * @param $key
     * @return false|string
     */
    public static function AESDecrypt($data, $key)
    {
        $encrypted = base64_decode($data);

        return openssl_decrypt($encrypted, 'aes-128-ecb', $key, OPENSSL_RAW_DATA);
    }

    /**
     * 计算日期相差多少年
     * @param $start
     * @param $end
     * @return int
     * @throws Exception
     */
    public static function getDateDiffYear($start, $end = null): int
    {
        if (empty($end)) $end = Cal()->getDate();

        $january = new DateTime($start);

        $february = new DateTime($end);

        $interval = $february->diff($january);

        return $interval->y;
    }

    /**
     * 加载页数算法
     * @param $count
     * @param $page
     * @param $size
     * @return array
     */
    public static function pager($count, $page, $size): array
    {
        $list = [];

        $total = $count / $size;

        $total = is_float($total) ? (int)$total + 1 : $total;

        $startPage = $total - $page <= 4 ? ($total - $size + 1 < 1 ? 1 : $total - $size + 1) : ($page > 5 ? $page - 6 : 1);

        for ($i = $startPage, $c = 1; $i <= $total && $c <= $size; $i++, $c++) {
            $list[$i] = ['before' => (int)($i === $page), 'page' => $i];
        }

        return ['list' => $list, 'current' => $page, 'total' => $total, 'previous' => $page - 1, 'next' => $page + 1];
    }

    /**
     * 解析变量+命令
     * @param string $context
     * @param array|null $defined
     */
    public static function parseVariable(string &$context, ?array $defined = null)
    {
        $argv = func_get_args();

        array_splice($argv, 0, 2);

        $vars = Build::getInstance()->getRegularAll('/\{(.*?)\}/i', $context);

        $defined = array_merge([
            'year' => Cal()->getDate(time(), 'Y'),
            'month' => Cal()->getDate(time(), 'm'),
            'day' => Cal()->getDate(time(), 'd'),
        ], is_null($defined) ? [] : $defined);

        $replaces = [];

        foreach ($vars as $var) {

            preg_match('/^((\\$)?[A-Za-z0-9]+)(?:\((.*?)\))?/ui', $var, $match);

            $name = B()->getData($match, 1);

            $parameters = B()->getData($match, 3);

            if (is_callable($name)) {

                if (empty($parameters)) {
                    $parameters = [];
                } else {
                    $parameters = explode(',', $parameters);

                    foreach ($parameters as &$parameter) {
                        if (substr($parameter, 0, 1) == '$') {
                            $argvIndex = intval(substr($parameter, 1));

                            $parameter = B()->getData($argv, $argvIndex);
                        }
                    }
                }

                $replaces['{' . $var . '}'] = call_user_func_array($name, $parameters);
            } else if (substr($name, 0, 1) == '$') {
                $argvIndex = intval(substr($name, 1));

                $replaces['{' . $var . '}'] = B()->getData($argv, $argvIndex);
            } else if (isset($defined[$name])) {
                $replaces['{' . $var . '}'] = $defined[$name];
            }
        }

        if (!empty($replaces)) {
            $context = str_replace(array_keys($replaces), array_values($replaces), $context);
        }

        Variable::parseVarByString($context);
    }
}
