<!DOCTYPE html>
<html lang="zh" data-controller="BaseController|admin/user/company/AddedController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>编辑用户信息</title>
    <link rel="shortcut icon" href="../../../../../../index.php">
    <link href="../../../../../res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../../../../../res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../../../../../res/layout/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="../../../../../res/layout/admin.css" rel="stylesheet">
    <link href="../../../../../res/layout/rapid.min.css" rel="stylesheet">
</head>
<?php

use apps\core\classier\config\CompanyConfig;
use apps\core\classier\wrapper\user\CompanyWrapper;
use apps\core\classier\wrapper\UserWrapper;
use function rapidPHP\VT;

/** @var UserWrapper $userModel */
$userModel = VT($this)->get('user');

/** @var CompanyWrapper $companyModel */
$companyModel = VT($this)->get('company');

?>
<body class="gray-bg">

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>企业用户信息</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-horizontal" data-rapid data-rapid-form="form">
                        <div class="hr-line-dashed"></div>
                        <input type="hidden" value="true" name="submit">
                        <input type="hidden" value="<?= $userModel->getId() ?>" name="user[id]">
                        <input type="hidden" value="<?= $companyModel->getId() ?>" name="company[id]">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">基本信息</label>
                            <div class="col-sm-11 rapid-not-pd-l">
                                <div class="col-sm-12">
                                    <span class="help-block m-b-none rapid-pd-b">头像</span>
                                    <?php $header = $userModel->getHeadPic(); ?>
                                    <div class="rapid-border rapid-align-center rapid-pd"
                                         style="width: 120px;min-height: 120px;cursor: pointer"
                                         data-rapid-form-name="user[head_fid]"
                                         data-rapid-form-isvalue="1" data-rapid-form-msg="请选择用户头像!" data-rapid
                                         data-rapid-form-value=" <?= $userModel->getHeadFid(); ?>"
                                         data-rapid-on-click='selectImg'>
                                        <?= empty($header) ? "<span>添加头像</span>" : "<img src='{$header}' class='rapid-width-full rapid-height-full'>" ?>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <span class="help-block m-b-none">nickname</span>
                                    <input type="text" class="form-control" placeholder="nickname"
                                           value="<?= $userModel->getNickname() ?>" name="user[nickname]"
                                           data-rapid-form-isvalue="1"
                                           data-rapid-form-msg="请输入nickname!">
                                </div>
                                <div class="col-sm-3">
                                    <span class="help-block m-b-none">邮箱</span>
                                    <input type="text" class="form-control" placeholder="邮箱"
                                           value="<?= $userModel->getEmail() ?>" name="user[email]"
                                           data-rapid-form-isvalue="1"
                                           data-rapid-form-msg="请输入邮箱!">
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">企业信息</label>
                            <div class="col-sm-11 rapid-not-pd-l">
                                <div class="col-sm-12">
                                    <span class="help-block m-b-none rapid-pd-b">
                                         <a href="<?= $companyModel->getBusinessPic(); ?>" target="_blank">营业执照</a>
                                    </span>
                                    <?php $businessPic = $companyModel->getBusinessPic(); ?>
                                    <div class="rapid-border rapid-align-center rapid-pd"
                                         style="width: 120px;min-height: 120px;cursor: pointer"
                                         data-rapid-form-name="company[business_fid]"
                                         data-rapid-form-isvalue="1"
                                         data-rapid-form-msg="请选择企业营业执照!"
                                         data-rapid
                                         data-rapid-form-value=" <?= $companyModel->getBusinessFid(); ?>"
                                         data-rapid-on-click='selectImg'>
                                        <?= empty($businessPic) ? "<span>上传营业执照</span>" : "<img src='{$businessPic}' class='rapid-width-full rapid-height-full'>" ?>
                                    </div>
                                </div>
                                <div class="col-sm-12 rapid-not-pd-l rapid-pd-t">
                                    <div class="col-sm-3">
                                        <span class="help-block m-b-none">企业名称</span>
                                        <input type="text" class="form-control" placeholder="企业名称"
                                               value="<?= $companyModel->getCompanyName() ?>" name="company[company_name]"
                                               data-rapid-form-isvalue="1"
                                               data-rapid-form-msg="请输入企业名称!">
                                    </div>
                                    <div class="col-sm-3">
                                        <span class="help-block m-b-none">eori</span>
                                        <input type="text" class="form-control" placeholder="eori"
                                               value="<?= $companyModel->getEori() ?>" name="company[eori]"
                                               data-rapid-form-isvalue="1"
                                               data-rapid-form-msg="请输入eori!">
                                    </div>
                                    <div class="col-sm-3">
                                        <span class="help-block m-b-none">tva</span>
                                        <input type="text" class="form-control" placeholder="eori"
                                               value="<?= $companyModel->getTva() ?>" name="company[tva]"
                                               data-rapid-form-isvalue="1"
                                               data-rapid-form-msg="请输入tva!">
                                    </div>
                                    <div class="col-sm-3">
                                        <span class="help-block m-b-none">状态</span>
                                        <select title="状态" name="company[status]" class="input-sm form-control input-s-sm inline"
                                                data-rapid-form-isvalue="1"
                                                data-rapid-form-msg="请选择状态!">
                                            <?php foreach (CompanyConfig::STATUS as $value => $text):?>
                                                <option value='<?=$value?>' <?= ($value == $companyModel->getStatus() ? 'selected' : '')?>><?=$text?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<script src="../../../../../libs/jquery/jquery-2.1.1.min.js"></script>
<script src="../../../../../libs/plugins/layer/laydate/laydate.js"></script>
<script src="../../../../../libs/bootstrap/bootstrap.min.js"></script>
<script src="../../../../../libs/bootstrap/bootstrap-suggest.min.js"></script>
<script src="../../../../../libs/plugins/iCheck/icheck.min.js"></script>

<script src="../../../../../libs/request.js"></script>
<script id="rapidJs" src="../../../../../libs/rapid.js" data-path-dir="../../../../../../"
        data-path-app="../../../../../src/"></script>
</body>
</html>
