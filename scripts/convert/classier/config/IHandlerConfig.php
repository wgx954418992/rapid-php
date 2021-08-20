<?php

namespace script\convert\classier\config;


interface IHandlerConfig
{
    /**
     * @return string[]
     */
    public function getInput(): array;

    /**
     * @return string
     */
    public function getOutput(): string;

    /**
     * @return array|null
     */
    public function getMappingSystem(): ?array;

    /**
     * @return array|null
     */
    public function getMappingCustom(): ?array;

    /**
     * @return string
     */
    public function getClassName(): string;
}
