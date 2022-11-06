<?php

namespace App\Infrastructure\Facade;

use App\Domain\Exception\ServiceProviderException;
use App\Infrastructure\Service\AbstractService;
use OutOfRangeException;

final class ServiceProvider implements ServiceProviderInterface
{
    private const MAX_SERVICE_ARGUMENT_NB = 4;

    /**
     * Contains service with constructor parameters if any.
     * @var string[][]
     */
    private array $services = [];

    /**
     * @var AbstractService[]
     */
    private array $instances = [];

    /**
     * @inheritDoc
     */
    public function boot(string $serviceName, AbstractService $service): void
    {
        $this->instances[$serviceName] = $service;
    }

    /**
     * @inheritDoc
     */
    public function has(string $serviceName): bool
    {
        return isset($this->services[$serviceName]) || isset($this->instances[$serviceName]);
    }

    /**
     * @inheritDoc
     */
    public function get(string $serviceName): AbstractService
    {
        if (isset($this->instances[$serviceName])) {
            return $this->instances[$serviceName];
        }

        $args = $this->services[$serviceName];
        $argsCount = count($args);

        if ($argsCount > self::MAX_SERVICE_ARGUMENT_NB) {
            throw new OutOfRangeException("Too many arguments given");
        }

        if ($argsCount > 0) {
            $instance = new $serviceName(...$args);
        } else {
            $instance = new $serviceName;
        }

        ServiceProviderException::assertIsServiceValid($instance);

        $this->instances[$serviceName] = $instance;
        return $instance;
    }
}
