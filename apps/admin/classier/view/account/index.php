<?php

use apps\admin\classier\wrapper\AdminWrapper;
use function rapidPHP\B;
use function rapidPHP\VT;

$routes = VT($this)->get('routes');

/** @var AdminWrapper $admin */
$admin = VT($this)->get('admin');
?>
<!DOCTYPE html>
<html data-controller="BaseController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>RapidPHP - 后台管理系统</title>
    <link href="../../../public/res/layout/bootstrap.min.css" rel="stylesheet">
    <link href="../../../public/res/layout/awesome.min.css" rel="stylesheet">
    <link href="../../../public/res/layout/animate.min.css" rel="stylesheet">
    <link href="../../../public/res/layout/admin.css" rel="stylesheet">
    <link href="../../../public/res/layout/plugins/iCheck/custom.css" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i></div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                       <span>
                        <img src='../../../public/res/assets/app_logo.png' style="max-width: 60px" class="img-circle">
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong
                                           class="font-bold"><?= $admin->getNickname() ?></strong></span>
                                <span class="text-muted text-xs block"><?= $admin->getRemark() ?><b
                                            class="caret"></b></span>
                                </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li>
                                <a class="J_menuItem"
                                   href="<?= VT($this)->toUrl('account/admin/added', ['id' => $admin->getId()]) ?>">修改信息</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="<?= VT($this)->toUrl('', ['exit' => 1]) ?>">安全退出</a>
                            </li>
                        </ul>
                    </div>
                    <div class="logo-element">RapidPHP</div>
                </li>

                <li>
                    <a class="J_menuItem"
                       href="<?= VT($this)->toUrl('account/home') ?>">
                        <i class="fa fa-home"></i>
                        <span class="nav-label">主页</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void (0)">
                        <i class="fa fa-users"></i>
                        <span class="nav-label">用户管理</span>
                        <span class="fa arrow"></span>
                    </a>

                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="<?= VT($this)->toUrl('account/user/list') ?>">用户列表</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void (0)">
                        <i class="fa fa-info"></i>
                        <span class="nav-label">信息管理</span>
                        <span class="fa arrow"></span>
                    </a>

                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="<?= VT($this)->toUrl('account/information/list') ?>">信息列表</a>
                        </li>
                    </ul>
                </li>

                <li style="display: none">
                    <a href="javascript:void (0)">
                        <i class="fa fa-send"></i>
                        <span class="nav-label">通知管理</span>
                        <span class="fa arrow"></span>
                    </a>

                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="<?= VT($this)->toUrl('account/notify/added') ?>">发送通知</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="<?= VT($this)->toUrl('account/notify/list') ?>">通知列表</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void (0)">
                        <i class="fa fa-calendar-minus-o"></i>
                        <span class="nav-label">CMS内容管理</span>
                        <span class="fa arrow"></span>
                    </a>

                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="<?= VT($this)->toUrl('account/cms/column/list') ?>">栏目列表</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="<?= VT($this)->toUrl('account/cms/article/list') ?>">文章列表</a>
                        </li>
                        <li>
                            <a class="J_menuItem"
                               href="<?= VT($this)->toUrl('account/cms/article/added') ?>">添加文章</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void (0)">
                        <i class="fa fa-gears"></i>
                        <span class="nav-label">系统设置</span>
                        <span class="fa arrow"></span>
                    </a>

                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="<?= VT($this)->toUrl('account/system/log/list') ?>">系统日志</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="<?= VT($this)->toUrl('account/system/setting/list') ?>">设置参数</a>
                        </li>
                        <li style="display: none">
                            <a class="J_menuItem"
                               href="<?= VT($this)->toUrl('account/system/banner/list') ?>">banner</a>
                        </li>
                        <li style="display: none">
                            <a class="J_menuItem" href="<?= VT($this)->toUrl('account/system/notice/list') ?>">通知设置</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void (0)">
                        <i class="fa fa-power-off"></i>
                        <span class="nav-label">权限管理</span>
                        <span class="fa arrow"></span>
                    </a>

                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem"
                               href="<?= VT($this)->toUrl('account/admin/list') ?>">子账号列表</a>
                        </li>
                    </ul>

                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem"
                               href="<?= VT($this)->toUrl('account/admin/added') ?>">添加子账号</a>
                        </li>
                    </ul>

                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem"
                               href="<?= VT($this)->toUrl('account/access/code/list') ?>">权限Code列表</a>
                        </li>
                    </ul>

                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem"
                               href="<?= VT($this)->toUrl('account/access/code/added') ?>">添加权限Code</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary "
                                              href="javascript:void(0)"><i
                                class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown hidden-xs" style="display: none">
                        <a class="right-sidebar-toggle" aria-expanded="false">
                            <i class="fa fa-tasks"></i> 设置
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <!--右侧部分开始-->
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:void (0);" class="active J_menuTab"
                       data-id="<?= VT($this)->toUrl('account/home') ?>">主页</a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>
                </button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabShowActive"><a>定位当前选项卡</a>
                    </li>
                    <li class="divider"></li>
                    <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                    </li>
                    <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                    </li>
                </ul>
            </div>
            <a href="<?= VT($this)->toUrl('', ['exit' => 1]) ?>" class="roll-nav roll-right J_tabExit"><i
                        class="fa fa fa-sign-out"></i>退出</a>
        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%"
                    src="<?= VT($this)->toUrl('account/home') ?>" frameborder="0"
                    data-id="<?= VT($this)->toUrl('account/home') ?>">
            </iframe>
        </div>
        <div class="footer">
            <div class="pull-right">RapidPHP后台管理系统。</div>
        </div>
    </div>
    <!--右侧部分结束-->
    <!--右侧边栏开始-->
    <div id="right-sidebar">
        <div class="sidebar-container">

            <ul class="nav nav-tabs navs-1">
                <li>
                    <a data-toggle="tab" href="#tab-1">
                        <i class="fa fa-gear"></i> 主题
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="tab-1" class="tab-pane">
                    <div class="sidebar-title">
                        <h3><i class="fa fa-comments-o"></i> 主题设置</h3>
                        <small><i class="fa fa-tim"></i> 你可以从这里选择和预览主题的布局和样式，这些设置会被保存在本地，下次打开的时候会直接应用这些设置。</small>
                    </div>
                    <div class="skin-setttings">
                        <div class="title">主题设置</div>
                        <div class="setings-item">
                            <span>收起左侧菜单</span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox"
                                           id="collapsemenu">
                                    <label class="onoffswitch-label" for="collapsemenu">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>固定顶部</span>

                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox"
                                           id="fixednavbar">
                                    <label class="onoffswitch-label" for="fixednavbar">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>固定宽度</span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox"
                                           id="boxedlayout">
                                    <label class="onoffswitch-label" for="boxedlayout">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- 全局js -->
<script src="../../../public/libs/jquery/jquery-2.1.1.min.js"></script>
<script src="../../../public/libs/bootstrap/bootstrap.min.js?v=3.4.0"></script>
<script src="../../../public/libs/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="../../../public/libs/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../../../public/libs/plugins/layer/layer.js"></script>
<script src="../../../public/libs/plugins/iCheck/icheck.min.js"></script>
<script src="../../../public/libs/jquery/jquery.admin.min.js"></script>
<script src="../../../public/libs/request.js"></script>
<script id="rapidJs" src="../../../public/libs/rapid.js"
        data-app-config="<?= urlencode(json_encode(VT($this)->get('config'))) ?>"
        data-path-dir="../../../../../"
        data-path-app="../../../src/"></script>
</body>
</html>
