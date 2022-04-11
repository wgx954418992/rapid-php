<!DOCTYPE html>
<html lang="zh" data-controller="BaseController|account/system/BannerController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banner</title>
    <link href="../../../../public/res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../../../../public/res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../../../../public/res/layout/animate.min.css" rel="stylesheet">
    <link href="../../../../public/res/layout/admin.css" rel="stylesheet">
    <link href="../../../../public/res/layout/rapid.min.css" rel="stylesheet">
</head>

<?php

use apps\core\classier\wrapper\BannerWrapper;
use function rapidPHP\VT;

?>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Banner</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 100px;">id</th>
                                <th style="width: 180px;">标题</th>
                                <th style="width: 100px;">图片</th>
                                <th style="width: 120px;">类型</th>
                                <th style="width: 200px;">options</th>
                                <th style="width: 50px;">排序</th>
                                <th style="width: 100px">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            /** @var BannerWrapper $item */
                            foreach (VT($this)->get('list') as $item) :?>
                                <tr data-rapid data-rapid-form>
                                    <td>
                                        <input disabled value='<?= $item->getId() ?>'
                                               type='text'
                                               name="id"
                                               class='form-control'
                                               placeholder='id'>
                                    </td>
                                    <td>
                                        <input value='<?= $item->getTitle() ?>'
                                               type='text'
                                               name="title"
                                               data-rapid-form-isvalue="1"
                                               data-rapid-form-msg="标题必填"
                                               class='form-control'
                                               placeholder='标题'>
                                    </td>
                                    <td>
                                        <?php $header = $item->getPicUrl(); ?>
                                        <div class="rapid-align-center rapid-pd"
                                             style="width: 80px;cursor: pointer"
                                             data-rapid-form-name="file_id"
                                             data-rapid-form-isvalue="1"
                                             data-rapid-form-msg="请选择图片!"
                                             data-rapid
                                             data-rapid-form-value="<?= $item->getFileId(); ?>"
                                             data-rapid-on-click='selectImgClick'>
                                            <?= empty($header) ? "<span>添加图片</span>" : "<img src='{$header}' class='rapid-width-full'>" ?>
                                        </div>
                                    </td>
                                    <td>
                                        <select type='text'
                                                class='form-control'
                                                name="type"
                                                data-rapid-form-isvalue="1"
                                                data-rapid-form-msg="类型必选">
                                            <option value="1" <?= $item->getType() == 1 ? 'selected' : '' ?>>
                                                小程序首页
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <input style='resize: none' value='<?= $item->getOptions() ?>'
                                               type='text'
                                               name="options"
                                               class='form-control'
                                               placeholder='数据'>
                                    </td>
                                    <td>
                                        <input value='<?= $item->getRank() ?>'
                                               type='text'
                                               name="rank"
                                               class='form-control'
                                               placeholder='排序'>
                                    </td>
                                    <td>
                                        <a data-rapid
                                           data-rapid-form-submit="added"
                                           class='btn btn-info'>
                                            <i class='fa fa-save'></i> 保存
                                        </a>
                                        <a data-rapid
                                           data-rapid-on-click='del("system/banner","<?= $item->getId() ?>")'
                                           class='btn btn-white btn-bitbucket'>
                                            <i class='fa fa-trash-o'></i> 删除
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="btn btn-info" data-toggle="modal" data-target="#modal">
                            <i class="fa fa-plus"></i> 添加Banner
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
                <h4 class="modal-title">添加Banner</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>标题</label>
                    <input data-rapid-form-isvalue="1" data-rapid-form-msg="标题必填" name="title" type="text"
                           placeholder="标题" class="form-control">
                </div>
                <div class="form-group">
                    <label>图片</label>
                    <div class="rapid-border rapid-align-center rapid-pd"
                         style="cursor: pointer"
                         data-rapid-form-name="file_id"
                         data-rapid-form-isvalue="1"
                         data-rapid-form-msg="请选择图片!"
                         data-rapid
                         data-rapid-form-value="<?= $item->getFileId(); ?>"
                         data-rapid-on-click='selectImgClick'>
                        <span>添加图片</span>
                    </div>
                </div>
                <div class="form-group">
                    <label>类型</label>
                    <select data-rapid-form-isvalue="1" data-rapid-form-msg="类型必选" name="type" type="text"
                            title="类型" class="form-control">
                        <option value="1">小程序首页</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>options</label>
                    <textarea name="options"
                              placeholder="options" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>排序</label>
                    <input name="rank" type="text"
                           placeholder="排序(默认1)" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="submit" data-rapid-form-submit="added" class="btn btn-primary">保存</button>
            </div>
        </form>
    </div>
</div>

<script src="../../../../public/libs/jquery/jquery-2.1.1.min.js"></script>
<script src="../../../../public/libs/bootstrap/bootstrap.min.js?v=3.4.0"></script>
<script src="../../../../public/libs/request.js"></script>
<script id="rapidJs" src="../../../../public/libs/rapid.js"
        data-path-dir="../../../../../../"
        data-path-app="../../../../src/"></script>
</body>
</html>
