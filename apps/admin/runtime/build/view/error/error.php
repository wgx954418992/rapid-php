<?php /** cache Time 2021-08-08 09:24:07 */ defined('PATH_APP') or die();?>
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
<script>
    alert('<?= str_replace(['\'', '"'], ['\\\'','\\"'], VT($this)->get('msg')) ?>');

    window.history.back();
</script>
</body>
</html>
