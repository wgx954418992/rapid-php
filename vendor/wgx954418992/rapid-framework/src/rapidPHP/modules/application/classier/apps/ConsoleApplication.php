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
     * @param Input $request
     * @param Output $response
     * @param string|null $context
     * @return ConsoleContext|Context|null|mixed
     * @throws ReflectionException
     * @throws Exception
     */
    public function newWebContext(Input $request, Output $response, ?string $context)
    {
        if (empty($context)) $context = ConsoleContext::class;

        /** @var ConsoleContext $instance */
        $instance = Classify::getInstance($context)
            ->newInstance($request, $response);

        return $instance;
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

            $context = $this->newWebContext($input, $output, $consoleConfig->getContext());

            ConsoleRouter::getInstance()->run($this, $context);

        } catch (Exception $e) {
            $this->logger(self::LOGGER_DEBUG)->error(formatException($e));

            throw $e;
        }
    }
}