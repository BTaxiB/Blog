<?php

namespace App\Infrastructure\Gateway;

interface Command
{
    /**
     * @param mixed|null $param
     * @return mixed
     */
    public function execute(mixed $param = null): mixed;
}