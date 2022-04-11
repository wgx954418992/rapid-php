<?php

use apps\core\classier\model\CmsArticleModel;
use apps\core\classier\model\CmsColumnModel;
use function rapidPHP\B;
use function rapidPHP\VT;

/** @var CmsColumnModel[] $columnList */
$columnList = VT($this)->get('columnList');

$articleList = VT($this)->get('articleList');
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <title><?= VT($this)->get('title') ?></title>
    <link rel="stylesheet" href="../../../../public/res/layout/rapid.min.css">
    <link rel="stylesheet" href="../../../../public/res/layout/style.css">
    <style type="text/css">
        .list {
            overflow: hidden;
            box-sizing: border-box;
        }

        .list > .block {
            width: 95%;
            margin: 0 auto;
            box-sizing: border-box;
        }

        .list > .block > .title {
            overflow: hidden;
            padding: 10px 0;
            box-sizing: border-box;
        }

        .list > .block > .title > .border {
            width: 5px;
            height: 15px;
            margin-right: 5px;
            background: #232323;
            display: inline-block;
            vertical-align: middle;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .list > .block > .title > .text {
            font-size: 16px;
            color: #232323;
            font-weight: bolder;
            display: inline-block;
            vertical-align: middle;
            box-sizing: border-box;
        }

        .list > .block > .column {
            padding-left: 10px;
            color: #515151;
            box-sizing: border-box;
        }

        .list > .block > .column > .item {
            padding: 8px 0;
            overflow: hidden;
            box-sizing: border-box;
        }

        .list > .block > .column > .item > .text {
            font-size: 12px;
        }

        .list > .block > .column > .item > .icon {
            overflow: hidden;
            padding-right: 3px;
        }

        .list > .block > .column > .item > .icon > i {
            border: solid black;
            border-width: 0 1px 1px 0;
            display: inline-block;
            padding: 3px;
        }

        .list > .block > .column > .item > .icon > i.right {
            transform: rotate(-45deg);
            -webkit-transform: rotate(-45deg);
        }
    </style>
</head>
<body>
<div class="list rapid-width-full rapid-height-full">
    <?php foreach ($columnList as $columnModel): ?>
        <div class="block rapid-width-full">
            <div class="title rapid-width-full">
                <div class="border"></div>
                <div class="text"><?= $columnModel->getTitle() ?></div>
            </div>
            <div class="column rapid-width-full">
                <?php
                /** @var CmsArticleModel $articleModel */
                foreach ((array)B()->getData($articleList, $columnModel->getId()) as $articleModel): ?>
                    <a class="item rapid-width-full rapid-display-b"
                       href="<?= VT($this)->toUrl('cms/article/{articleId}/content', ['articleId' => $articleModel->getId()]) ?>">
                        <span class="text rapid-float-left app-color-title">
                            <?= $articleModel->getTitle() ?>
                        </span>
                        <span class="icon rapid-float-right">
                            <i class="right"></i>
                        </span>
                    </a>
                <?php endforeach ?>
            </div>
        </div>
    <?php endforeach ?>
</div>
</body>
</html>
