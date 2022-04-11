<!DOCTYPE html>
<html lang="zh" data-controller="BaseController|account/access/code/AddedController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>编辑Code信息</title>
    <link href="../../../../../public/res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../../../../../public/res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../../../../../public/res/layout/admin.css" rel="stylesheet">
    <link href="../../../../../public/res/layout/rapid.min.css" rel="stylesheet">
</head>
<?php

use apps\core\classier\model\AdminCodeModel;
use function rapidPHP\VT;

/** @var AdminCodeModel $routeModel */
$routeModel = VT($this)->get('data');
?>
<body class="gray-bg">

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑Code信息</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-horizontal" data-rapid data-rapid-form="form">
                        <input type="hidden" value="true" name="submit">
                        <input type="hidden" value="<?= $routeModel->getId() ?>" name="id">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <span class="help-block m-b-none">父id</span>
                                <input type="text" class="form-control rapid-mg-t" placeholder="父id"
                                       value="<?= $routeModel->getParentId() ?>" name="parent_id">
                            </div>
                            <div class="col-sm-3">
                                <span class="help-block m-b-none">name</span>
                                <input type="text" class="form-control rapid-mg-t" placeholder="name"
                                       value="<?= $routeModel->getName() ?>" name="name"
                                       data-rapid-form-isvalue="1" data-rapid-form-msg="请输入name!">
                            </div>
                            <div class="col-sm-3">
                                <span class="help-block m-b-none">code</span>
                                <input type="text" class="form-control rapid-mg-t" placeholder="route"
                                       value="<?= $routeModel->getCode() ?>" name="code">
                            </div>
                            <div class="col-sm-3">
                                <span class="help-block m-b-none">备注</span>
                                <input type="text" class="form-control rapid-mg-t" placeholder="备注"
                                       value="<?= $routeModel->getRemarks() ?>" name="remarks">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4">
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
<script id="rapidJs" src="../../../../../public/libs/rapid.js"
        data-path-dir="../../../../../../../"
        data-path-app="../../../../../src/"></script>
</body>
</html>
