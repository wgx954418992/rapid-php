<?php /** cache Time 2021-08-16 04:35:09 */ defined('PATH_APP') or die();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>光影 - 后台管理系统</title>
    <link href="http://localhost/farming/code/farming/apps/admin/public/res/layout/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/farming/code/farming/apps/admin/public/res/layout/animate.min.css" rel="stylesheet">
    <link href="http://localhost/farming/code/farming/apps/admin/public/res/layout/admin.css" rel="stylesheet">
    <style type="text/css">
        .background {
            background: url("http://localhost/farming/code/farming/apps/admin/public/res/assets/admin_login_background.jpg") no-repeat center;
            background-size: cover;
        }

        .background > .login {
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: rgba(0, 0, 0, 0.2);
        }

        .background > .login > .form {
            max-width: 600px;
            z-index: 100;
            margin: 0 auto;
            padding-top: 40px
        }

        .background > .login > .form > .title {
            color: #FFFFFF;
        }

        .background > .login > .form input {
            width: 100%;
            color: #969696;
            height: auto;
            padding: 15px 10px;
            border-radius: 3px;
            background: transparent;
            border: 1px solid #969696;
        }

        .background > .login > .form button {
            width: 100%;
            padding: 12px 10px;
            border-radius: 3px;
        }
    </style>
</head>
<body class="gray-bg background">
<div class="login text-center loginscreen">
    <div class="form animated fadeInDownBig">
        <div>
            <h1 class="logo-name" style="font-size: 100px">
                <img src='http://localhost/farming/code/farming/apps/admin/public/res/assets/app_logo.png' style="max-width: 110px;margin-bottom: 10px;border-radius: 100%">
            </h1>
        </div>
        <h3 class="title">光影 - 后台管理系统</h3>

        <form class="m-t" role="form" method="post">
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="用户名" required autocomplete="off">
            </div>
            <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="密码" required autocomplete="off"
                       oncontextmenu="return false" onpaste="return false" oncopy="return false" oncut="return false">
            </div>
            <button name="submit" type="submit" value="1" class="btn btn-primary block full-width m-b">登 录</button>
        </form>
    </div>
</div>
</body>
</html>
