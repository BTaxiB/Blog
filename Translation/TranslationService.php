<?php

namespace App\Translation;

use App\Translation\Translator\BlogContentTranslator;
use App\Translation\Translator\TranslatorInterface;

final class TranslationService implements TranslationServiceInterface
{
    /**
     * @var BlogContentTranslator
     */
    private BlogContentTranslator $blogContentTranslator;

    /**
     * @param BlogContentTranslator $blogContentTranslator
     */
    public function __construct(BlogContentTranslator $blogContentTranslator)
    {
        $this->blogContentTranslator = $blogContentTranslator;
    }

    /**
     * @inheritDoc
     */
    public function translateContent(int $idBlog, string $language, string $target): ?string
    {
        return $this->blogContentTranslator->translate($idBlog, $language, $target);
    }

    //TODO CACHE TRANSLATIONS
}
