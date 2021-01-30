<!DOCTYPE html>
<html lang="zh" data-controller="BaseController|admin/user/address/AddedController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>编辑地址信息</title>
    <link rel="shortcut icon" href="../../../../../../index.php">
    <link href="../../../../../res/layout/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../../../../../res/layout/awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../../../../../res/layout/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="../../../../../res/layout/admin.css" rel="stylesheet">
    <link href="../../../../../res/layout/rapid.min.css" rel="stylesheet">
</head>
<?php

use apps\core\classier\config\AddressConfig;
use apps\core\classier\model\AppAreaModel;
use apps\core\classier\wrapper\AddressWrapper;
use function rapidPHP\VT;

/** @var AddressWrapper $addressWrapper */
$addressWrapper = VT($this)->get('address');

$areaAddress = $addressWrapper->getAddressDetail();
?>
<body class="gray-bg">

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑地址信息</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-horizontal" data-rapid data-rapid-form="form">
                        <input type="hidden" name="submit" value="true">
                        <input type="hidden" name="id" value="<?= $addressWrapper->getId() ?>">
                        <input type="hidden" name="bind_id" value="<?= $addressWrapper->getBindId() ?>">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">基本信息</label>
                            <div class="col-sm-11 rapid-not-pd-l">
                                <div class="col-sm-12 rapid-not-pd-l">
                                    <div class="col-sm-3">
                                        <span class="help-block m-b-none">请选择类型</span>
                                        <select title="类型" name="type" class="input-sm form-control input-s-sm inline"
                                                data-rapid-form-isvalue="1"
                                                data-rapid-form-msg="请选择类型!">
                                            <?php foreach (AddressConfig::TYPES as $value => $text):?>
                                                <option value='<?=$value?>' <?= ($value == $addressWrapper->getType() ? 'selected' : '')?>><?=$text?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <span class="help-block m-b-none">请输入名称</span>
                                        <input type="text" class="form-control" placeholder="名称"
                                               value="<?= $addressWrapper->getName() ?>" name="name"
                                               data-rapid-form-isvalue="1"
                                               data-rapid-form-msg="请输入名称!">
                                    </div>
                                    <div class="col-sm-3">
                                        <span class="help-block m-b-none">请输入联系人名称</span>
                                        <input type="text" class="form-control" placeholder="联系人名称"
                                               value="<?= $addressWrapper->getContactName() ?>" name="contact_name"
                                               data-rapid-form-isvalue="1"
                                               data-rapid-form-msg="请输入联系人名称!">
                                    </div>
                                    <div class="col-sm-3">
                                        <span class="help-block m-b-none">请输入手机号码(请带上区号)</span>
                                        <input type="text" class="form-control" placeholder="手机号码"
                                               value="<?= $addressWrapper->getTcode() ?><?= $addressWrapper->getTelephone() ?>" name="telephone"
                                               data-rapid-form-isvalue="1"
                                               data-rapid-form-msg="请输入手机号码!">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">国家</label>
                            <div class="col-sm-11 rapid-not-pd-l">
                                <div class='col-sm-3'>
                                    <span class="help-block m-b-none">请选择国家</span>
                                    <select class='form-control' title='国家' data-rapid data-rapid-var="countryView"
                                            data-rapid-on-change="onCountryChange">
                                        <option value=''>请选择国家</option>
                                        <?php
                                        /** @var AppAreaModel $value */
                                        foreach (VT($this)->get('countryList') as $value):?>
                                            <option <?= ($value->getId() == ($areaAddress ? $areaAddress->getCountryId() : null) ? 'selected' : '') ?>
                                                    value='<?= $value->getId() ?>'>
                                                <?= $value->getName() ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class='col-sm-3'>
                                    <span class="help-block m-b-none">请选择城市</span>
                                    <select class='form-control' title='城市'
                                            data-rapid data-rapid-var="provinceView"
                                            name="area_id"
                                            data-rapid-form-isvalue="1"
                                            data-rapid-form-msg="请选择城市!">
                                        <?php
                                        /** @var AppAreaModel $value */
                                        foreach (VT($this)->get('provinceList') as $value):?>
                                            <option <?= ($value->getId() == ($areaAddress ? $areaAddress->getProvinceId() : null) ? 'selected' : '') ?>
                                                    value='<?= $value->getId() ?>'>
                                                <?= $value->getName() ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class='col-sm-3'>
                                    <span class="help-block m-b-none">请输入详细地址</span>
                                    <input type="text" class="form-control" placeholder="详细地址"
                                           value="<?= $addressWrapper->getAddress() ?>" name="address"
                                           data-rapid-form-isvalue="1"
                                           data-rapid-form-msg="请输入详细地址!">
                                </div>
                                <div class="col-sm-3">
                                    <span class="help-block m-b-none">请输入邮编</span>
                                    <input type="text" class="form-control" placeholder="邮编"
                                           value="<?= $addressWrapper->getPostcode() ?>" name="postcode"
                                           data-rapid-form-isvalue="1"
                                           data-rapid-form-msg="请输入邮编!">
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
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
<script src="../../../../../libs/jquery/jquery-2.1.1.min.js"></script>
<script src="../../../../../libs/plugins/layer/laydate/laydate.js"></script>
<script src="../../../../../libs/bootstrap/bootstrap.min.js"></script>
<script src="../../../../../libs/bootstrap/bootstrap-suggest.min.js"></script>
<script src="../../../../../libs/plugins/iCheck/icheck.min.js"></script>

<script src="../../../../../libs/request.js"></script>
<script id="rapidJs" src="../../../../../libs/rapid.js" data-path-dir="../../../../../../"
        data-path-app="../../../../../src/"></script>
</body>
</html>
