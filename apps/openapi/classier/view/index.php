<?php

use apps\openapi\classier\config\ExportConfig;
use function rapidPHP\VT;

?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>OpenApi - RapidPHP - FrameWork</title>
    <link rel="stylesheet" type="text/css" href="../../public/res/layout/swagger-ui.css">
    <link rel="icon" type="image/png" href="../../public/res/assets/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="../../public/res/assets/favicon-16x16.png" sizes="16x16"/>
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
            display: flex;
            overflow: hidden;
            border-bottom: 2px solid #10e7c2;
        }

        #api-select {
            width: 70%;
            height: 100%;
            color: white;
            border: none;
            padding-left: 50px;
            background: #0baf92;
        }

        .header > .btn {
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

        #export {
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.64);
        }

        #export > .content {
            width: 80%;
            padding: 30px 30px 20px;
            max-width: 500px;
            height: fit-content;
            min-height: 500px;
            max-height: 80%;
            background: white;
            border-radius: 30px;
            display: flex;
            justify-content: space-between;
            flex-direction: column;
        }

        #export > .content > .inputs {
            overflow: hidden;
            overflow-y: auto;
        }

        #export > .content > .inputs::-webkit-scrollbar {
            width: 0;
        }

        #export > .content > .inputs .input {
            width: 100%;
            padding: 15px;
            color: #0baf92;
            margin-bottom: 10px;
            border-radius: 10px;
            border: 2px solid #0baf92;
        }

        #export > .content > .actions {
            display: flex;
            min-height: 40px;
            margin-top: 10px;
            justify-content: space-between;
        }

        #export > .content > .actions > .button {
            width: 45%;
            color: white;
            cursor: pointer;
            background: #0baf92;
            border-radius: 10px;
            transition: all .3s;
        }

        #export > .content > .actions > .button:hover {
            opacity: 0.6;
        }

        #export > .content > .actions > .button.cancel {
            background: grey;
        }
    </style>
</head>
<body>
<div class="header" style="background-color: #1f1f1f">
    <select id="api-select" onchange="onSelectChange()">
        <?php foreach (VT($this)->get('apis') as $module => $item): ?>
            <option data-module="<?= $module ?>" value="<?= $item['api'] ?>" <?= VT($this)->get('api') == $item['api'] ? 'selected' : '' ?> >
                <?= $item['api'] ?> - <?= $item['description'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    <a onclick="exportApi('android')" class="btn">
        导出Android代码
    </a>
    <a href="https://github.com/wgx954418992/rapid-php" target="_blank" class="btn">
        Github
    </a>
    <a onclick="window.location='postman://collections?url='+'<?= VT($this)->get('api') ?>'" class="btn">
        打开 Postman
    </a>
    <a href="<?= VT($this)->get('api') ?>" target="_blank" class="btn">
        下载 OpenAPI.json
    </a>
</div>
<div id="export" style="display: none">
    <div class="content">
        <div class="inputs" id="export-inputs">
        </div>
        <div class="actions">
            <button class="button confirm">确定</button>
            <button class="button cancel">取消</button>
        </div>
    </div>
</div>
<div id="swagger-ui">
</div>
<script src="../../public/libs/swagger-ui-bundle.js"></script>
<script src="../../public/libs/swagger-ui-standalone-preset.js"></script>
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

    /**
     * 导出
     * @param platform
     */
    function exportApi(platform) {
        let selectView = document.getElementById('api-select');

        const module = selectView.options[selectView.selectedIndex].dataset['module'];

        let options;

        const cacheKey = platform + module + 'options';

        try {
            options = JSON.parse(localStorage.getItem(cacheKey) || '');
        } catch (e) {
            options = <?=json_encode(ExportConfig::getAndroidConfig())?>
        }

        const inputContainerView = document.querySelector("#export-inputs");

        inputContainerView.innerHTML = '';

        for (let name in options) {
            if (!options.hasOwnProperty(name)) continue;

            const view = document.createElement('input');

            view.name = name;

            view.title = name;

            view.placeholder = name;

            view.className = 'input';

            view.value = options[name];

            inputContainerView.appendChild(view);
        }

        const exportView = document.querySelector("#export")

        exportView.style.display = '';

        document.querySelector("#export .button.cancel").onclick = function () {
            exportView.style.display = 'none';
        };

        document.querySelector("#export .button.confirm").onclick = function () {
            const options = {};

            const inputViews = inputContainerView.querySelectorAll(".input");

            for (let inputView of inputViews) {
                options[inputView.name] = inputView.value;
            }

            localStorage.setItem(cacheKey, JSON.stringify(options))

            window.location.href = '<?= VT($this)->toUrl('export/') ?>' + module + '/' + platform + '?options=' + encodeURIComponent(JSON.stringify(options));
        };
    }

    onSelectChange();
</script>
</body>
</html>

