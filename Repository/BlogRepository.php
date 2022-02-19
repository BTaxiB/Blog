<?php

namespace Repository;

use App\Model\Blog;

final class BlogRepository implements BlogRepositoryInterface
{
    private Blog $blog;

    /**
     * @param Blog $blog
     */
    public function __construct(Blog $blog) {
        $this->blog = $blog;
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
//        $this->blog->
    }

    /**
     * @inheritDoc
     */
    public function findBy(int $id): ?array
    {
        return $this->blog->show($id);

    }
}