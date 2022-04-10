<?php

namespace App\Entity;

use App\Context\Context;
use App\Database\Config;
use App\Database\EnvException;
use App\Entity\Factory\EntityFactory;

final class EntitySet implements EntitySetInterface
{
    /**
     * @var Config
     */
    private Config $config;

    /**
     * @var Context
     */
    private Context $context;

    /**
     * @var EntityFactory
     */
    private EntityFactory $entityFactory;

    /**
     * @var Entity[]
     */
    private array $set;

    /**
     * @param Config $config
     * @param Context $context
     * @throws EnvException
     */
    public function __construct(Config $config, Context $context)
    {
        $this->config = $config;
        $this->config->setConfig();
        $this->context = $context;
        $this->entityFactory = new EntityFactory($this->context, $this->config);
    }

    /**
     * @inheritDoc
     */
    public function registerEntities(): void
    {
        $contextKeys = $this->context->getContextKeys();

        foreach ($contextKeys as $key) {
            $this->set[$key] = $this->entityFactory->createEntity($key);
        }
    }

    /**
     * @inheritDoc
     */
    public function get(string $offset): Entity
    {
        if (!$this->set[$offset]) {
            throw new EntitySetException(sprintf(
                EntitySetException::ENTITY_NOT_FOUND_ERROR,
                $offset
            ));
        }

        return $this->set[$offset];
    }
}
