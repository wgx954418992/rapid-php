<?php

namespace application\config;

/**
 * app 配置
 * Class BaseConfig
 * @package application\config
 */
class BaseConfig
{

    /**
     * 网站 ssl key 文件
     */
    const WEBSITE_SSL_KEY_FILE = APP_PATH . 'config/certificate/www.rapidphp.com.key';

    /**
     * 网站 ssl cert 文件
     */
    const WEBSITE_SSL_CERT_FILE = APP_PATH . 'config/certificate/www.rapidphp.com.pem';

}