<?php

use rapidPHP\modules\application\classier\apps\ConsoleApplication;
use rapidPHP\modules\common\classier\Variable;
use rapidPHP\modules\configure\classier\Configurator;
use rapidPHP\modules\console\classier\Args;

define('PATH_APP', str_replace('\\', '/', __DIR__) . '/');

define('PATH_PUBLIC', PATH_APP);

require dirname(dirname(__DIR__)) . '/vendor/autoload.php' . '';
require dirname(dirname(__DIR__)) . '/vendor/wgx954418992/rapid-framework/src/rapidPHP/init.php' . '';

$app = new ConsoleApplication(Configurator::getInstance());

$configFilepath = Args::getInstance()->getOptionValue('conf');

if (!empty($configFilepath)) {
    Variable::parseVarByString($configFilepath);

    $app->getConfig()
        ->setPaths(explode(' ', $configFilepath));
}

$app->getConfig()
    ->load();

$app->run();
