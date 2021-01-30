<!DOCTYPE html>
<html lang="zh" data-controller="BaseController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>地址列表</title>
    <link rel="shortcut icon" href="../../../../../../index.php">
    <link href="../../../../../res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../../../../../res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../../../../../res/layout/animate.min.css" rel="stylesheet">
    <link href="../../../../../res/layout/admin.css" rel="stylesheet">
    <link href="../../../../../res/layout/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
</head>

<?php

use apps\core\classier\bean\AddressListCondition;
use apps\core\classier\config\AddressConfig;
use apps\core\classier\wrapper\AddressWrapper;
use function rapidPHP\VT;

/** @var AddressListCondition $condition */
$condition = VT($this)->get('condition');

?>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>地址列表</h5>
                    <div class="ibox-tools">
                        <a data-iframe data-w='480px' data-h='80%'
                           href='<?= VT($this)->toUrl('admin/user/address/added', ['bind_id' => $condition->getBindId()]) ?>'
                           title='添加地址'>
                            <i class='fa fa-plus'></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="row" method="get">
                        <input type="hidden" value="<?= $condition->getBindId() ?>" name="bind_id">
                        <input type="hidden" value="<?= $condition->getOrderName() ?>" name="orderName">
                        <input type="hidden" value="<?= $condition->getOrderType() ?>" name="orderType">
                        <div class="col-sm-2">
                            <select title="类型" name="type" class="input-sm form-control input-s-sm inline">
                                <option value="" <?= empty($condition->getType()) ? 'selected' : '' ?>>全部类型
                                </option>
                                <?php foreach (AddressConfig::TYPES as $value => $text):?>
                                    <option value='<?=$value?>' <?= ($value == $condition->getType() ? 'selected' : '')?>><?=$text?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <input title="添加开始时间" name="startTime" type="text"
                                   autocomplete="off"
                                   placeholder="添加开始时间"
                                   value="<?= $condition->getStartTime() ?>"
                                   data-laydate='{"type": "datetime"}'
                                   class="laydate-icon input-sm form-control">
                        </div>
                        <div class="col-sm-2">
                            <input title="添加结束时间" name="endTime" type="text"
                                   autocomplete="off"
                                   placeholder="添加结束时间"
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
                            data-page="1"
                            data-rapid-on-dblclick="pageToSort('<?= urlencode($condition->toJson()) ?>')">
                            <th>地址Id</th>
                            <th>名称</th>
                            <th>联系人</th>
                            <th style="cursor: pointer;" data-order-name="telephone">
                                联系人电话
                            </th>
                            <th>
                                座机号码
                            </th>
                            <th>
                                地址详情
                            </th>
                            <th>
                                邮编
                            </th>
                            <th>
                                类型
                            </th>
                            <th style="cursor: pointer;" data-order-name="created_time">
                                添加时间
                            </th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        /** @var AddressWrapper $value */
                        foreach (VT($this)->get('list') as $value) :?>
                            <tr>
                                <td><?= $value->getId() ?></td>
                                <td><?= $value->getName() ?></td>
                                <td><?= $value->getContactName() ?></td>
                                <td><?= $value->getTelephone() ?></td>
                                <td><?= $value->getLandline() ?></td>
                                <td><?= $value->getAddressDetail()->getAddress() ?><?= $value->getAddress() ?></td>
                                <td><?= $value->getPostcode() ?></td>
                                <td><?= AddressConfig::getTypeText($value->getType()) ?></td>
                                <td><?= $value->getCreatedTime() ?></td>
                                <td>
                                    <a data-iframe data-w='480px' data-h='80%'
                                       href='<?= VT($this)->toUrl('admin/user/address/added', ['id' => $value->getId(),'bind_id' => $value->getBindId()]) ?>'
                                       data-toggle='tooltip'
                                       title='修改地址信息'
                                       class='btn btn-white btn-bitbucket'>
                                        <i class='fa fa-edit'></i>
                                    </a>
                                    <a data-rapid data-rapid-on-click='del("user/address","<?= $value->getId() ?>")'
                                       style='display:  <?= (!$value->getIsDelete() ? "" : "none") ?>'
                                       data-toggle='tooltip'
                                       title='删除地址'
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


<script src="../../../../../libs/jquery/jquery-2.1.1.min.js"></script>
<script src="../../../../../libs/bootstrap/bootstrap.min.js?v=3.4.0"></script>
<script src="../../../../../libs/plugins/layer/laydate/laydate.js"></script>
<script src="../../../../../libs/request.js"></script>
<script id="rapidJs" src="../../../../../libs/rapid.js" data-path-dir="../../../../../../"
        data-path-app="../../../../../src/"></script>
</body>
</html>