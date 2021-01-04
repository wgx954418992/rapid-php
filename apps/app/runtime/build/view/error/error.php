<?php /** cache Time 2020-12-20 23:30:30 */ defined('PATH_APP') or die();?>
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
