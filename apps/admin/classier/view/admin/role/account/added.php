<!DOCTYPE html>
<html lang="zh" data-controller="BaseController|admin/role/account/AddedController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>编辑账号信息</title>
    <link rel="shortcut icon" href="../../../../../public/index.php">
    <link href="../../../../../public/res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../../../../../public/res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../../../../../public/res/layout/admin.css" rel="stylesheet">
    <link href="../../../../../public/res/layout/rapid.min.css" rel="stylesheet">
</head>
<?php

use apps\core\classier\config\AdminConfig;
use apps\core\classier\wrapper\AdminWrapper;
use function rapidPHP\VT;

/** @var AdminWrapper $adminModel */
$adminModel = VT($this)->get('data');
?>
<body class="gray-bg">

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑账号信息</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-horizontal" data-rapid data-rapid-form="form">
                        <div class="hr-line-dashed"></div>
                        <input type="hidden" value="true" name="submit">
                        <input type="hidden" value="<?= $adminModel->getId() ?>" name="id">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">账户信息</label>
                            <div class="col-sm-3">
                                <span class="help-block m-b-none">登录账号</span>
                                <input type="text" class="form-control rapid-mg-t" placeholder="登录账号"
                                       value="<?= $adminModel->getUsername() ?>" name="username"
                                       data-rapid-form-isvalue="1" data-rapid-form-msg="请输入登录账号!">
                            </div>
                            <div class="col-sm-3">
                                <span class="help-block m-b-none">密码（不填则不修改）</span>
                                <input type="text" class="form-control rapid-mg-t" placeholder="密码"
                                       value="" name="password">
                            </div>
                            <div class='col-sm-3 rapid-mg-r'>
                                <span class="help-block m-b-none">管理员类型</span>
                                <select title="类型" name="type" class="input-sm form-control input-s-sm inline rapid-mg-t">
                                    <?php foreach (AdminConfig::$types as $type => $text):?>
                                        <option value='<?=$type?>' <?=$type == $adminModel->getType() ? 'selected' : ''?>>
                                            <?=$text?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">基本信息</label>
                            <div class="col-sm-3">
                                <span class="help-block m-b-none">管理员姓名</span>
                                <input type="text" class="form-control rapid-mg-t" placeholder="管理员姓名"
                                       value="<?= $adminModel->getNickname() ?>" name="nickname"
                                       data-rapid-form-isvalue="1" data-rapid-form-msg="请输入管理员姓名!">
                            </div>
                            <div class="col-sm-6">
                                <span class="help-block m-b-none">备注</span>
                                <input type="text" class="form-control rapid-mg-t" placeholder="备注"
                                       value="<?= $adminModel->getRemark() ?>" name="remark">
                            </div>
                        </div>
                        <div class="form-group" style="display: none">
                            <label class="col-sm-1 control-label"></label>
                            <div class="col-sm-11">
                                <span class="help-block m-b-none">是否超级管理员</span>
                                <div class='switch rapid-mg-t'>
                                    <div class='onoffswitch'>
                                        <input <?=($adminModel->getIsSupreme() ? "checked" : "")?>
                                                type='checkbox'
                                                id="is_supreme"
                                                name="is_supreme"
                                                class='onoffswitch-checkbox'>
                                        <label class='onoffswitch-label' for='is_supreme'>
                                            <span class='onoffswitch-inner'></span>
                                            <span class='onoffswitch-switch'></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-1">
                                <button class='btn btn-primary' type='button' data-rapid-form-submit='added'>
                                    提交
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../../../../public/libs/jquery/jquery-2.1.1.min.js"></script>
<script src="../../../../../public/libs/plugins/layer/laydate/laydate.js"></script>
<script src="../../../../../public/libs/bootstrap/bootstrap.min.js"></script>
<script src="../../../../../public/libs/bootstrap/bootstrap-suggest.min.js"></script>

<script src="../../../../../public/libs/request.js"></script>
<script id="rapidJs" src="../../../../../public/libs/rapid.js" data-path-dir="../../../../../../"
        data-path-app="../../../../../src/"></script>
</body>
</html>
