<!DOCTYPE html>
<html lang="zh" data-controller="BaseController|admin/role/route/AddedController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>编辑route信息</title>
    <link rel="shortcut icon" href="../../../../../../index.php">
    <link href="../../../../../res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../../../../../res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../../../../../res/layout/admin.css" rel="stylesheet">
    <link href="../../../../../res/layout/rapid.min.css" rel="stylesheet">
</head>
<?php

use apps\admin\classier\config\RouteConfig;
use apps\core\classier\model\AdminRouteModel;
use function rapidPHP\VT;

/** @var AdminRouteModel $routeModel */
$routeModel = VT($this)->get('data');
?>
<body class="gray-bg">

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑route信息</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-horizontal" data-rapid data-rapid-form="form">
                        <input type="hidden" value="true" name="submit">
                        <input type="hidden" value="<?= $routeModel->getId() ?>" name="id">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <span class="help-block m-b-none">name</span>
                                <input type="text" class="form-control rapid-mg-t" placeholder="name"
                                       value="<?= $routeModel->getName() ?>" name="name"
                                       data-rapid-form-isvalue="1" data-rapid-form-msg="请输入name!">
                            </div>
                            <div class="col-sm-3">
                                <span class="help-block m-b-none">route</span>
                                <input type="text" class="form-control rapid-mg-t" placeholder="route"
                                       value="<?= $routeModel->getRoute() ?>" name="route">
                            </div>
                            <div class='col-sm-3'>
                                <span class="help-block m-b-none">类型</span>
                                <select title="类型" name="type" class="input-sm form-control input-s-sm inline rapid-mg-t">
                                    <?php foreach (RouteConfig::$types as $type => $text): ?>
                                        <option value='<?= $type ?>' <?= $type == $routeModel->getType() ? 'selected' : '' ?>>
                                            <?= $text ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <span class="help-block m-b-none">备注</span>
                                <input type="text" class="form-control rapid-mg-t" placeholder="备注"
                                       value="<?= $routeModel->getRemark() ?>" name="remark">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                                <span class="help-block m-b-none">父id</span>
                                <input type="text" class="form-control rapid-mg-t" placeholder="父id"
                                       value="<?= $routeModel->getParentId() ?>" name="parent_id">
                            </div>
                            <div class="col-sm-3">
                                <span class="help-block m-b-none">排序</span>
                                <input type="text" class="form-control rapid-mg-t" placeholder="排序"
                                       value="<?= $routeModel->getRank() ? $routeModel->getRank() : 1 ?>" name="rank">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <span class="help-block m-b-none">options</span>
                                <textarea rows="3" class="form-control rapid-mg-t" placeholder="options" name="options"><?= $routeModel->getOptions() ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <span class="help-block m-b-none">是否系统</span>
                                <div class='switch rapid-mg-t'>
                                    <div class='onoffswitch'>
                                        <input <?= ($routeModel->getIsSystem() ? "checked" : "") ?>
                                                type='checkbox'
                                                id="is_system"
                                                name="is_system"
                                                class='onoffswitch-checkbox'>
                                        <label class='onoffswitch-label' for='is_system'>
                                            <span class='onoffswitch-inner'></span>
                                            <span class='onoffswitch-switch'></span>
                                        </label>
                                    </div>
                                </div>
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
<script src="../../../../../libs/jquery/jquery-2.1.1.min.js"></script>
<script src="../../../../../libs/plugins/layer/laydate/laydate.js"></script>
<script src="../../../../../libs/bootstrap/bootstrap.min.js"></script>
<script src="../../../../../libs/bootstrap/bootstrap-suggest.min.js"></script>

<script src="../../../../../libs/request.js"></script>
<script id="rapidJs" src="../../../../../libs/rapid.js" data-path-dir="../../../../../../"
        data-path-app="../../../../../src/"></script>
</body>
</html>
