<?php

use function rapidPHP\VT;

?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>OpenApi - RapidPHP - FrameWork</title>
    <link rel="stylesheet" type="text/css" href="../../res/layout/swagger-ui.css">
    <link rel="icon" type="image/png" href="../../res/assets/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="../../res/assets/favicon-16x16.png" sizes="16x16"/>
    <style>
        html {
            box-sizing: border-box;
            overflow: -moz-scrollbars-vertical;
            overflow-y: scroll;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%
        }

        * {
            margin: 0;
            padding: 0;
            border: 0;
            outline: none;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }


        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        body {
            margin: 0;
            background: #fafafa;
        }

        input, textarea, button {
            border-radius: 0;
            -webkit-appearance: none;
            font-family: "STHeitiSC-Light", "microsoft yahei", "Rotobo", "sans-serif";
        }

        input:-webkit-autofill, textarea:-webkit-autofill, select:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 100px white inset;
        }

        .header {
            height: 50px;
            overflow: hidden;
            border-bottom: 2px solid #10e7c2;
        }

        #api-select {
            float: left;
            width: 70%;
            height: 100%;
            color: white;
            border: none;
            padding-left: 50px;
            background: #0baf92;
        }

        .header > .btn {
            float: right;
            width: 10%;
            height: 100%;
            border: none;
            color: #FFFFFF;
            cursor: pointer;
            line-height: 50px;
            text-align: center;
            font-size: 12px;
            border-left: 1px solid #1e9983;
            text-decoration: underline;
            background: #0baf92;
        }

    </style>
</head>
<body>
<div class="header" style="background-color: #1f1f1f">
    <select id="api-select" onchange="onSelectChange()">
        <?php foreach (VT($this)->get('apis') as $item): ?>
            <option value="<?= $item['api'] ?>" <?= VT($this)->get('api') == $item['api'] ? 'selected' : '' ?> >
                <?= $item['api'] ?> - <?= $item['description'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    <a href="https://github.com/wgx954418992/rapid-php" target="_blank" class="btn">Github</a>
    <a onclick="window.location='postman://collections?url='+'<?= VT($this)->get('api') ?>'" class="btn">打开 Postman</a>
    <a href="<?= VT($this)->get('api') ?>" target="_blank" class="btn">下载 OpenAPI.json</a>
</div>
<div id="swagger-ui">
</div>
<script src="../../libs/swagger-ui-bundle.js"></script>
<script src="../../libs/swagger-ui-standalone-preset.js"></script>
<script>

    /**
     * 设置swagger url
     * @param url
     */
    function setSwaggerUiURL(url) {
        window.ui = SwaggerUIBundle({
            url: url,
            dom_id: '#swagger-ui',
            deepLinking: true,
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            plugins: [
                SwaggerUIBundle.plugins.DownloadUrl
            ],
            layout: "StandaloneLayout"
        })
    }

    /**
     * api 选择更改
     */
    function onSelectChange() {
        const currentUrl = '<?=VT($this)->get('api')?>';

        let selectView = document.getElementById('api-select');

        if (currentUrl !== selectView.value) {
            window.location.href = '?api=' + selectView.value;
        } else {
            setSwaggerUiURL(selectView.value);
        }
    }

    onSelectChange();
</script>
</body>
</html>

