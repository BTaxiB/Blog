<?php

namespace App\Context;

final class Context
{
    const CONTEXT_FILE = '/context.json';
    const ERROR_MESSAGE_FORMAT = "Undefined property in context: %s in  %s on line  %s";
    /**
     * @var array|mixed
     */
    protected array $_data;

    public function __construct()
    {
        $load = file_get_contents(sprintf("%s%s", __DIR__, self::CONTEXT_FILE));
        $this->_data = json_decode($load, true);
    }

    /**
     * @inheritDoc
     */
    public function __get(string $name)
    {
        return $this->offsetGet($name);
    }

    /**
     * @param string $name
     * @return array|null
     */
    private function offsetGet(string $name): ?array
    {
        if ($this->offsetExists($name)) {
            return $this->_data[$name];
        }

        $trace = debug_backtrace();
        $errorMessage = sprintf(
            self::ERROR_MESSAGE_FORMAT,
            $name,
            $trace[0]['file'],
            $trace[0]['line']
        );
        trigger_error($errorMessage, E_USER_NOTICE);
        return null;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function offsetExists(string $name): bool
    {
        if (array_key_exists($name, $this->_data)) {
            return true;
        }
        return false;
    }

    /**
     * @param string $name
     * @return void
     */
    public function offsetUnset(string $name): void
    {
        unset($this->_data[$name]);
    }
}