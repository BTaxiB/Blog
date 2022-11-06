<?php

namespace App\Infrastructure\Model;

use App\Domain\Exception\BadEnvironmentConfigException;
use App\Domain\Exception\ModelNotFoundException;
use App\Infrastructure\Context\ContextMap;
use App\Infrastructure\Database\Domain\Configuration\Config;
use App\Infrastructure\Model\Factory\ModelFactory;

final class ModelContainer implements ModelContainerInterface
{
    /**
     * @var Config
     */
    private Config $config;

    /**
     * @var ContextMap
     */
    private ContextMap $contextMap;

    /**
     * @var ModelFactory
     */
    private ModelFactory $modelFactory;

    /**
     * @var Model[]
     */
    private array $set;

    /**
     * @param Config $config
     * @param ContextMap $context
     * @throws BadEnvironmentConfigException
     */
    public function __construct(Config $config, ContextMap $context)
    {
        $this->config = $config;
        $this->config->setConfig();
        $this->contextMap = $context;
        $this->modelFactory = new ModelFactory($this->contextMap, $this->config);
    }

    /**
     * @inheritDoc
     */
    public function loadModelsFromContext(): void
    {
        $contextKeys = $this->contextMap->getContextKeys();

        foreach ($contextKeys as $key) {
            $this->set[$key] = $this->modelFactory->createModel($key);
        }
    }

    /**
     * @inheritDoc
     */
    public function get(string $offset): Model
    {
        if (!$this->set[$offset]) {
            throw new ModelNotFoundException();
        }

        return $this->set[$offset];
    }
}
