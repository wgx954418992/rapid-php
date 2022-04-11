<?php

use function rapidPHP\VT;

?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <title><?= VT($this)->get('title') ?></title>
    <link rel="stylesheet" href="../../../../public/res/layout/rapid.min.css">
    <link rel="stylesheet" href="../../../../public/res/layout/style.css">
    <link rel="stylesheet" href="../../../../public/res/layout/summernote-bs3.css">
</head>
<body>
<div class="note-editor">
    <?= VT($this)->get('content') ?>
</div>
</body>
</html>