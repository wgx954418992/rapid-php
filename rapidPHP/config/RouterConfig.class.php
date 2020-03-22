<?php

namespace rapidPHP\config;

class RouterConfig
{
    //路由url名
    const URI_NAME = 'url';

    //路由class名
    const CLASS_NAME = 'class';


    //路由class构造函数
    const CLASS_NAME_INIT = '__construct';


    //对应app.inc里面的name
    const APP_NAME = 'appName';


    //路由方法名
    const METHOD_NAME = 'methodName';


    //路由方法类型名
    const METHOD_TYPE = 'methodType';


    //路由方法参数名
    const METHOD_PARAMETER = 'methodParameter';


    //参数数据绑定
    const METHOD_PARAMETER_DATABEAN_CLASS = 'methodParameterDataBeanClass';


    //路由方法参数类型名
    const METHOD_PARAMETER_TYPE = 'methodParameterType';


    //路由方法参数来源名
    const METHOD_PARAMETER_REQUEST_DOTYPE = 'methodParameterDoType';


    //路由方法参数类型默认名
    const METHOD_PARAMETER_DEFAULT = 'methodParameterDefault';

}