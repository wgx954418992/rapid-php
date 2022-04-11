<!DOCTYPE html>
<html lang="zh" data-controller="BaseController|account/cms/article/AddedController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>编辑文章信息</title>
    <link href="../../../../../public/res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../../../../../public/res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../../../../../public/res/layout/admin.css" rel="stylesheet">
    <link href="../../../../../public/res/layout/rapid.min.css" rel="stylesheet">
    <link href="../../../../../public/res/layout/plugins/summernote/summernote.min.css" rel="stylesheet">
    <link href="../../../../../public/res/layout/plugins/summernote/summernote-bs3.css" rel="stylesheet">
</head>
<?php

use apps\core\classier\model\CmsArticleModel;
use apps\core\classier\wrapper\cms\ArticleWrapper;
use function rapidPHP\VT;

/** @var ArticleWrapper $articleModel */
$articleModel = VT($this)->get('article');

?>
<body class="gray-bg">

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑文章信息</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-horizontal" data-rapid data-rapid-form="form">
                        <div class="hr-line-dashed"></div>
                        <input type="hidden" value="true" name="submit">
                        <input type="hidden" value="<?= $articleModel->getId() ?>" name="id">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">标题</label>
                            <div class="col-sm-11">
                                <span class="help-block m-b-none">标题</span>
                                <input type="text" class="form-control rapid-mg-t" placeholder="标题"
                                       value="<?= $articleModel->getTitle() ?>" name="title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">栏目</label>
                            <div class='col-sm-3 rapid-mg-r'>
                                <span class="help-block m-b-none ">栏目</span>
                                <select title="栏目" name="column_id" class="input-sm form-control input-s-sm inline rapid-mg-t">
                                    <?php
                                    /** @var CmsArticleModel $value */
                                    foreach (VT($this)->get('columnList') as $value) :?>
                                        <option value='<?=$value->getId()?>'
                                            <?=($value->getId() == $articleModel->getColumnId() ? 'selected' : '')?>>
                                            <?=$value->getTitle()?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">内容</label>
                            <div class="col-sm-11">
                                <div class="summernote" id="summernote"><?= $articleModel->getContent() ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-1">
                                <button class='btn btn-primary' type='button' data-rapid-form-submit='added'>
                                    提交
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../../../../public/libs/jquery/jquery-2.1.1.min.js"></script>
<script src="../../../../../public/libs/plugins/layer/laydate/laydate.js"></script>
<script src="../../../../../public/libs/bootstrap/bootstrap.min.js"></script>
<script src="../../../../../public/libs/plugins/summernote/summernote.min.js"></script>
<script src="../../../../../public/libs/plugins/summernote/summernote-zh-CN.js"></script>
<script src="../../../../../public/libs/request.js"></script>
<script id="rapidJs" src="../../../../../public/libs/rapid.js"
        data-path-dir="../../../../../../../"
        data-path-app="../../../../../src/"></script>
</body>
</html>
