<?php

namespace App\Translation;

interface TranslationServiceInterface
{
    /**
     * @param int $idBlog
     * @param string $language
     * @param string $target
     * @return ?string
     */
    public function translateContent(int $idBlog, string $language, string $target): ?string;
}