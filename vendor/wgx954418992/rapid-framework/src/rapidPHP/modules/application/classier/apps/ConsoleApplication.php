<?php


namespace rapidPHP\modules\application\classier\apps;

use Exception;
use rapidPHP\modules\application\classier\Application;
use rapidPHP\modules\application\classier\Context;
use rapidPHP\modules\application\classier\context\ConsoleContext;
use rapidPHP\modules\console\classier\Args;
use rapidPHP\modules\console\classier\Input;
use rapidPHP\modules\console\classier\Output;
use rapidPHP\modules\reflection\classier\Classify;
use rapidPHP\modules\router\classier\router\ConsoleRouter;
use ReflectionException;
use function rapidPHP\formatException;

class ConsoleApplication extends Application
{

    /**
     * 创建web context
     * @template T
     * @param Input $request
     * @param Output $response
     * @param string|null $context
     * @return ConsoleContext|null
     * @throws ReflectionException
     * @throws Exception
     */
    public function newConsoleContext(Input $request, Output $response, ?string $context)
    {
        if (empty($context)) $context = ConsoleContext::class;

        $instance = Classify::getInstance($context)
            ->newInstance($request, $response);

        if ($instance instanceof ConsoleContext) return $instance;

        return null;
    }

    /**
     * run
     * @throws ReflectionException
     * @throws Exception
     */
    public function run()
    {
        if (!APP_RUNNING_IS_SHELL) exit();

        try {

            $input = new Input(Args::getInstance());

            $output = new Output();

            $consoleConfig = $this->getConfig()->getConsole();

            $context = $this->newConsoleContext($input, $output, $consoleConfig->getContext());

            ConsoleRouter::getInstance()->run($this, $context);

        } catch (Exception $e) {
            $this->logger(self::LOGGER_DEBUG)->error(formatException($e));

            throw $e;
        }
    }
}
