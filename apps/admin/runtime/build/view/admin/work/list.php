<?php /** cache Time 2021-08-08 10:48:26 */ defined('PATH_APP') or die();?>
<!DOCTYPE html>
<html lang="zh" data-controller="BaseController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>作品列表</title>
    <link rel="shortcut icon" href="http://localhost/guangying/code/light/apps/admin/public/src/view/admin/work/favicon.ico">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/animate.min.css" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/admin.css" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/rapid.min.css" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/swiper.min.css" rel="stylesheet">
    <link href="http://localhost/guangying/code/light/apps/admin/public/res/layout/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
</head>

<?php

use apps\core\classier\bean\WorkListCondition;
use apps\core\classier\config\ResourceConfig;
use apps\core\classier\enum\work\Type;
use apps\core\classier\wrapper\WorkWrapper;
use function rapidPHP\VT;

/** @var WorkListCondition $condition */
$condition = VT($this)->get('condition');

$pager = VT($this)->get()->toAB('pager');

?>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>作品列表</h5>
                </div>
                <div class="ibox-content">
                    <form class="row" method="get">
                        <input type="hidden" value="<?= $condition->getOrderName() ?>" name="orderName">
                        <input type="hidden" value="<?= $condition->getOrderType() ?>" name="orderType">
                        <div class="col-sm-2">
                            <input title="发布开始时间" name="start_time" type="text"
                                   autocomplete="off"
                                   placeholder="发布开始时间"
                                   value="<?= $condition->getStartTime() ?>"
                                   data-laydate='{"type": "datetime"}'
                                   class="laydate-icon form-control">
                        </div>
                        <div class="col-sm-2">
                            <input title="发布结束时间" name="end_time" type="text"
                                   autocomplete="off"
                                   placeholder="发布结束时间"
                                   value="<?= $condition->getEndTime() ?>"
                                   data-laydate='{"type": "datetime"}'
                                   class="laydate-icon form-control">
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input value="<?= $condition->getKeyword() ?>" name="keyword" type="text"
                                       placeholder="id/作品标题/用户名称" class="form-control">
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
                            <th>作者</th>
                            <th style="cursor: pointer;" data-order-name="type">
                                作品类型
                            </th>
                            <th style="cursor: pointer;" data-order-name="like_count">
                                点赞量
                            </th>
                            <th style="cursor: pointer;" data-order-name="comment_count">
                                评论量
                            </th>
                            <th style="cursor: pointer;" data-order-name="collection_count">
                                收藏量
                            </th>
                            <th style="cursor: pointer;" data-order-name="title">
                                作品内容
                            </th>
                            <th>
                                作品封面
                            </th>
                            <th style="cursor: pointer;" data-order-name="created_time">
                                发布时间
                            </th>
                            <th>
                                操作
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        /** @var WorkWrapper $value */
                        foreach (VT($this)->get('list') as $value) :?>
                            <tr>
                                <td><?= $value->getId() ?></td>
                                <td>
                                    <img src='<?= $value->getUser()->getHeadUrl() ?>'
                                         onerror='this.src="http://localhost/guangying/code/light/apps/admin/public/res/assets/app_logo.png"'
                                         style='width: 30px;height: 30px;border-radius: 100%;border: 1px solid #dddddd'>

                                    <?= $value->getUser()->getDisplayName() ?>
                                </td>
                                <td><?= new Type($value->getType()) ?></td>
                                <td><?= $value->getLikeCount() ?></td>
                                <td><?= $value->getCommentCount() ?></td>
                                <td><?= $value->getCollectionCount() ?></td>
                                <td><?= $value->getTitle() ?></td>
                                <td>
                                    <div class="app-swiper swiper-container" style="width: 150px">
                                        <div class="swiper-wrapper rapid-width-full">
                                            <?php foreach ($value->getResources() as $resource): ?>
                                                <div class="swiper-slide rapid-width-full">
                                                    <?php if ($resource->getFileType() == ResourceConfig::FILE_TYPE_PIC): ?>
                                                        <img src='<?= $resource->getUrl() ?>'
                                                             onerror='this.src="http://localhost/guangying/code/light/apps/admin/public/res/assets/app_logo.png"'
                                                             class="rapid-width-full">
                                                    <?php elseif ($resource->getFileType() == ResourceConfig::FILE_TYPE_VIDEO): ?>
                                                        <video controls class="rapid-width-full">
                                                            <source src="<?= $resource->getUrl() ?>"/>
                                                        </video>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $value->getCreatedTime() ?></td>
                                <td>
                                    <?php if ($value->getIsPr()): ?>
                                        <a data-toggle='tooltip'
                                           title='取消发现页推荐'
                                           data-rapid
                                           data-rapid-on-click='sendUnifiedApi("work/<?= $value->getId() ?>/pr/set",<?= json_encode(['is' => false]) ?>,null,"post",null)'
                                           class='btn btn-white btn-bitbucket'>
                                            <i class='fa fa-remove'></i>
                                        </a>
                                    <?php else: ?>
                                        <a data-toggle='tooltip'
                                           title='推荐到发现页'
                                           data-rapid
                                           data-rapid-on-click='sendUnifiedApi("work/<?= $value->getId() ?>/pr/set",<?= json_encode(['is' => true]) ?>,null,"post",null)'
                                           class='btn btn-white btn-bitbucket'>
                                            <i class='fa fa-check'></i>
                                        </a>
                                    <?php endif; ?>
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
<script src="http://localhost/guangying/code/light/apps/admin/public/libs/plugins/iCheck/icheck.min.js"></script>
<script src="http://localhost/guangying/code/light/apps/admin/public/libs/swiper.min.js"></script>
<script src="http://localhost/guangying/code/light/apps/admin/public/libs/request.js"></script>
<script id="rapidJs" src="http://localhost/guangying/code/light/apps/admin/public/libs/rapid.js" data-path-dir="http://localhost/guangying/code/light/apps/admin/"
        data-path-app="http://localhost/guangying/code/light/apps/admin/public/src/"></script>
</body>
</html>
