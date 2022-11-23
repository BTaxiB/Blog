<?php

namespace App\Infrastructure\Route;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

class RouteService
{
    /**
     * Load routes from the yaml file using Symfony config component.
     * @param string $directory
     *
     * @return string|RouteCollection
     */
    public function load(string $directory, $filename)
    {
        // Load routes from the yaml file
        $fileLocator = new FileLocator(array($directory));
        $loader = new YamlFileLoader($fileLocator);
        $routes = $loader->load($filename);

        return $routes;
    }
}