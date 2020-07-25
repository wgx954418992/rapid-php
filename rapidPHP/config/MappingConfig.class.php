<?php

namespace rapidPHP\config;

class MappingConfig
{

    /**
     * 默认扫描mapping 的url 名
     * @url /{userId}/get
     * @url /get
     */
    const APP_MAPPING_CONFIG_URL_NAME = '@url';

    /**
     * 默认扫描mapping 的param 名
     * @url /{userId}/get
     * @param :类型(int,string,bool,UserBean::class等) 参数名{$userId} 参数来源(post,get,cookie,session,file,或者$1正则匹配等)
     */
    const APP_MAPPING_CONFIG_PARAM_NAME = '@param';

    /**
     * 默认扫描mapping 的method 名
     * @url /{userId}/get
     * @param :类型(int,string,bool,UserBean::class等) 参数名{$userId} 参数来源(post,get,cookie,session,file,或者$1正则匹配等)
     * @method POST
     * 指定请求方法类型有 GET,POST,PUT,DELETE
     */
    const APP_MAPPING_CONFIG_METHOD_NAME = '@method';

    /**
     * 默认扫描mapping 的type 名
     * @url /{userId}/get
     * @param :类型(int,string,bool,UserBean::class等) 参数名{$userId} 参数来源(post,get,cookie,session,file,或者$1正则匹配等)
     * @method POST
     * @typed api
     * 指定改方法的类型，用于其他地方判断,比如指定api
     */
    const APP_MAPPING_CONFIG_TYPE_NAME = '@typed';

    /**
     * 默认扫描mapping 的header 名
     * @url /{userId}/get
     * @param :类型(int,string,bool,UserBean::class等) 参数名{$userId} 参数来源(post,get,cookie,session,file,或者$1正则匹配等)
     * @method POST
     * @typed api
     * @header (localhost:127.0.0.1;status:404;)
     * 可以附带输出指定header
     */
    const APP_MAPPING_CONFIG_HEADER_NAME = '@header';

    /**
     * 默认扫描mapping 的template 名
     * @url /{userId}/get
     * @param :类型(int,string,bool,UserBean::class等) 参数名{$userId} 参数来源(post,get,cookie,session,file,或者$1正则匹配等)
     * @method POST
     * @typed api
     * @header (localhost:127.0.0.1;status:404;)
     * @template index 或者 application\view\Index
     * 可以附带输出指定header
     */
    const APP_MAPPING_CONFIG_TEMPLATE = '@template';

    /**
     * 获取扫描映射包路径 ，默认扫描controller 路径
     * @return string
     */
    public static $MAPPING_PATH = APP_PATH . "controller/";

    /**
     * 路由配置
     * @var string
     */
    public static $APP_FILE_PATH = ROOT_RUNTIME . 'router/app.php';

    /**
     * 路由配置
     * @var string
     */
    public static $URI_FILE_PATH = ROOT_RUNTIME . 'router/uri.php';
}