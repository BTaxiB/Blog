<?php

namespace App\Domain\Service\Blog;

interface BlogEntityServiceInterface
{
    /**
     * Return paginated array of blogs with 'table_keys'. Chunk size limited.
     * @return array
     */
    public function getBlogsWithPagination(): array;

    /**
     * @return mixed
     */
    public function createNewBlog(): mixed;
}
