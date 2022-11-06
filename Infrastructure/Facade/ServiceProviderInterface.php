<?php

namespace App\Infrastructure\Facade;

use App\Domain\Exception\ServiceProviderException;
use App\Infrastructure\Service\AbstractService;

interface ServiceProviderInterface
{
    /**
     * @param string $serviceName
     * @param AbstractService $service
     *
     * @return void
     */
    public function boot(string $serviceName, AbstractService $service): void;

    /**
     * @param string $serviceName
     *
     * @return bool
     */
    public function has(string $serviceName): bool;

    /**
     * @param string $serviceName
     *
     * @return AbstractService
     * @throws ServiceProviderException
     */
    public function get(string $serviceName): AbstractService;
}
