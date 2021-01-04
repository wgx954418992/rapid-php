<?php

namespace apps\core\classier\config;

use function rapidPHP\V;

class BaseConfig
{
    /**
     * 登录方式=>账号登录
     */
    const LOGIN_MODE_ACCOUNT = 1;

    /**
     * 登录方式=>验证码登录
     */
    const LOGIN_MODE_CODE = 2;

    /**
     * 登录方式=>小程序登录
     */
    const LOGIN_MODE_MINI = 3;

    /**
     * 默认每页加载大小
     */
    const PAGE_SIZE_DEFAULT = 10;

    /**
     * 地区等级=》州
     */
    const AREA_LEVEL_STATE = 1;

    /**
     * 地区等级=》国家
     */
    const AREA_LEVEL_COUNTRY = 2;

    /**
     * 地区等级=》省
     */
    const AREA_LEVEL_PROVINCE = 3;

    /**
     * token
     */
    const TOKEN_NAME_USER = 'user_token';

    /**
     * admin
     */
    const TOKEN_NAME_ADMIN = 'admin_token';

    /**
     * 获取文件url地址
     * @param $fileId
     * @param null $hostUrl
     * @return string
     */
    public static function getFileUrl($fileId, $hostUrl = null): string
    {
        if (empty($fileId)) return '';

        if (V()->website($fileId)) {
            return $fileId;
        } else {
            return $hostUrl . 'file/' . $fileId;
        }
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
}