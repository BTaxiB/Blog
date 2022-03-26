<?php

namespace App\Translation\Translator;

interface TranslatorInterface
{
    /**
     * @param int $idBlog
     * @param string $language
     * @param string $target
     * @return ?string
     */
    public function translate(int $idBlog, string $language, string $target): ?string;
}