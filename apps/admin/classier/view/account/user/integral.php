<?php

use apps\core\classier\model\AppPointModel;
use apps\core\classier\model\PointDetailModel;
use function rapidPHP\VT;

/** @var AppPointModel $pointModel */
$pointModel = VT($this)->get('point');
?>
<!DOCTYPE html>
<html lang="zh" data-controller="BaseController|account/user/IntegralController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>后台管理</title>
    <link href="../../../../public/res/layout/bootstrap.min.css" rel="stylesheet">
    <link href="../../../../public/res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../../../../public/res/layout/animate.min.css" rel="stylesheet">
    <link href="../../../../public/res/layout/admin.css" rel="stylesheet">
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
                            <h2 class="text-center col-sm-11" data-toggle='tooltip'
                                title='只显示最新50条'>积分详情</h2>
                        </div>
                        <div class="clients-list">
                            <div class="tab-content">
                                <div class="full-height-scroll">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>点数</th>
                                                <th>详情</th>
                                                <th style="width: 180px;">操作时间</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            /** @var PointDetailModel $value */
                                            foreach (VT($this)->get('list') as $value): ?>
                                                <tr>
                                                    <td>
                                                        <b><?= $value->getNumber() > 0 ? '+' . $value->getNumber() : $value->getNumber() ?></b>
                                                    </td>
                                                    <td><b><?= $value->getDescribe() ?></b></td>
                                                    <td><b><?= $value->getCreatedTime() ?></b></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <table class="table invoice-total">
                                            <tbody>
                                            <tr>
                                                <td><strong>剩余积分：</strong></td>
                                                <td style="color: #55baff;text-decoration: underline"><?= $pointModel->getNumber() ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="text-right">
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#integral">
                                                更改积分
                                            </button>
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
</div>


<div class="modal inmodal fade" id="integral" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div data-rapid data-rapid-form="form" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                </button>
                <h4 class="modal-title">更改积分</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>赠送或减少积分</label>
                    <input name="bindId" type="hidden" value="<?= $pointModel->getBindId() ?>">
                    <input name="number" type="text" placeholder="正则累加，负则累减" class="form-control"
                           data-rapid-form-isvalue="1"
                           data-rapid-form-msg="积分点数必填">
                </div>
                <div class="form-group">
                    <label>详情</label>
                    <input name="describe" type="text" placeholder="详情" class="form-control"
                           data-rapid-form-isvalue="1"
                           data-rapid-form-msg="积分详情必填">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" data-rapid-form-submit="added">
                    保存
                </button>
            </div>
        </div>
    </div>
</div>

<script src="../../../../public/libs/jquery/jquery-2.1.1.min.js"></script>
<script src="../../../../public/libs/bootstrap/bootstrap.min.js?v=3.4.0"></script>
<script src="../../../../public/libs/request.js"></script>
<script id="rapidJs" src="../../../../public/libs/rapid.js"
        data-path-dir="../../../../../../"
        data-path-app="../../../../src/"></script>
</body>
</html>
