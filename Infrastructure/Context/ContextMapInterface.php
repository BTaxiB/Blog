<?php

namespace App\Infrastructure\Context;

interface ContextMapInterface
{
    public const CONTEXT_PATH = '/src';
    public const API_CONTEXT_FILENAME = '/api_context.json';
    public const MODEl_CONTEXT_FILENAME = '/model_context.json';
    public const ERROR_MESSAGE_FORMAT = "Undefined property in context: %s in  %s on line  %s";

    /**
     * @param string $name
     *
     * @return array|null
     */
    public function offsetGet(string $name): ?array;

    /**
     * @param string $name
     *
     * @return bool
     */
    public function offsetExists(string $name): bool;

    /**
     * @param string $name
     *
     * @return void
     */
    public function offsetUnset(string $name): void;

    /**
     * @return string[]|null
     */
    public function getContextKeys(): ?array;
}