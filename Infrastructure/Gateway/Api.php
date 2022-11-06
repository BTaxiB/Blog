<?php

namespace App\Infrastructure\Gateway;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface Api extends Command
{
    /**
     * @param Request|null $request
     * @return Response
     */
    public function execute(mixed $request = null): Response;
}