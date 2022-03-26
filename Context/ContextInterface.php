<?php

namespace App\Context;

interface ContextInterface
{
    /**
     * @param string $name
     * @return array|null
     */
    public function offsetGet(string $name): ?array;

    /**
     * @param string $name
     * @return bool
     */
    public function offsetExists(string $name): bool;

    /**
     * @param string $name
     * @return void
     */
    public function offsetUnset(string $name): void;

    /**
     * @return string[]|null
     */
    public function getContextKeys(): ?array;
}