<?php

namespace App\Infrastructure\Service;

use App\Domain\Service\Translation\LocalizationService;
use App\Infrastructure\Translation\BlogContentTranslator;

final class Localization implements LocalizationService
{
    /** @var BlogContentTranslator */
    private BlogContentTranslator $blogContentTranslator;

    /** @param BlogContentTranslator $blogContentTranslator */
    public function __construct(BlogContentTranslator $blogContentTranslator)
    {
        $this->blogContentTranslator = $blogContentTranslator;
    }

    /**
     * @inheritDoc
     */
    public function translateContent(int $idBlog, string $language, string $target): string
    {
        return $this->blogContentTranslator->translate($idBlog, $language, $target);
    }

    //TODO CACHE TRANSLATIONS
}