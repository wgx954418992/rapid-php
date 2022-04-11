<!DOCTYPE html>
<html lang="zh" data-controller="BaseController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>帮助列表</title>
    <link href="../../../../../public/res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../../../../../public/res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../../../../../public/res/layout/animate.min.css" rel="stylesheet">
    <link href="../../../../../public/res/layout/admin.css" rel="stylesheet">
    <link href="../../../../../public/res/layout/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
</head>

<?php

use apps\core\classier\bean\CMSArticleListCondition;
use apps\core\classier\model\CmsColumnModel;
use apps\core\classier\wrapper\cms\ArticleWrapper;
use function rapidPHP\VT;

/** @var CMSArticleListCondition $condition */
$condition = VT($this)->get('condition');

$pager = VT($this)->get()->toAB('pager');
?>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>帮助列表</h5>
                </div>
                <div class="ibox-content">
                    <form class="row" method="get">
                        <input type="hidden" value="<?= $condition->getOrderName() ?>" name="orderName">
                        <input type="hidden" value="<?= $condition->getOrderType() ?>" name="orderType">
                        <div class="col-sm-2">
                            <select title="状态" name="column_id" class="form-control input-s-sm inline">
                                <option value="0" <?= empty($condition->getColumnId()) ? 'selected' : '' ?>>全部栏目
                                </option>
                                <?php
                                /** @var CmsColumnModel $column */
                                foreach (VT($this)->get('columnList') as $column) :?>
                                    <option value='<?= $column->getId() ?>' <?= $column->getId() == $condition->getColumnId() ? 'selected' : '' ?>>
                                        <?= $column->getTitle() ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <input title="创建开始时间" name="start_time" type="text"
                                   autocomplete="off"
                                   placeholder="创建开始时间"
                                   value="<?= $condition->getStartTime() ?>"
                                   data-laydate='{"type": "datetime"}'
                                   class="laydate-icon form-control">
                        </div>
                        <div class="col-sm-2">
                            <input title="创建结束时间" name="end_time" type="text"
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
                            <th>文章id</th>
                            <th style="cursor: pointer;" data-order-name="help_id">
                                文章栏目
                            </th>
                            <th>
                                文章标题
                            </th>
                            <th style="cursor: pointer;" data-order-name="created_time">
                                创建时间
                            </th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        /** @var ArticleWrapper $value */
                        foreach (VT($this)->get('list') as $value) :?>
                            <tr>
                                <td><?= $value->getId() ?></td>
                                <td><?= $value->getColumn()->getTitle() ?></td>
                                <td><?= $value->getTitle() ?></td>
                                <td><?= $value->getCreatedTime() ?></td>
                                <td>
                                    <a data-iframe
                                       href='<?= VT($this)->toUrl('account/cms/article/added', ['id' => $value->getId()]) ?>'
                                       data-toggle='tooltip' title='修改文章信息'
                                       class='btn btn-white btn-bitbucket'>
                                        <i class='fa fa-edit'></i>
                                    </a>
                                    <a data-toggle='tooltip' title='删除文章'
                                       data-rapid
                                       data-rapid-on-click='del("cms/article","<?= $value->getId() ?>")'
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


<script src="../../../../../public/libs/jquery/jquery-2.1.1.min.js"></script>
<script src="../../../../../public/libs/bootstrap/bootstrap.min.js?v=3.4.0"></script>
<script src="../../../../../public/libs/plugins/layer/laydate/laydate.js"></script>
<script src="../../../../../public/libs/request.js"></script>
<script id="rapidJs" src="../../../../../public/libs/rapid.js"
        data-path-dir="../../../../../../../"
        data-path-app="../../../../../src/"></script>
</body>
</html>
