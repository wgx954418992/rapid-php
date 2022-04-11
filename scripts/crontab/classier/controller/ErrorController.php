<?php

namespace script\crontab\classier\controller;

use Exception;
use rapidPHP\modules\core\classier\console\ConsoleController;

/**
 * Class ErrorController
 * @package script\convert\classier\controller
 */
class ErrorController extends ConsoleController
{

    /**
     * 404
     * @route /error/404
     * @param Exception|null $exception
     * @throws Exception
     */
    public function errorNotFound(?Exception $exception)
    {
        if (!$exception) return;

        $this->perror("输入的命令错误");

        $this->psuccess("- php index.php");
    }

    /**
     * 全局错误捕获
     * @route /error
     * @param Exception|null $exception
     * @throws Exception
     */
    public function error(?Exception $exception)
    {
        if (!$exception) return;

        $this->perror($exception->getMessage());
    }
}
