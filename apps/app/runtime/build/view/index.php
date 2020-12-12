<?php /** cache Time 2020-12-13 00:16:43 */ defined('PATH_APP') or die();?>
<?php


use apps\app\classier\model\AppUserModel;
use function rapidPHP\VT; ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>Fast, simple and practical php framework - RapidPHP</title>
</head>
<body>
<h1>欢迎使用RapidPHP框架 <?= RAPIDPHP_VERSION ?></h1>
<hr>
<p><?= VT($this)->get('msg') ?></p>
<hr>
<?php
/** @var AppUserModel $user */
$user = VT($this)->get('user') ?>

<?php if ($user != null): ?>
    <?= $user->getId() ?> - <?= $user->getTelephone() ?><br/>
<?php endif ?>

</body>
</html>