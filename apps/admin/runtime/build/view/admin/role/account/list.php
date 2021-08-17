<?php /** cache Time 2021-08-08 09:32:03 */ defined('PATH_APP') or die();?>
<!DOCTYPE html>
<html lang="zh" data-controller="BaseController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>子账号列表</title>
    <link rel="shortcut icon" href="http://localhost/guangying/code/light/apps/admin/index.php">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/animate.min.css" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/admin.css" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
</head>

<?php

use apps\core\classier\bean\AdminListCondition;
use apps\core\classier\config\AdminConfig;
use apps\core\classier\wrapper\AdminWrapper;
use function rapidPHP\VT;

/** @var AdminListCondition $condition */
$condition = VT($this)->get('condition');

$pager = VT($this)->get()->toAB('pager');

?>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>子账号列表</h5>
                </div>
                <div class="ibox-content">
                    <form class="row" method="get">
                        <input type="hidden" value="<?= $condition->getOrderName() ?>" name="orderName">
                        <input type="hidden" value="<?= $condition->getOrderType() ?>" name="orderType">
                        <input type="hidden" value="<?= $condition->getAdminId() ?>" name="adminId">
                        <div class="col-sm-2">
                            <select title="类型" name="type" class="form-control input-s-sm inline">
                                <option value="0" <?= empty($condition->getType()) ? 'selected' : '' ?>>全部类型
                                </option>
                                <?php foreach (AdminConfig::$types as $type => $text) : ?>
                                    <option value='<?= $type ?>' <?= $type == $condition->getType() ? 'selected' : '' ?>>
                                        <?= $text ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <input title="创建开始时间" name="startTime" type="text"
                                   autocomplete="off"
                                   placeholder="创建开始时间"
                                   value="<?= $condition->getStartTime() ?>"
                                   data-laydate='{"type": "datetime"}'
                                   class="laydate-icon form-control">
                        </div>
                        <div class="col-sm-2">
                            <input title="创建结束时间" name="endTime" type="text"
                                   autocomplete="off"
                                   placeholder="创建结束时间"
                                   value="<?= $condition->getEndTime() ?>"
                                   data-laydate='{"type": "datetime"}'
                                   class="laydate-icon form-control">
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input value="<?= $condition->getKeyword() ?>" name="keyword" type="text"
                                       placeholder="请输入关键词" class="form-control">
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
                            <th>管理员id</th>
                            <th style="cursor: pointer;" data-order-name="nickname">
                                管理员名称
                            </th>
                            <th style="cursor: pointer;" data-order-name="username">
                                管理员登录账号
                            </th>
                            <th style="cursor: pointer;" data-order-name="is_supreme">
                                是否超级管理员
                            </th>
                            <th style="cursor: pointer;" data-order-name="type">
                                类型
                            </th>
                            <th style="cursor: pointer;" data-order-name="parent_id">
                                创建人
                            </th>
                            <th>
                                子账号数量
                            </th>
                            <th>
                                备注
                            </th>
                            <th style="cursor: pointer;" data-order-name="created_time">
                                创建时间
                            </th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        /** @var AdminWrapper $value */
                        foreach ((array)VT($this)->get('list') as $value):?>
                            <tr>
                                <td><?= $value->getId() ?></td>
                                <td><?= $value->getNickname() ?></td>
                                <td><?= $value->getUsername() ?></td>
                                <td style="display: none">
                                    <div class='switch'>
                                        <div class='onoffswitch'>
                                            <input <?= $value->getIsSupreme() ? "checked" : "" ?>
                                                    type='checkbox'
                                                    data-path='account/<?= $value->getId() ?>/supreme/set'
                                                    class='onoffswitch-checkbox switch-btn'
                                                    id='switch-<?= $value->getId() ?>'>
                                            <label class='onoffswitch-label' for='switch-<?= $value->getId() ?>'>
                                                <span class='onoffswitch-inner'></span>
                                                <span class='onoffswitch-switch'></span>
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $value->getIsSupreme() ? '是' : '否' ?></td>
                                <td><?= $value->getEType() ?></td>
                                <td>
                                    <?php
                                    $creator = $value->getCreator();
                                    ?>
                                    <?php if ($creator != null): ?>
                                        <a data-iframe
                                           target='_blank'
                                           data-toggle='tooltip'
                                           title='查看创建者信息'
                                           href='<?= VT($this)->toUrl('admin/role/account/added', ['id' => $creator->getId()]) ?>'>
                                            <?= $creator->getNickname() ?>
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a data-iframe
                                       target='_blank'
                                       data-toggle='tooltip'
                                       title='查看创建的子账号'
                                       href='<?= VT($this)->toUrl('admin/role/account/list', ['adminId' => $value->getId()]) ?>'>
                                        <?= $value->getChildCount() ?>
                                    </a>
                                </td>
                                <td><?= $value->getRemark() ?></td>
                                <td><?= $value->getCreatedTime() ?></td>
                                <td>
                                    <a data-iframe
                                       href="<?= VT($this)->toUrl('admin/role/account/added', ['id' => $value->getId()]) ?>"
                                       data-toggle='tooltip'
                                       title='修改管理员信息'
                                       class='btn btn-white btn-bitbucket'>
                                        <i class='fa fa-edit'></i>
                                    </a>
                                    <a data-iframe
                                       href="<?= VT($this)->toUrl('admin/role/account/{adminId}/route/view', ['adminId' => $value->getId()]) ?>"
                                       data-toggle='tooltip'
                                       title='设置管理员权限'
                                       class='btn btn-white btn-bitbucket'>
                                        <i class='fa fa-power-off'></i>
                                    </a>
                                    <a data-toggle='tooltip' title='删除管理员'
                                       data-rapid
                                       data-rapid-on-click='del("role/account","<?= $value->getId() ?>")'
                                       class='btn btn-white btn-bitbucket'>
                                        <i class='fa fa-remove'></i>
                                    </a>
                                </td>
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
<script src="http://localhost/guangying/code/light/apps/admin/public/libs/request.js"></script>
<script id="rapidJs" src="http://localhost/guangying/code/light/apps/admin/public/libs/rapid.js" data-path-dir="http://localhost/guangying/code/light/apps/admin/"
        data-path-app="http://localhost/guangying/code/light/apps/admin/public/src/"></script>
</body>
</html>
