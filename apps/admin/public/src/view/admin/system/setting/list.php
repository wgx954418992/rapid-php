<?php

use apps\core\classier\model\AppSettingModel;
use function rapidPHP\VT;
?>
<!DOCTYPE html>
<html lang="zh" data-controller="BaseController|admin/system/setting/ListController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>系统设置</title>
    <link href="../../../../../res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../../../../../res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../../../../../res/layout/animate.min.css" rel="stylesheet">
    <link href="../../../../../res/layout/admin.css" rel="stylesheet">
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>系统设置</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 100px;">设置Id</th>
                                <th style="width: 180px;">类型</th>
                                <th style="width: 80px;">属性</th>
                                <th style="width: 300px;">值</th>
                                <th style="width: 220px;">备注</th>
                                <th style="width: 250px">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach (VT($this)->get('list') as $item):
                                /** @var AppSettingModel $value */
                                foreach ($item as $value): ?>
                                <tr data-rapid data-rapid-form>
                                    <td>
                                        <input disabled value='<?=$value->getId()?>' name="id" type='text' class='form-control' placeholder='Id'>
                                    </td>
                                    <td>
                                        <input  value='<?=$value->getType()?>' name="type" type='text' class='form-control' placeholder='类型'>
                                    </td>
                                    <td>
                                        <input  value='<?=$value->getAttribute()?>' name="attribute" type='text' class='form-control' placeholder='属性'>
                                    </td>
                                    <td>
                                        <input  value='<?=$value->getContent()?>' name="content" type='text' class='form-control' placeholder='值'>
                                    </td>
                                    <td>
                                        <input  value='<?=$value->getRemarks()?>' name="remarks" type='text' class='form-control' placeholder='备注'>
                                    </td>
                                    <td>
                                        <a data-rapid-form-submit="added" class='btn btn-info'>
                                        <i class='fa fa-save'></i> 保存
                                        </a>
                                        <a data-rapid data-rapid-on-click='del("system/setting","<?=$value->getId()?>")' class='btn btn-white btn-bitbucket'>
                                        <i class='fa fa-trash-o'></i> 删除
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach;endforeach; ?>
                            </tbody>
                        </table>
                        <div class="btn btn-info" data-toggle="modal" data-target="#modal">
                            <i class="fa fa-plus"></i> 添加设置
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
                <h4 class="modal-title">添加设置</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>类型</label>
                    <input data-rapid-form-isvalue="1" data-rapid-form-msg="类型必填" name="type" type="text"
                           placeholder="类型" class="form-control">
                </div>
                <div class="form-group">
                    <label>属性</label>
                    <input data-rapid-form-isvalue="1" data-rapid-form-msg="属性必填" name="attribute" type="text"
                           placeholder="属性" class="form-control">
                </div>
                <div class="form-group">
                    <label>值</label>
                    <input data-rapid-form-isvalue="1" data-rapid-form-msg="值必填" name="content" type="text"
                           placeholder="值" class="form-control">
                </div>
                <div class="form-group">
                    <label>备注</label>
                    <input name="remarks" type="text" placeholder="备注" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="submit" data-rapid-form-submit="added" class="btn btn-primary">保存</button>
            </div>
        </form>
    </div>
</div>

<script src="../../../../../libs/jquery/jquery-2.1.1.min.js"></script>
<script src="../../../../../libs/bootstrap/bootstrap.min.js?v=3.4.0"></script>
<script src="../../../../../libs/request.js"></script>
<script id="rapidJs" src="../../../../../libs/rapid.js" data-path-dir="../../../../../../"
        data-path-app="../../../../../src/"></script>
</body>
</html>
