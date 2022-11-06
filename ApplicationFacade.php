<?php

namespace App;

use App\Domain\Exception\BadEnvironmentConfigException;
use App\Domain\Exception\ModelNotFoundException;
use App\Domain\Exception\ModelOutOfContextException;
use App\Domain\Service\Blog\BlogEntityServiceInterface;
use App\Infrastructure\Context\ContextMap;
use App\Infrastructure\Database\Domain\Configuration\Config;
use App\Infrastructure\Model\Model;
use App\Infrastructure\Model\ModelContainer;
use App\Infrastructure\Facade\ServiceProvider;
use App\Infrastructure\Service\BlogEntityService;
use Dotenv\Dotenv;

final class ApplicationFacade
{
    /** @var ModelContainer */
    private ModelContainer $modelContainer;

    /** @var ServiceProvider */
    private ServiceProvider $serviceProvider;

    /**
     * @throws ModelOutOfContextException
     * @throws BadEnvironmentConfigException|ModelNotFoundException
     */
    public function __construct()
    {
        $config = new Config(Dotenv::createImmutable(__DIR__));
        $context = new ContextMap(sprintf(
            "%s%s%s",
            __DIR__,
            ContextMap::CONTEXT_PATH,
            ContextMap::MODEl_CONTEXT_FILENAME
        ));

        $this->modelContainer = new ModelContainer($config, $context);
        $this->modelContainer->loadModelsFromContext();

        $this->serviceProvider = new ServiceProvider();
        $this->serviceProvider->boot(
            BlogEntityService::class,
            new BlogEntityService($this->modelContainer)
        );
    }

    /**
     * @param string $modelName
     *
     * @return Model
     * @throws ModelNotFoundException
     */
    public function getModel(string $modelName): Model
    {
        return $this->modelContainer->get($modelName);
    }

    /**
     * @param string $entityName
     *
     * @return Model
     * @throws ModelNotFoundException
     */
    public static function getStaticEntity(string $entityName): Model
    {
        return (new self)->modelContainer->get($entityName);
    }

    /**
     * @return BlogEntityServiceInterface
     * @throws ApplicationFacadeException
     */
    public function getBlogService(): BlogEntityServiceInterface
    {
        if (!$this->serviceProvider->has(BlogEntityService::class)) {
            throw new ApplicationFacadeException(sprintf("Service [%s] not found.", BlogEntityService::class));
        }

        return $this->serviceProvider->get(BlogEntityService::class);
    }

    /**
     * @param int $amount
     * 
     * @return void
     * @throws ModelNotFoundException
     */
    public function blogDatabaseSeed(int $amount)
    {
        $blogEntity = $this->modelContainer->get(BlogEntityService::BLOG_ENTITY_NAME);
        for ($i = 0; $i < $amount; $i++) {
            $blogEntity->create([
                'created_at' => date('Y-m-d H:i:s'),
                'title' => "test$i",
                'description' => 'testDesc',
                'paragraph_1' => 'TEST',
            ]);
        }
    }
}

