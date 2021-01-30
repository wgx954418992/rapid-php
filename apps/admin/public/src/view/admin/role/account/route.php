<!DOCTYPE html>
<html lang="zh" data-controller="BaseController|admin/role/account/RouteController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>权限列表</title>
    <link rel="shortcut icon" href="../../../../../../index.php">
    <link href="../../../../../res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../../../../../res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../../../../../res/layout/animate.min.css" rel="stylesheet">
    <link href="../../../../../res/layout/admin.css" rel="stylesheet">
    <link href="../../../../../res/layout/rapid.min.css" rel="stylesheet">
    <link href="../../../../../res/layout/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="../../../../../res/layout/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
</head>

<?php

use apps\admin\classier\wrapper\RouteWrapper;
use apps\core\classier\wrapper\AdminWrapper;
use function rapidPHP\VT;

$routes = VT($this)->get('routes');

/** @var AdminWrapper $admin */
$admin = VT($this)->get('admin');

/**
 * @param RouteWrapper[]|null $routes
 * @return string|null
 */
function __echoRoute(?array $routes): ?string
{
    if (empty($routes)) return null;

    $html = '<div class="rapid-mg-l" style="margin-top: 10px">';

    foreach ($routes as $route) {
        $check = $route->getRole() != null ? 'checked' : '';

        $html .= <<<HTML
            <div class='checkbox i-checks rapid-mg-l' title="{$route->getRemark()}">
                <label style='padding-left: 10px' title="{$route->getRemark()}">
                    <input name='check'
                           class="role"
                           title="{$route->getRemark()}"
                           data-id="{$route->getId()}"
                           data-pid="{$route->getParentId()}"
                           type='checkbox'
                           {$check}>
                    <i></i><h5 style="display: inline">{$route->getName()}</h5>
                </label>
            </div>
HTML;
        $children = $route->getChild();

        if (!empty($children)) $html .= __echoRoute($route->getChild());
    }

    return $html . '</div>';
}

?>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    权限列表
                </div>
                <div class="ibox-content">
                    <div class="form-horizontal" data-rapid data-rapid-form="form">
                        <input type="hidden" value="<?= $admin->getId() ?>" name="adminId">
                        <div class="form-group ">
                            <?= __echoRoute($routes) ?>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4">
                                <button class='btn btn-primary' type='button' data-rapid-form-submit='save'>
                                    保存
                                </button>
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
<script src="../../../../../libs/bootstrap/bootstrap-suggest.min.js"></script>
<script src="../../../../../libs/plugins/iCheck/icheck.min.js"></script>

<script src="../../../../../libs/plugins/layer/laydate/laydate.js"></script>
<script src="../../../../../libs/request.js"></script>
<script id="rapidJs" src="../../../../../libs/rapid.js" data-path-dir="../../../../../../"
        data-path-app="../../../../../src/"></script>
</body>
</html>