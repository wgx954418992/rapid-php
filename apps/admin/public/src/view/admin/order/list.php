<!DOCTYPE html>
<html lang="zh" data-controller="BaseController|admin/order/ListController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>订单列表</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="../../../../res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../../../../res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../../../../res/layout/animate.min.css" rel="stylesheet">
    <link href="../../../../res/layout/admin.css" rel="stylesheet">
    <link href="../../../../res/layout/rapid.min.css" rel="stylesheet">
    <link href="../../../../res/layout/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
</head>

<?php

use apps\core\classier\bean\OrderListCondition;
use apps\core\classier\config\OrderConfig;
use apps\core\classier\wrapper\ViewOrderWrapper;
use function rapidPHP\VT;

/** @var OrderListCondition $condition */
$condition = VT($this)->get('condition');

$pager = VT($this)->get()->toAB('pager');
?>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>订单列表</h5>
                </div>
                <div class="ibox-content">
                    <form class="row" method="get">
                        <input type="hidden" value="<?= $condition->getOrderName() ?>" name="orderName">
                        <input type="hidden" value="<?= $condition->getOrderType() ?>" name="orderType">
                        <div class="col-sm-2">
                            <select title="状态" name="status" class="input-sm form-control input-s-sm inline">
                                <option value="0" <?= empty($condition->getStatus()) ? 'selected' : '' ?>>全部状态
                                </option>
                                <?php foreach (OrderConfig::STATUS as $status => $text) : ?>
                                    <option value='<?= $status ?>' <?= $status == $condition->getStatus() ? 'selected' : '' ?>><?= $text ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <input title="创建开始时间" name="startTime" type="text"
                                   autocomplete="off"
                                   placeholder="创建开始时间"
                                   value="<?= $condition->getStartTime() ?>"
                                   data-laydate='{"type": "datetime"}'
                                   class="laydate-icon input-sm form-control">
                        </div>
                        <div class="col-sm-2">
                            <input title="创建结束时间" name="endTime" type="text"
                                   autocomplete="off"
                                   placeholder="创建结束时间"
                                   value="<?= $condition->getEndTime() ?>"
                                   data-laydate='{"type": "datetime"}'
                                   class="laydate-icon input-sm form-control">
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input value="<?= $condition->getKeyword() ?>" name="keyword" type="text"
                                       placeholder="请输入关键词" class="input-sm form-control">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-sm btn-primary"> 搜索</button>
                                </span>
                            </div>
                        </div>
                    </form>
                    <table class="table table-striped">
                        <thead>
                        <tr data-rapid="th[data-order-name]" data-order-type="<?= $condition->getOrderType() ?>"
                            data-page="<?= $pager->toInt('current') ?>"
                            data-rapid-on-dblclick="pageToSort('<?= urlencode($condition->toJson()) ?>')">
                            <th>订单Id</th>
                            <th style="cursor: pointer;" data-order-name="company_name">
                                企业名称
                            </th>
                            <th>
                                货物数量
                            </th>
                            <th>
                                货物类型
                            </th>
                            <th>
                                取货码
                            </th>
                            <th>
                                入仓时间
                            </th>
                            <th>
                                倒仓时间
                            </th>
                            <th>
                                工厂信息
                            </th>
                            <th>
                                仓库信息
                            </th>
                            <th style="cursor: pointer;" data-order-name="status">
                                订单状态
                            </th>
                            <th style="cursor: pointer;" data-order-name="pay_status">
                                支付状态
                            </th>
                            <th style="cursor: pointer;" data-order-name="created_time">
                                创建时间
                            </th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        /** @var ViewOrderWrapper $value */
                        foreach (VT($this)->get('list') as $value) :?>
                            <tr>
                                <td><?= $value->getId() ?></td>
                                <td>
                                    <a data-iframe
                                       target='_blank'
                                       data-text='【<?= $value->getCompanyName() ?>】 的详细信息'
                                       data-toggle='tooltip'
                                       title='查看企业信息'
                                       href='<?= VT($this)->toUrl('admin/user/company/list', ['keyword' => $value->getUserId()]) ?>'>
                                        <?= $value->getCompanyName() ?>
                                    </a>
                                </td>
                                <td><?= $value->getNumber() ?></td>
                                <td><?= OrderConfig::getGoodsTypeText($value->getGoodsType()) ?></td>
                                <td><?= $value->getPickupCode() ?></td>
                                <td><?= $value->getInWtime() ?></td>
                                <td><?= $value->getReachWtime() ?></td>
                                <td>
                                    <a data-iframe
                                       data-w='420px'
                                       data-h='80%'
                                       target='_blank'
                                       data-text='查看修改【<?= $value->getFactoryCname() ?>】 的工厂信息'
                                       data-toggle='tooltip'
                                       title='查看修改工厂信息'
                                       href='<?= VT($this)->toUrl('admin/user/address/added', ['id' => $value->getFactoryId()]) ?>'>
                                        <?= $value->getFactoryName() ?>
                                        <br>
                                        <?= $value->getFactoryCname() ?>
                                        <br>
                                        <?= $value->getFactoryTelephone() ?>
                                        <br>
                                        <?= $value->getFactoryAdetail()->getAddress() ?> <?= $value->getFactoryAddress() ?>
                                    </a>
                                </td>
                                <td>
                                    <a data-iframe
                                       data-w='420px'
                                       data-h='80%'
                                       target='_blank'
                                       data-text='查看修改【<?= $value->getWarehouseCName() ?>】 的仓库信息'
                                       data-toggle='tooltip'
                                       title='查看修改仓库信息'
                                       href='<?= VT($this)->toUrl('admin/user/address/added', ['id' => $value->getWarehouseId()]) ?>'>
                                        <?= $value->getWarehouseName() ?>
                                        <br>
                                        <?= $value->getWarehouseCName() ?>
                                        <br>
                                        <?= $value->getWarehouseTelephone() ?>
                                        <br>
                                        <?php if ($value->getWarehouseAdetail()): ?>
                                            <?= $value->getWarehouseAdetail()->getAddress() ?> <?= $value->getWarehouseAddress() ?>
                                        <?php endif; ?>
                                    </a>
                                </td>
                                <td><?= $value->getStatusText() ?></td>
                                <td><?= $value->getPayStatusText() ?></td>
                                <td><?= $value->getCreatedTime() ?></td>
                                <td>
                                    <a data-rapid
                                       data-rapid-on-click='onSetOrderClick(<?= $value->toJson() ?>)'
                                       data-toggle='tooltip'
                                       title='修改订单信息'
                                       class='btn btn-white btn-bitbucket'>
                                        <i class='fa fa-edit'></i>
                                    </a>
                                    <a data-toggle='tooltip'
                                       title='删除订单'
                                       data-rapid
                                       data-rapid-on-click='del("order","<?= $value->getId() ?>")'
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

<div class="modal inmodal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form action="javascript:void(0)" class="modal-content" data-rapid data-rapid-form>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span><span class="sr-only">关闭</span>
                </button>
                <h4 class="modal-title">修改订单</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" name="id">
                <div class="form-group">
                    <label>订单状态</label>
                    <select data-rapid-form-isvalue="1"
                            data-rapid-form-msg="请选择状态"
                            name="status"
                            type="text"
                            class="form-control">
                        <?php foreach (OrderConfig::STATUS as $status => $text) : ?>
                            <option value='<?= $status ?>'><?= $text ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>支付状态</label>
                    <select data-rapid-form-isvalue="1"
                            data-rapid-form-msg="请选择状态"
                            name="pay_status"
                            type="text"
                            class="form-control">
                        <?php foreach (OrderConfig::PAY_STATUS as $status => $text) : ?>
                            <option value='<?= $status ?>'><?= $text ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>取货码(如果修改状态为等待取货，取货码必填)</label>
                    <input title="取货码"
                           name="pickup_code"
                           type="text"
                           autocomplete="off"
                           placeholder="取货码"
                           value=""
                           class="input-sm form-control">
                </div>
                <div class="form-group">
                    <label>入仓时间</label>
                    <input title="入仓时间"
                           name="in_wtime"
                           type="text"
                           autocomplete="off"
                           placeholder="入仓时间"
                           value=""
                           data-laydate='{"type": "datetime"}'
                           class="laydate-icon input-sm form-control">
                </div>
                <div class="form-group">
                    <label>到仓时间</label>
                    <input title="到仓时间"
                           name="reach_wtime"
                           type="text"
                           autocomplete="off"
                           placeholder="到仓时间"
                           value=""
                           data-laydate='{"type": "datetime"}'
                           class="laydate-icon input-sm form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="submit" data-rapid-form-submit="setOderInfo" class="btn btn-primary">提交</button>
            </div>
        </form>
    </div>
</div>

<script src="../../../../libs/jquery/jquery-2.1.1.min.js"></script>
<script src="../../../../libs/bootstrap/bootstrap.min.js?v=3.4.0"></script>
<script src="../../../../libs/plugins/layer/laydate/laydate.js"></script>
<script src="../../../../libs/request.js"></script>
<script id="rapidJs" src="../../../../libs/rapid.js" data-path-dir="../../../../../"
        data-path-app="../../../../src/"></script>
</body>
</html>