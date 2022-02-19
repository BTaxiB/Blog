<?php

final class ContextMap
{
    private array $map;

    /**
     * @param array $context
     * @return void
     */
    public function register(array $context) {
        foreach($context as $key => $value){
            $this->map[$key] = $value;
        }
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function has(mixed $offset): bool
    {
        return isset($this->map[$offset]);
    }
}