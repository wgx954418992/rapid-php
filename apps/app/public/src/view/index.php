<?php

use apps\app\classier\model\UserModel;
use function rapidPHP\VT;

?>
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
<?php $users = VT($this)->get('users') ?? [] ?>

<?php
/** @var UserModel $user */
foreach ($users as $user) :?>
    <?= $user->getId() ?> - <?= $user->getName() ?><br/>
<?php endforeach; ?>
</body>
</html>