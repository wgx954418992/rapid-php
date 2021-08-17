<?php /** cache Time 2021-08-08 09:25:10 */ defined('PATH_APP') or die();?>
<!DOCTYPE html>
<html lang="zh" data-controller="BaseController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>系统资源</title>
    <link rel="shortcut icon" href="http://localhost/guangying/code/light/apps/admin/index.php">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/animate.min.css" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/admin.css" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
</head>

<?php

use apps\admin\classier\bean\RouteListCondition;
use apps\admin\classier\config\RouteConfig;
use apps\core\classier\model\AdminRouteModel;
use function rapidPHP\VT;

/** @var RouteListCondition $condition */
$condition = VT($this)->get('condition');

?>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>系统资源</h5>
                </div>
                <div class="ibox-content">
                    <form class="row" method="get">
                        <input type="hidden" value="<?= $condition->getOrderName() ?>" name="orderName">
                        <input type="hidden" value="<?= $condition->getOrderType() ?>" name="orderType">
                        <div class="col-sm-2">
                            <select title="类型" name="type" class="form-control input-s-sm inline">
                                <option value="0" <?= empty($condition->getType()) ? 'selected' : '' ?>>全部类型
                                </option>
                                <?php foreach (RouteConfig::$types as $type => $text) : ?>
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
                            data-page="1"
                            data-rapid-on-dblclick="pageToSort('<?= urlencode($condition->toJson()) ?>')">
                            <th style="cursor: pointer;" data-order-name="id">资源id</th>
                            <th style="cursor: pointer;" data-order-name="parent_id">父id</th>
                            <th>
                                名称
                            </th>
                            <th style="cursor: pointer;" data-order-name="route">route</th>
                            <th style="cursor: pointer;" data-order-name="type">类型</th>
                            <th style="cursor: pointer;" data-order-name="is_system">
                                是否系统
                            </th>
                            <th>
                                备注
                            </th>
                            <th style="cursor: pointer;" data-order-name="rank">
                                排序
                            </th>
                            <th style="cursor: pointer;" data-order-name="created_time">
                                创建时间
                            </th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        /** @var AdminRouteModel $value */
                        foreach ((array)VT($this)->get('list') as $value):?>
                            <tr>
                                <td><?= $value->getId() ?></td>
                                <td><?= $value->getParentId() ?></td>
                                <td><?= $value->getName() ?></td>
                                <td><?= $value->getRoute() ?></td>
                                <td><?= RouteConfig::getTypeText($value->getType()) ?></td>
                                <td><?= $value->getIsSystem() ? '是' : '否' ?></td>
                                <td><?= $value->getRemark() ?></td>
                                <td><?= $value->getRank() ?></td>
                                <td><?= $value->getCreatedTime() ?></td>
                                <td>
                                    <a data-iframe
                                       href="<?= VT($this)->toUrl('admin/role/route/added', ['id' => $value->getId()]) ?>"
                                       data-toggle='tooltip'
                                       title='修改资源信息'
                                       class='btn btn-white btn-bitbucket'>
                                        <i class='fa fa-edit'></i>
                                    </a>
                                    <?php if (!$value->getIsSystem()): ?>
                                        <a data-toggle='tooltip' title='删除资源'
                                           data-rapid
                                           data-rapid-on-click='del("role/route","<?= $value->getId() ?>")'
                                           class='btn btn-white btn-bitbucket'>
                                            <i class='fa fa-remove'></i>
                                        </a>
                                    <?php endif; ?>
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


<script src="http://localhost/guangying/code/light/apps/admin/public/libs/jquery/jquery-2.1.1.min.js"></script>
<script src="http://localhost/guangying/code/light/apps/admin/public/libs/bootstrap/bootstrap.min.js?v=3.4.0"></script>
<script src="http://localhost/guangying/code/light/apps/admin/public/libs/plugins/layer/laydate/laydate.js"></script>
<script src="http://localhost/guangying/code/light/apps/admin/public/libs/request.js"></script>
<script id="rapidJs" src="http://localhost/guangying/code/light/apps/admin/public/libs/rapid.js" data-path-dir="http://localhost/guangying/code/light/apps/admin/"
        data-path-app="http://localhost/guangying/code/light/apps/admin/public/src/"></script>
</body>
</html>