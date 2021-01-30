<!DOCTYPE html>
<html lang="zh" data-controller="BaseController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>企业列表</title>
    <link rel="shortcut icon" href="../../../../../../index.php">
    <link href="../../../../../res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../../../../../res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../../../../../res/layout/animate.min.css" rel="stylesheet">
    <link href="../../../../../res/layout/admin.css" rel="stylesheet">
    <link href="../../../../../res/layout/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
</head>

<?php

use apps\admin\classier\bean\CompanyListCondition;
use apps\core\classier\config\CompanyConfig;
use apps\admin\classier\wrapper\ViewCompanyWrapper;
use function rapidPHP\VT;

/** @var CompanyListCondition $condition */
$condition = VT($this)->get('condition');

$pager = VT($this)->get()->toAB('pager');

?>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>企业列表</h5>
                </div>
                <div class="ibox-content">
                    <form class="row" method="get">
                        <input type="hidden" value="<?= $condition->getOrderName() ?>" name="orderName">
                        <input type="hidden" value="<?= $condition->getOrderType() ?>" name="orderType">
                        <div class="col-sm-2">
                            <select title="是否删除" name="is_delete" class="input-sm form-control input-s-sm inline">
                                <option value="0" <?= !$condition->getIsDelete() ? 'selected' : '' ?>>否</option>
                                <option value="1" <?= $condition->getIsDelete() ? 'selected' : '' ?>>是</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select title="状态" name="status" class="input-sm form-control input-s-sm inline">
                                <option value="" <?= empty($condition->getStatus()) ? 'selected' : '' ?>>全部状态
                                </option>
                                <?php foreach (CompanyConfig::STATUS as $value => $text): ?>
                                    <option value='<?= $value ?>' <?= ($value == $condition->getStatus() ? 'selected' : '') ?>><?= $text ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <input title="注册开始时间" name="startTime" type="text"
                                   autocomplete="off"
                                   placeholder="注册开始时间"
                                   value="<?= $condition->getStartTime() ?>"
                                   data-laydate='{"type": "datetime"}'
                                   class="laydate-icon input-sm form-control">
                        </div>
                        <div class="col-sm-2">
                            <input title="注册结束时间" name="endTime" type="text"
                                   autocomplete="off"
                                   placeholder="注册结束时间"
                                   value="<?= $condition->getEndTime() ?>"
                                   data-laydate='{"type": "datetime"}'
                                   class="laydate-icon input-sm form-control">
                        </div>
                        <div class="col-sm-4">
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
                            <th>企业Id</th>
                            <th>Nickname</th>
                            <th>头像</th>
                            <th style="cursor: pointer;" data-order-name="email">
                                邮箱
                            </th>
                            <th style="cursor: pointer;" data-order-name="company_name">
                                企业名称
                            </th>
                            <th>
                                营业执照
                            </th>
                            <th style="cursor: pointer;" data-order-name="eori">
                                eori
                            </th>
                            <th style="cursor: pointer;" data-order-name="tva">
                                tva
                            </th>
                            <th style="cursor: pointer;" data-order-name="status">
                                状态
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
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        /** @var ViewCompanyWrapper $value */
                        foreach (VT($this)->get('list') as $value) :?>
                            <?php $displayName = $value->getCompanyName() ? $value->getCompanyName() : $value->getNickname(); ?>
                            <tr>
                                <td><?= $value->getId() ?></td>
                                <td><?= $value->getNickname() ?></td>
                                <td>
                                    <img src="<?= $value->getHeadPic() ?>" onerror="this.src='../../../../../res/assets/app_logo.png'"
                                         style="width: 40px;height: 40px;border-radius: 50%;border: 1px solid #ccc">
                                </td>
                                <td><?= $value->getEmail() ?></td>
                                <td><?= $value->getCompanyName() ?></td>
                                <td>
                                    <a data-iframe target='_blank'
                                       data-text='【<?= $displayName ?>】 公司的营业执照'
                                       data-toggle='tooltip' title='查看营业执照'
                                       href=' <?= $value->getBusinessPic() ?>'>
                                        <img src="<?= $value->getBusinessPic() ?>"
                                             style="width: 40px;border: 1px solid #ccc">
                                    </a>
                                </td>
                                <td><?= $value->getEori() ?></td>
                                <td><?= $value->getTva() ?></td>
                                <td>
                                    <?= $value->getIsDelete() ? '已删除' : ($value->getCompanyId() ? $value->getStatusText() : '未完善资料') ?>
                                </td>
                                <td>
                                    <a data-iframe target='_blank'
                                       data-text='【<?= $displayName ?>】 的登录记录'
                                       data-toggle='tooltip' title='查看登录记录'
                                       href='<?= VT($this)->toUrl('admin/user/{userId}/logs', $value->getId()) ?>'>
                                        <?= $value->getLoginCount() ?>
                                    </a>
                                </td>
                                <td><?= $value->getRegisterIp() ?></td>
                                <td><?= $value->getCreatedTime() ?></td>
                                <td>
                                    <a data-iframe data-w='480px' data-h='80%'
                                       style="display: <?= $value->getIsDelete() ? 'none' : '' ?>"
                                       href='<?= VT($this)->toUrl('admin/user/company/added', ['userId' => $value->getId()]) ?>'
                                       data-toggle='tooltip'
                                       title='查看或编辑【<?= $displayName ?>】的信息'
                                       class='btn btn-white btn-bitbucket'>
                                        <i class='fa fa-edit'></i>
                                    </a>
                                    <a data-iframe
                                       style="display: <?= $value->getIsDelete() ? 'none' : '' ?>"
                                       href='<?= VT($this)->toUrl('admin/user/address/list', ['bind_id' => $value->getId()]) ?>'
                                       data-toggle='tooltip'
                                       title='查看【<?= $displayName?>】地址列表'
                                       class='btn btn-white btn-bitbucket'>
                                        <i class='fa fa-list-alt'></i>
                                    </a>
                                    <a data-iframe
                                       style="display: <?= $value->getIsDelete() ? 'none' : '' ?>"
                                       href='<?= VT($this)->toUrl('admin/order/list', ['keyword' => $value->getId()]) ?>'
                                       data-toggle='tooltip'
                                       title='查看【<?= $displayName ?>】下面的所有订单'
                                       class='btn btn-white btn-bitbucket'>
                                        <i class='fa fa-vimeo'></i>
                                    </a>
                                    <a data-rapid
                                       data-rapid-on-click='sendUnifiedApi("user/company/<?= $value->getCompanyId() ?>/activation",null,null,"post")'
                                       style='display: <?= ($value->getStatus() == CompanyConfig::STATUS_WAITING ? "" : "none") ?>'
                                       data-toggle='tooltip'
                                       title='激活该企业'
                                       class='btn btn-white btn-bitbucket'>
                                        <i class='fa fa-heart'></i>
                                    </a>
                                    <a data-rapid data-rapid-on-click='sendUnifiedApi("user/<?= $value->getId() ?>/recover",null,null,"post")'
                                       style='display: <?= ($value->getIsDelete() ? "" : "none") ?>'
                                       data-toggle='tooltip'
                                       title='恢复企业'
                                       class='btn btn-white btn-bitbucket'>
                                        <i class='fa fa-newspaper-o'></i>
                                    </a>
                                    <a data-rapid data-rapid-on-click='del("user","<?= $value->getId() ?>")'
                                       style='display:  <?= (!$value->getIsDelete() ? "" : "none") ?>'
                                       data-toggle='tooltip'
                                       title='删除用户'
                                       class='btn btn-white btn-bitbucket'>
                                        <i class='fa fa-user-times'></i>
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


<script src="../../../../../libs/jquery/jquery-2.1.1.min.js"></script>
<script src="../../../../../libs/bootstrap/bootstrap.min.js?v=3.4.0"></script>
<script src="../../../../../libs/plugins/layer/laydate/laydate.js"></script>
<script src="../../../../../libs/request.js"></script>
<script id="rapidJs" src="../../../../../libs/rapid.js" data-path-dir="../../../../../../"
        data-path-app="../../../../../src/"></script>
</body>
</html>