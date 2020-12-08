<?php

namespace rapidPHP\modules\core\classier\console;

use rapidPHP\modules\application\classier\context\ConsoleContext;
use rapidPHP\modules\core\classier\Controller;

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
     * @return ConsoleContext
     */
    public function getContext()
    {
        return parent::getContext();
    }
}