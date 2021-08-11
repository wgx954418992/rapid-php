<?php

namespace rapidPHP\modules\core\classier\console;

use rapidPHP\modules\application\classier\Context;
use rapidPHP\modules\application\classier\context\ConsoleContext;
use rapidPHP\modules\console\classier\Output;
use rapidPHP\modules\core\classier\Controller;
use \rapidPHP\modules\console\classier\Input;

class ConsoleController extends Controller
{

    /**
     * ConsoleController constructor.
     * @param ConsoleContext $context
     */
    public function __construct(ConsoleContext $context)
    {
        parent::__construct($context);
    }

    /**
     * @return ConsoleContext|Context
     */
    public function getContext()
    {
        return parent::getContext();
    }

    /**
     * @return Input
     */
    public function getInput()
    {
        return $this->getContext()->getInput();
    }

    /**
     * @return Output
     */
    public function getOutput()
    {
        return $this->getContext()->getOutput();
    }

    /**
     * @param string|null $data
     * @param array $options
     * @return bool
     */
    public function write(?string $data, array $options = []): bool
    {
        return $this->getContext()->getOutput()->write($data, $options);
    }

    /**
     * @param string|null $data
     * @return bool
     */
    public function psuccess(?string $data): bool
    {
        return $this->getContext()->getOutput()->psuccess($data);
    }

    /**
     * @param string|null $data
     * @return bool
     */
    public function perror(?string $data): bool
    {
        return $this->getContext()->getOutput()->perror($data);
    }
}
