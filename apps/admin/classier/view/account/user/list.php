<!DOCTYPE html>
<html lang="zh" data-controller="BaseController|account/user/ListController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户列表</title>
    <link href="../../../../public/res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../../../../public/res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../../../../public/res/layout/animate.min.css" rel="stylesheet">
    <link href="../../../../public/res/layout/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="../../../../public/res/layout/admin.css" rel="stylesheet">
    <link href="../../../../public/res/layout/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
</head>

<?php

use apps\core\classier\bean\UserListCondition;
use apps\admin\classier\wrapper\UserWrapper;
use apps\core\classier\enum\user\major\Status;
use apps\core\classier\enum\user\Gender;
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
                        <input type="hidden" value="<?= $condition->getOrderName() ?>" name="order_name">
                        <input type="hidden" value="<?= $condition->getOrderType() ?>" name="order_type">
                        <div class="col-sm-1"
                             style="display: none">
                            <a data-iframe title="给所有用户发送通知" href='<?= VT($this)->toUrl('account/notify/added') ?>'
                               class='btn btn-sm btn-danger'>
                                <i class='fa fa-send'></i> 发送通知
                            </a>
                        </div>
                        <div class="col-sm-2">
                            <input title="注册开始时间" name="start_time" type="text"
                                   autocomplete="off"
                                   placeholder="注册开始时间"
                                   value="<?= $condition->getStartTime() ?>"
                                   data-laydate='{"type": "datetime"}'
                                   class="laydate-icon form-control">
                        </div>
                        <div class="col-sm-2">
                            <input title="注册结束时间" name="end_time" type="text"
                                   autocomplete="off"
                                   placeholder="注册结束时间"
                                   value="<?= $condition->getEndTime() ?>"
                                   data-laydate='{"type": "datetime"}'
                                   class="laydate-icon form-control">
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input value="<?= $condition->getKeyword() ?>" name="keyword" type="text"
                                       placeholder="用户名称/手机号码" class="form-control">
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
                            <th>用户Id</th>
                            <th>头像</th>
                            <th style="cursor: pointer;" data-order-name="nickname">
                                名称
                            </th>
                            <th style="cursor: pointer;" data-order-name="telephone">
                                手机号码
                            </th>
                            <th style="cursor: pointer;" data-order-name="birthday">
                                年龄
                            </th>
                            <th style="cursor: pointer;" data-order-name="gender">
                                性别
                            </th>
                            <th>
                                积分
                            </th>
                            <th>
                                登录次数
                            </th>
                            <th style="cursor: pointer;" data-order-name="created_time">
                                注册时间
                            </th>
                            <th style="cursor: pointer;" data-order-name="register_ip">
                                注册ip
                            </th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        /** @var UserWrapper $value */
                        foreach (VT($this)->get('list') as $value) : ?>
                        <tr>
                            <td><?= $value->getId() ?></td>
                            <td data-rapid="img"
                                data-rapid-on-click="previewImage">
                                <img data-original='<?= $value->getAvatar() ?: "../../../../res/assets/app_logo.png" ?>'
                                     class="lazy"
                                     style='width: 30px;height: 30px;border-radius: 100%;cursor: pointer'>
                            </td>
                            <td>
                                <span data-toggle='tooltip' title='<?= $value->getExplain() ?>'>
                                    <?= $value->getDisplayName() ?>
                                </span>
                            </td>
                            <td><?= $value->getTelephone() ?></td>
                            <td><?= $value->getAge() ?></td>
                            <td><?= Gender::i($value->getGender()) ?></td>
                            <td>
                                <?php if ($value->getIntegral()): ?>
                                    <span><?= $value->getIntegral()->getNumber() ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a data-iframe
                                   target='_blank'
                                   data-text='【<?= $value->getNickname() ?>】 的登录记录'
                                   data-toggle='tooltip' title='查看登录记录'
                                   href='<?= VT($this)->toUrl("account/user/{$value->getId()}/logs") ?>'>
                                    <?= $value->getLoginCount() ?>
                                </a>
                            </td>
                            <td><?= $value->getCreatedTime() ?></td>
                            <td><?= $value->getRegisterIp() ?></td>
                            <td>
                                <a data-iframe
                                   href="<?= VT($this)->toUrl('account/user/added', ['id' => $value->getId()]) ?>"
                                   data-toggle='tooltip'
                                   title='修改用户信息'
                                   class='btn btn-white btn-bitbucket'>
                                    <i class='fa fa-edit'></i>
                                </a>
                                <a data-iframe
                                   style="display: none"
                                   href='<?= VT($this)->toUrl('account/notify/added', ['receiver_id' => $value->getId()]) ?>'
                                   data-toggle='tooltip' title='发送通知' class='btn btn-white btn-bitbucket'>
                                    <i class='fa fa-send'></i>
                                </a>
                                <?php if ($value->getSpecificMajor()): ?>
                                    <a data-iframe
                                       href='<?= VT($this)->toUrl('account/user/certificates/list', ['user_id' => $value->getId()]) ?>'
                                       data-toggle='tooltip' title='资质详情' class='btn btn-white btn-bitbucket'>
                                        <i class='fa fa-certificate'></i>
                                    </a>
                                <?php endif; ?>
                                <a data-iframe
                                   style="display: none"
                                   href='<?= VT($this)->toUrl('account/user/integral/{userId}/details', ['userId' => $value->getId()]) ?>'
                                   data-toggle='tooltip' title='积分详情' class='btn btn-white btn-bitbucket'>
                                    <i class='fa fa-google-wallet'></i>
                                </a>
                                <a data-iframe
                                   href='<?= VT($this)->toUrl('account/user/wallet/{userId}/details', ['userId' => $value->getId()]) ?>'
                                   data-toggle='tooltip' title='钱包明细' class='btn btn-white btn-bitbucket'>
                                    <i class='fa fa-contao'></i>
                                </a>
                                <a data-iframe
                                   href='<?= VT($this)->toUrl('account/information/list', ['keyword' => $value->getId()]) ?>'
                                   data-toggle='tooltip' title='信息列表' class='btn btn-white btn-bitbucket'>
                                    <i class='fa fa-info'></i>
                                </a>
                                <a data-toggle='tooltip' title='删除用户'
                                   data-rapid
                                   data-rapid-on-click='del("user","<?= $value->getId() ?>")'
                                   class='btn btn-white btn-bitbucket'>
                                    <i class='fa fa-user-times'></i>
                                </a>
                            </td>
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


<script src="../../../../public/libs/jquery/jquery-2.1.1.min.js"></script>
<script src="../../../../public/libs/jquery/jquery.lazyload.js"></script>
<script src="../../../../public/libs/bootstrap/bootstrap.min.js?v=3.4.0"></script>
<script src="../../../../public/libs/plugins/layer/laydate/laydate.js"></script>
<script src="../../../../public/libs/plugins/iCheck/icheck.min.js"></script>
<script src="../../../../public/libs/request.js"></script>
<script id="rapidJs" src="../../../../public/libs/rapid.js"
        data-path-dir="../../../../../../"
        data-path-app="../../../../src/"></script>
</body>
</html>
