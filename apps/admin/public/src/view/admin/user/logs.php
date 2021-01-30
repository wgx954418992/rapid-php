<?php

use apps\core\classier\model\UserLogModel;
use function rapidPHP\VT;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>后台管理</title>
    <link href="../../../../res/layout/bootstrap.min.css" rel="stylesheet">
    <link href="../../../../res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../../../../res/layout/animate.min.css" rel="stylesheet">
    <link href="../../../../res/layout/admin.css" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="title row">
                            <h2 class="text-left col-sm-1">
                                <a href="javascript:history.go(-1)"
                                   class="fa fa-arrow-circle-o-left btn-outline btn"></a>
                            </h2>
                            <h2 class="text-center col-sm-11">登录记录</h2>
                        </div>
                        <div class="clients-list">
                            <div class="tab-content">
                                <div class="full-height-scroll">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>token</th>
                                                <th>ip</th>
                                                <th style="width: 70px;">登录方式</th>
                                                <th style="width: 180px;">登陆时间</th>
                                                <th>登录设备</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            /** @var UserLogModel $value */
                                            foreach (VT($this)->get('list') as $value):?>
                                                <tr>
                                                    <td><b><?=$value->getToken()?></b></td>
                                                    <td>
                                                        <?=$value->getIp()?>
                                                    </td>
                                                    <td><b><?=$value->getMode()?></b></td>
                                                    <td><b><?=$value->getCreatedTime()?></b></td>
                                                    <td><b><?=$value->getDevice()?></b></td>
                                                </tr>
                                            <?php endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>