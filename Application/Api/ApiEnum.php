<?php

namespace App\Application\Api;

enum ApiEnum
{
    const LABEL = 'api';
    case LOWERCASE;
    case UPPERCASE;

    public function getValue(): string
    {
        return match($this)
        {
            ApiEnum::LOWERCASE => self::LABEL,
            ApiEnum::UPPERCASE => ucfirst(self::LABEL),
        };
    }
}