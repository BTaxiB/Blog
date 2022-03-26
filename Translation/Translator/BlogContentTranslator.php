<?php

namespace App\Translation\Translator;

use App\Translation\Repository\ContentTranslationRepository;

class BlogContentTranslator implements TranslatorInterface
{
    /**
     * @var ContentTranslationRepository
     */
    private ContentTranslationRepository $repository;

    /**
     * @var string
     */
    protected string $language;

    /**
     * @param ContentTranslationRepository $translationRepository
     */
    public function __construct(ContentTranslationRepository $translationRepository)
    {
        $this->repository = $translationRepository;
    }

    /**
     * @inheritDoc
     */
    public function translate(int $idBlog, string $language, string $target): ?string
    {
        return $this->repository->findTranslationByLanguageType($idBlog, $language, $target);
    }
}