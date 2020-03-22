## RapidPHP介绍

RapidPHP本着免费开源、快速、高效、简单的面向对象的 轻量级PHP开发框架。

>**版本:** `2.0.0`

>**作者:** `954418992@qq.com`

##目录结构

~~~
.
├── README.md
├── application                                      应用目录
│   ├── config                                       配置目录
│   │   ├── BaseConfig.class.php                     app配置目录
│   ├── controller                                   控制器目录
│   │   ├── BaseController.class.php                
│   │   ├── ExceptionController.class.php
│   │   └── HomeController.class.php
│   ├── dao                                          数据库操作层
│   │   └── UserDao.class.php
│   ├── model                                        数据模型目录
│   │   ├── AppUserModel.class.php
│   ├── service                                      Service目录
│   │   ├── BaseService.class.php
│   │   └── UserService.class.php
│   └── view                                         视图目录
│       └── IndexView.class.php
├── composer.json                                    composer包配置文件
├── composer.lock
├── index.php                                        单一入口文件
├── public                                           静态模板目录，前端目录
│   └── src
│       └── view                                     rapidPHP默认解析模板目录
│           └── index.php
├── rapidPHP                                         rapidPHP核心库
│   ├── config                                       raipdPHP配置
│   │   ├── AppConfig.class.php
│   │   ├── DatabaseConfig.class.php
│   │   ├── MappingConfig.class.php
│   │   ├── RouterConfig.class.php
│   │   ├── database                                 自动生成的数据库创建脚本   
│   │   └── plugin                                   插件配置目录
│   │       ├── WXConfig.class.php
│   │       ├── oauth2
│   │       │   ├── QQOAuth2Config.class.php
│   │       │   └── WXOAuth2Config.class.php
│   │       └── wxsdk
│   │           ├── MiniConfig.class.php
│   │           └── PubliclyConfig.class.php
│   ├── init.php
│   ├── library                                       依赖库
│   │   ├── AB.class.php                              数组操作对象
│   │   ├── AR.class.php                              数组操作类
│   │   ├── Build.class.php                           常用方法库
│   │   ├── Db.class.php                              数据库操作类
│   │   ├── File.class.php                            文件操作类
│   │   ├── Input.class.php                           表单输入操作类
│   │   ├── Mail.class.php                            邮件类
│   │   ├── RESTFullApi.class.php                     Api接口类
│   │   ├── Reflection.class.php                      反射类
│   │   ├── Register.class.php                        寄存器类
│   │   ├── Upload.class.php                          上传文件操作类
│   │   ├── Verify.class.php                          正则验证库
│   │   ├── ViewTemplate.class.php                    view模板解析库
│   │   ├── Xml.class.php                             xml操作类
│   │   ├── core                                      核心库
│   │   │   ├── Loader.class.php                      自动加载类
│   │   │   ├── Mapping.class.php                     controller 注解映射类
│   │   │   ├── Router.class.php                      路由控制类
│   │   │   └── app
│   │   │       ├── DBDao.class.php                   Dao操作数据库层
│   │   │       ├── View.class.php                    view类
│   │   │       ├── ViewInterface.class.php           视图继承接口类
│   │   │       ├── exception                         全局异常默认处理类
│   │   │       │   ├── ExceptionController.class.php
│   │   │       │   └── ExceptionInterface.class.php
│   │   │       └── view                              html操作类
│   │   │           └── Element.class.php
│   │   └── db                                        数据库操作类（只支持mysql）
│   │       ├── Driver.class.php                      
│   │       ├── Exec.class.php
│   │       ├── Result.class.php
│   │       └── driver
│   │           └── Mysql.class.php
│   └── plugin                                         插件（支付更新了，有待添加）
│       ├── oauth2                                     wx跟qq登录库
│       │   ├── OAuth2.class.php
│       │   ├── OAuth2UserModel.class.php
│       │   ├── qq
│       │   │   └── QQOAuth2.class.php
│       │   └── wx
│       │       └── WXOAuth2.class.php
│       ├── qrcode                                     生成二维码库
│       │   ├── FrameFiller.class.php
│       │   ├── QRBitStream.class.php
│       │   ├── QRCode.class.php
│       │   ├── QREncode.class.php
│       │   ├── QRImage.class.php
│       │   ├── QRInput.class.php
│       │   ├── QRInputItem.class.php
│       │   ├── QRMask.class.php
│       │   ├── QRRawCode.class.php
│       │   ├── QRRsItem.class.php
│       │   ├── QRSpec.class.php
│       │   ├── QRSplit.class.php
│       │   ├── QRStr.class.php
│       │   ├── QRTools.class.php
│       │   ├── QRrs.class.php
│       │   └── QRrsBlock.class.php
│       └── wxsdk                                      微信开发类
│           ├── Mini.class.php
│           ├── Publicly.class.php
│           └── WXSdk.class.php
├── running                                            运行生成的文件目录
│   ├── build
│   │   └── view
│   │       └── index.php
│   └── router
│       ├── app.php
│       └── uri.php
├── scripts                                            全局脚本目录
│   └── database.generate.php                          用于生成数据库表模型的脚本
└── vendor                                             composer 包安装存放目录
    ├── autoload.php
    └── composer
        ├── ClassLoader.php
        ├── LICENSE
        ├── autoload_classmap.php
        ├── autoload_namespaces.php
        ├── autoload_psr4.php
        ├── autoload_real.php
        ├── autoload_static.php
        └── installed.json
~~~  

## 命名规范

`rapidPHP`遵循Camel-Case命名规范，自动加载规范，并且注意如下规范：

### 目录和文件

*   目录支持小写或大写，为了同一期间，赞成搭建目录全部使用小写，不赞成下滑写等特殊符号；
*   类库、函数文件统一以`.class.php`为后缀，类库首字母大写，文件名跟类库名一致；
*   类的文件名均以命名空间定义，并且命名空间的路径和类库文件所在路径一致；
*   类名和类文件名保持一致，统一采用驼峰法命名（首字母大写）；

### 函数和类、属性命名
*   类的命名采用驼峰法，并且首字母大写，格式 `NameType`、列如 `BaseController` 后面 `Controller`可有可无，但是为了统一期间，希望大家写进去；
*   函数的命名使用小写字母不赞成下划线 列入  `getUser`；
*   变量的命名使用驼峰法，并且首字母小写，例如 `tableName`、`instance`；
*   以双下划线“__”打头的函数或方法作为魔法方法，例如 `__call` 和 `__autoload`；

### 常量和配置
*   常量全部大写+下划线；
*   配置参数可以为静态 方法 、常量、成员；

## 参与开发
请参阅 [rapidPHP核心源码包](https://github.com/wgx954418992/rapid-php)。


## 版权信息

rapidPHP遵循Apache2开源协议发布，并提供免费使用。

本项目包含的第三方源码和二进制文件之版权信息另行标注。

版权所有Copyright © 2006-2016 by rapidPHP

All rights reserved。
