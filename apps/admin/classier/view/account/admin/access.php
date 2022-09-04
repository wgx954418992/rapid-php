<!DOCTYPE html>
<html lang="zh" data-controller="BaseController|account/admin/AccessController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>权限列表</title>
    <link href="../../../../public/res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../../../../public/res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../../../../public/res/layout/animate.min.css" rel="stylesheet">
    <link href="../../../../public/res/layout/admin.css" rel="stylesheet">
    <link href="../../../../public/res/layout/rapid.min.css" rel="stylesheet">
    <link href="../../../../public/res/layout/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="../../../../public/res/layout/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
</head>

<?php

use apps\admin\classier\wrapper\admin\AccessWrapper;
use apps\admin\classier\wrapper\AdminWrapper;
use apps\core\classier\model\AdminCodeModel;
use function rapidPHP\AR;
use function rapidPHP\B;
use function rapidPHP\VT;

/** @var AdminWrapper $account */
$account = VT($this)->get('account');

/** @var AccessWrapper[] $access */
$access = VT($this)->get('access');

$codes = AR()->getTree(VT($this)->get('codes'), 'parent_id', 'id', 'children');

/**
 * @param array|null $codes
 * @param AccessWrapper[]|null $access
 * @return string|null
 */
function __echoRoute(?array $codes, ?array $access): ?string
{
    if (empty($codes)) return null;

    $html = '<div class="rapid-mg-l" style="margin-top: 10px">';

    foreach ($codes as $code) {
        try {
            $codeModel = new AdminCodeModel($code);

            $isAccess = !empty(array_filter($access, function ($item) use ($codeModel) {

                return $item->getCode() === $codeModel->getCode();
            }));

            $check = $isAccess ? 'checked' : '';

            $html .= <<<HTML
            <div class='checkbox i-checks rapid-mg-l' title="{$codeModel->getRemarks()}">
                <label style='padding-left: 10px' title="{$codeModel->getRemarks()}">
                    <input name='check'
                           class="role"
                           title="{$codeModel->getRemarks()}"
                           data-id="{$codeModel->getId()}"
                           data-pid="{$codeModel->getParentId()}"
                           type='checkbox'
                           {$check}>
                    <i></i><h5 style="display: inline">{$codeModel->getName()}</h5>
                </label>
            </div>
HTML;
            $children = B()->getData($code, 'children');

            if (!empty($children)) $html .= __echoRoute($children, $access);
        } catch (Exception $e) {

        }
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
                        <input type="hidden" value="<?= $account->getId() ?>" name="adminId">
                        <div class="form-group ">
                            <?= __echoRoute($codes, $access) ?>
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

<script src="../../../../public/libs/jquery/jquery-2.1.1.min.js"></script>
<script src="../../../../public/libs/bootstrap/bootstrap.min.js?v=3.4.0"></script>
<script src="../../../../public/libs/bootstrap/bootstrap-suggest.min.js"></script>
<script src="../../../../public/libs/plugins/iCheck/icheck.min.js"></script>

<script src="../../../../public/libs/plugins/layer/laydate/laydate.js"></script>
<script src="../../../../public/libs/request.js"></script>
<script id="rapidJs" src="../../../../public/libs/rapid.js" data-path-dir="../../../../../../"
        data-path-app="../../../../src/"></script>
</body>
</html>
