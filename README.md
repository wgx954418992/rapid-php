RapidPHP
===============

RapidPHP本着免费开源、快速、高效、简单的面向对象的 轻量级PHP开发框架。

>**版本:** `3.6.6`

## 命名规范

`rapidPHP`遵循Camel-Case命名规范，自动加载规范，并且注意如下规范：
### 目录和文件

*   目录支持小写或大写，为了同一期间，赞成搭建目录全部使用小写，不赞成下滑写等特殊符号；
*   类库、函数文件统一以`.php`为后缀，类库首字母大写，文件名跟类库名一致；
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

> RapidPHP 运行环境要求PHP7.1+。

## 安装

~~~
composer create-project wgx954418992/rapid-php
~~~

## 运行测试项目

*   导入数据库；

```
express-mini.sql
```
*   修改mysql连接配置跟redis连接配置；
```
/apps/core/application.yaml
```

*   访问api接口；
```
$host/apps/app/index.php
```
*   访问后台管理；
```
$host/apps/admin/index.php
```
*   启动消息队列；
```
php /apps/queue/index.php start
```
*   查看消息队列命令；
```
php /apps/queue/index.php
```

## 参与开发

直接提交PR或者Issue即可

## 版权信息

rapidPHP遵循MIT开源协议发布，并提供免费使用。

本项目包含的第三方源码和二进制文件之版权信息另行标注。

版权所有Copyright © 2020-2024 by rapidPHP

All rights reserved。