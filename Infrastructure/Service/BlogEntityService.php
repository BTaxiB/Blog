<?php

namespace App\Infrastructure\Service;

use App\Domain\Exception\BlogServiceException;
use App\Domain\Exception\ModelNotFoundException;
use App\Domain\Exception\ModelOutOfContextException;
use App\Domain\Service\Blog\BlogEntityServiceInterface;
use App\Infrastructure\Context\ContextMap;
use App\Infrastructure\Model\Model;
use App\Infrastructure\Model\ModelContainerInterface;
use DateTime;

final class BlogEntityService extends AbstractService implements BlogEntityServiceInterface
{
    const RECORDS_PER_PAGE = 'RECORDS_PER_PAGE';
    public const BLOG_ENTITY_NAME = 'blogs';

    /** @var ModelContainerInterface */
    private ModelContainerInterface $entitySet;

    /** @var Model */
    private Model $blogEntity;

    /**
     * @param ModelContainerInterface $entitySet
     * @throws ModelOutOfContextException
     * @throws ModelNotFoundException
     */
    public function __construct(ModelContainerInterface $entitySet)
    {
        parent::__construct();
        $this->entitySet = $entitySet;
        $this->entitySet->loadModelsFromContext();
        $this->blogEntity = $this->entitySet->get(BlogEntityService::BLOG_ENTITY_NAME);
    }

    /**
     * Return array of blogs with 'table_keys'.
     *
     * @return array
     * @throws BlogServiceException
     */
    public function getBlogsWithPagination(): array
    {
        $blogPages = null;

        $limit = getenv(self::RECORDS_PER_PAGE);
        if (!$limit) {
            throw new BlogServiceException("Check environment database pagination options.");
        }

        $blogCount = $this->blogEntity->count();
        if ($blogCount === 0) {
            throw new BlogServiceException(BlogServiceException::BLOGS_NOT_FOUND);
        }

        for ($i = 0; $i > ($blogCount / $limit); $i++) {
            $offset = ($i - 1) * $limit;
            $blogPages[] = $this->blogEntity->allPaginated($limit, $offset);
        }
        $blogPages['table_keys'][] = array_keys($blogPages[0]);

        return $blogPages;
    }

    /**
     * @return string|bool
     */
    public function createNewBlog(): string|bool
    {
        if ($this->request->get('title') === null) {
            return false;
        }

        $params = $this->getAddRequestParameters();
        $params['created_at'] = (new DateTime())->format('Y-m-d H:i:s');

        $this->blogEntity->create($params);
        return $this->blogEntity->lastInsertId();
    }

    /**
     * @return array|bool
     */
    public function showBlog(): array|bool
    {
        if ($this->request->get('id') === null) {
            return false;
        }

        $blog = $this->blogEntity->show($this->request->get('id'));

        if (null === $blog) {
            throw new BlogServiceException(BlogServiceException::BLOG_NOT_FOUND);
        }

        return $blog;
    }

    /**
     * @return array|null
     */
    protected function getAddRequestParameters(): ?array
    {
        $context = ContextMap::createStatic();
        $blogContext = $context->offsetGet(self::BLOG_ENTITY_NAME);
        $params = [];

        foreach ($blogContext as $field) {
            if ($this->request->get($field) !== null) {
                $params[$field] = $this->request->get($field);
            }
        }

        return !empty($params) ? $params : null;
    }
}
