<?php /** cache Time 2020-07-01 14:32:00 */ if(!defined('SWOOLE_HTTP_SERVER')) defined('ROOT_PATH') or die();?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>rapidPHP</title>
</head>
<body>
Hello，This is rapidPHP
<?=VT($this)->getController()->toUrl()?>
</body>
</html>
