<?php

namespace App\Infrastructure\Service;

use Symfony\Component\HttpFoundation\Request;

abstract class AbstractService
{
    /**
     * @var Request
     */
    protected Request $request;

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
    }
}