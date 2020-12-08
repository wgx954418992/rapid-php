<?php

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
</body>
</html>