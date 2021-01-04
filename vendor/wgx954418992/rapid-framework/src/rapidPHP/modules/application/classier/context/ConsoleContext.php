<?php

namespace rapidPHP\modules\application\classier\context;

use rapidPHP\modules\application\classier\Context;
use rapidPHP\modules\console\classier\Input;
use rapidPHP\modules\console\classier\Output;
use rapidPHP\modules\server\classier\interfaces\Request;
use rapidPHP\modules\server\classier\interfaces\Response;

class ConsoleContext extends Context
{
    /**
     * @var Input
     */
    private $input;

    /**
     * @var Output
     */
    private $output;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * ConsoleContext constructor.
     * @param Input $input
     * @param Output $output
     */
    public function __construct(Input $input, Output $output)
    {
        parent::__construct();

        $this->input = $input;

        $this->output = $output;

        $this->supportsParameter([
            ConsoleContext::class => $this,
            Request::class => $this->input,
            Response::class => $this->output,
        ]);
    }

    /**
     * @return Input
     */
    public function getInput(): Input
    {
        return $this->input;
    }

    /**
     * @return Output
     */
    public function getOutput(): Output
    {
        return $this->output;
    }
}