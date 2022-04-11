<!DOCTYPE html>
<html lang="zh" data-controller="BaseController|account/user/AddedController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>发送通知</title>
    <link href="../../../../public/res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../../../../public/res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../../../../public/res/layout/admin.css" rel="stylesheet">
    <link href="../../../../public/res/layout/rapid.min.css" rel="stylesheet">
</head>
<?php

use apps\core\classier\enum\user\Gender;
use apps\core\classier\wrapper\UserWrapper;
use function rapidPHP\VT;

/** @var UserWrapper $userModel */
$userModel = VT($this)->get('data');
?>
<body class="gray-bg">

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>发送通知</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-horizontal" data-rapid data-rapid-form="form">
                        <div class="hr-line-dashed"></div>
                        <input type="hidden" value="true" name="submit">
                        <input type="hidden" value="<?= $userModel->getId() ?>" name="id">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">头像</label>
                            <div class="col-sm-11">
                                <?php $header = $userModel->getAvatar(); ?>
                                <div class="rapid-border rapid-align-center rapid-pd"
                                     style="width: 120px;min-height: 120px;cursor: pointer"
                                     data-rapid-form-name="head_fid"
                                     data-rapid-form-isvalue="1"
                                     data-rapid-form-msg="请选择用户头像!"
                                     data-rapid
                                     data-rapid-form-value="<?= $userModel->getHeadFid(); ?>"
                                     data-rapid-on-click='selectImgClick'>
                                    <?= empty($header) ? "<span>添加头像</span>" : "<img src='{$header}' class='rapid-width-full rapid-height-full'>" ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">账户信息</label>
                            <div class="col-sm-3">
                                <span class="help-block m-b-none">手机号码</span>
                                <input type="text" class="form-control rapid-mg-t" placeholder="手机号码"
                                       value="<?= $userModel->getTelephone() ?>" name="telephone">
                            </div>
                            <div class="col-sm-3">
                                <span class="help-block m-b-none">别名</span>
                                <input type="text" class="form-control rapid-mg-t" placeholder="别名"
                                       value="<?= $userModel->getNickname() ?>" name="nickname">
                            </div>
                            <div class="col-sm-3">
                                <span class="help-block m-b-none">用户名</span>
                                <input type="text" class="form-control rapid-mg-t" placeholder="用户名"
                                       value="<?= $userModel->getUsername() ?>" name="username">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">基本信息</label>
                            <div class='col-sm-3 rapid-mg-r'>
                                <span class="help-block m-b-none">性别</span>
                                <select class='form-control rapid-mg-t' title='性别' name="gender">
                                    <?php foreach (Gender::getConstantsWithStatic() as $item):?>
                                        <option value='<?=$item->getRawValue()?>' <?= $item->getRawValue() == $userModel->getGender() ? 'selected' : '' ?>>
                                            <?=$item?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <span class="help-block m-b-none">生日</span>
                                <input title="生日" name="birthday" type="text"
                                       autocomplete="off"
                                       placeholder="生日"
                                       value="<?= $userModel->getBirthday() ?>"
                                       data-laydate='{"type": "date"}'
                                       class="laydate-icon birthday input-sm form-control rapid-mg-t">
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
<script src="../../../../public/libs/jquery/jquery-2.1.1.min.js"></script>
<script src="../../../../public/libs/plugins/layer/laydate/laydate.js"></script>
<script src="../../../../public/libs/bootstrap/bootstrap.min.js"></script>
<script src="../../../../public/libs/bootstrap/bootstrap-suggest.min.js"></script>

<script src="../../../../public/libs/request.js"></script>
<script id="rapidJs" src="../../../../public/libs/rapid.js"
        data-path-dir="../../../../../../"
        data-path-app="../../../../src/"></script>
</body>
</html>
