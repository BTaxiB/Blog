<?php

namespace App\Infrastructure\Context;

class ContextMap implements ContextMapInterface
{
    /** @var array|mixed */
    protected array $_data;

    /** @param string $filename */
    public function __construct(string $filename)
    {
        $load = file_get_contents($filename);
        $this->_data = json_decode($load, true);
    }

    /**
     * @return $this
     */
    public static function createStatic(): self
    {
        return new self(sprintf(
            "%s%s%s",
            dirname(__DIR__),
            ContextMap::CONTEXT_PATH,
            ContextMap::MODEl_CONTEXT_FILENAME
        ));
    }

    /**
     * @param string $name
     *
     * @return array|null
     */
    public function offsetGet(string $name): ?array
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
     * @inheritDoc
     */
    public function offsetExists(string $name): bool
    {
        if (array_key_exists($name, $this->_data)) {
            return true;
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset(string $name): void
    {
        unset($this->_data[$name]);
    }

    /**
     * @inheritDoc
     */
    public function getContextKeys(): ?array
    {
        if (count($this->_data) > 0) {
            return array_keys($this->_data);
        }

        return null;
    }
}