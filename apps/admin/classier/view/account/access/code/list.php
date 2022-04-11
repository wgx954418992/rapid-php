<!DOCTYPE html>
<html lang="zh" data-controller="BaseController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>系统code</title>
    <link href="../../../../../public/res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../../../../../public/res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../../../../../public/res/layout/animate.min.css" rel="stylesheet">
    <link href="../../../../../public/res/layout/admin.css" rel="stylesheet">
    <link href="../../../../../public/res/layout/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
</head>

<?php

use apps\core\classier\model\AdminCodeModel;
use function rapidPHP\VT;
?>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>权限code</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>codeId</th>
                            <th>父id</th>
                            <th>
                                名称
                            </th>
                            <th>code</th>
                            <th>备注</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        /** @var AdminCodeModel $value */
                        foreach ((array)VT($this)->get('list') as $value):?>
                            <tr>
                                <td><?= $value->getId() ?></td>
                                <td><?= $value->getParentId() ?></td>
                                <td><?= $value->getName() ?></td>
                                <td><?= $value->getCode() ?></td>
                                <td><?= $value->getRemarks() ?></td>
                                <td>
                                    <a data-iframe
                                       href="<?= VT($this)->toUrl('account/access/code/added', ['id' => $value->getId()]) ?>"
                                       data-toggle='tooltip'
                                       title='修改code信息'
                                       class='btn btn-white btn-bitbucket'>
                                        <i class='fa fa-edit'></i>
                                    </a>
                                    <a data-toggle='tooltip' title='删除code'
                                       data-rapid
                                       data-rapid-on-click='del("access/code","<?= $value->getId() ?>")'
                                       class='btn btn-white btn-bitbucket'>
                                        <i class='fa fa-remove'></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="../../../../../public/libs/jquery/jquery-2.1.1.min.js"></script>
<script src="../../../../../public/libs/bootstrap/bootstrap.min.js?v=3.4.0"></script>
<script src="../../../../../public/libs/plugins/layer/laydate/laydate.js"></script>
<script src="../../../../../public/libs/request.js"></script>
<script id="rapidJs" src="../../../../../public/libs/rapid.js"
        data-path-dir="../../../../../../../"
        data-path-app="../../../../../src/"></script>
</body>
</html>
