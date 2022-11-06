<?php

namespace App\Domain\Repository;

interface ContentTranslationRepositoryInterface
{
    /**
     * @param int $idBlog
     * @param string $fieldName
     * @param string $language
     *
     * @return string|null
     */
    public function findTranslationByLanguageType(int $idBlog, string $fieldName, string $language): ?string;
}