<?php /** cache Time 2021-08-08 09:42:02 */ defined('PATH_APP') or die();?>
<!DOCTYPE html>
<html lang="zh" data-controller="BaseController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户列表</title>
    <link rel="shortcut icon" href="http://localhost/guangying/code/light/apps/admin/public/src/view/admin/user/favicon.ico">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/animate.min.css" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/admin.css" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
</head>

<?php

use apps\admin\classier\bean\UserListCondition;
use apps\admin\classier\wrapper\UserWrapper;
use function rapidPHP\VT;

/** @var UserListCondition $condition */
$condition = VT($this)->get('condition');

$pager = VT($this)->get()->toAB('pager');

?>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>用户列表</h5>
                </div>
                <div class="ibox-content">
                    <form class="row" method="get">
                        <input type="hidden" value="<?= $condition->getOrderName() ?>" name="orderName">
                        <input type="hidden" value="<?= $condition->getOrderType() ?>" name="orderType">
                        <div class="col-sm-2">
                            <input title="注册开始时间" name="startTime" type="text"
                                   autocomplete="off"
                                   placeholder="注册开始时间"
                                   value="<?= $condition->getStartTime() ?>"
                                   data-laydate='{"type": "datetime"}'
                                   class="laydate-icon form-control">
                        </div>
                        <div class="col-sm-2">
                            <input title="注册结束时间" name="endTime" type="text"
                                   autocomplete="off"
                                   placeholder="注册结束时间"
                                   value="<?= $condition->getEndTime() ?>"
                                   data-laydate='{"type": "datetime"}'
                                   class="laydate-icon form-control">
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input value="<?= $condition->getKeyword() ?>" name="keyword" type="text"
                                       placeholder="open_id/用户名称" class="form-control">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary"> 搜索</button>
                                </span>
                            </div>
                        </div>
                    </form>
                    <table class="table table-striped">
                        <thead>
                        <tr data-rapid="th[data-order-name]" data-order-type="<?= $condition->getOrderType() ?>"
                            data-page="<?= $pager->toInt('current') ?>"
                            data-rapid-on-dblclick="pageToSort('<?= urlencode($condition->toJson()) ?>')">
                            <th>id</th>
                            <th>用户头像</th>
                            <th style="cursor: pointer;" data-order-name="nickname">
                                用户名称
                            </th>
                            <th>
                                书信数量
                            </th>
                            <th>
                                登录次数
                            </th>
                            <th style="cursor: pointer;" data-order-name="register_ip">
                                注册ip
                            </th>
                            <th style="cursor: pointer;" data-order-name="created_time">
                                注册时间
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        /** @var UserWrapper $value */
                        foreach (VT($this)->get('list') as $value) :?>
                            <tr>
                                <td><?= $value->getId() ?></td>
                                <td>
                                    <img src='<?= $value->getHeadUrl() ?>'
                                         onerror='this.src="http://localhost/guangying/code/light/apps/admin/public/res/assets/app_logo.png"'
                                         style='width: 30px;height: 30px;border-radius: 100%;border: 1px solid #dddddd'>
                                </td>
                                <td><?= $value->getNickname() ?></td>
                                <td>
                                    <a data-iframe
                                       href='<?= VT($this)->toUrl('admin/user/{userId}/letter', ['userId' => $value->getId()]) ?>'
                                       data-toggle='tooltip'
                                       title='查看书信列表'>
                                        <?= $value->getLetterCount() ?>
                                    </a>
                                </td>
                                <td>
                                    <a data-iframe
                                       target='_blank'
                                       data-text='【<?= $value->getNickname() ?>】 的登录记录'
                                       data-toggle='tooltip'
                                       title='查看登录记录'
                                       href='<?= VT($this)->toUrl('admin/user/{userId}/logs', $value->getId()) ?>'>
                                        <?= $value->getLoginCount() ?>
                                    </a>
                                </td>
                                <td><?= $value->getRegisterIp() ?></td>
                                <td><?= $value->getCreatedTime() ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="dataTables_info">
                                共：<?= VT($this)->get('count') ?>条记录，总共<?= $pager->toInt('total') ?>页，
                                当前第<?= $pager->toInt('current') ?>页
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="dataTables_paginate paging_simple_numbers">
                                <ul class="pagination">
                                    <li class='paginate_button previous'>
                                        <a href='<?= VT($this)->toUrl($condition, ['page' => $pager->toInt('previous')]) ?>'>上一页</a>
                                    </li>
                                    <?php foreach ($pager->toArray('list') as $value) : ?>
                                        <li class='paginate_button <?= $value['before'] ? 'active' : '' ?>'>
                                            <a href='<?= VT($this)->toUrl($condition, ['page' => $value['page']]) ?>'><?= $value['page'] ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                    <li class="paginate_button next">
                                        <a href='<?= VT($this)->toUrl($condition, ['page' => $pager->toInt('next')]) ?>'>下一页</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="http://localhost/guangying/code/light/apps/admin/public/libs/jquery/jquery-2.1.1.min.js"></script>
<script src="http://localhost/guangying/code/light/apps/admin/public/libs/bootstrap/bootstrap.min.js?v=3.4.0"></script>
<script src="http://localhost/guangying/code/light/apps/admin/public/libs/plugins/layer/laydate/laydate.js"></script>
<script src="http://localhost/guangying/code/light/apps/admin/public/libs/plugins/iCheck/icheck.min.js"></script>
<script src="http://localhost/guangying/code/light/apps/admin/public/libs/request.js"></script>
<script id="rapidJs" src="http://localhost/guangying/code/light/apps/admin/public/libs/rapid.js" data-path-dir="http://localhost/guangying/code/light/apps/admin/"
        data-path-app="http://localhost/guangying/code/light/apps/admin/public/src/"></script>
</body>
</html>
