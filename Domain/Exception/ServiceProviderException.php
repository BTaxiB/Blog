<?php

namespace App\Domain\Exception;

use App\Infrastructure\Service\AbstractService;
use InvalidArgumentException;

final class ServiceProviderException extends InvalidArgumentException
{
    private const ERROR_INVALID_SERVICE = "Could not register service: %s is no instance of %s";

    /**
     * @param object $instance
     *
     * @return void
     */
    public static function assertIsServiceValid(object $instance): void
    {
        if (!$instance instanceof AbstractService) {
            throw new self(sprintf(self::ERROR_INVALID_SERVICE, $instance::class, AbstractService::class));
        }
    }
}
