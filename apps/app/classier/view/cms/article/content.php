<?php

use apps\core\classier\wrapper\cms\ArticleWrapper;
use function rapidPHP\VT;

/** @var ArticleWrapper $articleModel */
$articleModel = VT($this)->get('article');
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <title><?= $articleModel->getTitle() ?></title>
    <link rel="stylesheet" href="../../../../public/res/layout/rapid.min.css">
    <link rel="stylesheet" href="../../../../public/res/layout/style.css">
    <link rel="stylesheet" href="../../../../public/res/layout/summernote-bs3.css">
</head>
<body>
<h2 class="rapid-text-align-center rapid-pd-tb"><?= $articleModel->getTitle() ?></h2>
<div style="width: 90%;margin: 0 auto;" class="app-color-black-grep app-font-size-12">
    <div class="note-editor">
        <?= $articleModel->getContent() ?>
    </div>
</div>
</body>
</html>
