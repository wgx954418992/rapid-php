<?php

use function rapidPHP\VT;

?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title><?= VT($this)->get('title') ?></title>
</head>
<body>

<h1 style="text-align: center"><?= VT($this)->get('title') ?></h1>
<hr>
<p style="text-align: center">RapidPHP framework <?= RAPIDPHP_VERSION ?></p>
<p style="text-align: center"><?= VT($this)->get('msg') ?></p>
</body>
</html>
