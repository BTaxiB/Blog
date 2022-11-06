<?php

require_once "../../vendor/autoload.php";

use App\Application\Api\Domain\ApiEnum;
use App\Application\Api\Domain\Exception\ApiException;
use App\Application\Api\Infrastructure\ApiHandler;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();
$uri = parse_url($request->getRequestUri(), PHP_URL_PATH);
$uri = explode('/', $uri);

$isBadRequest = $uri[2] != ApiEnum::LOWERCASE->getValue();
$isEmptyRequest = !isset($uri[3]);

if ($isBadRequest || $isEmptyRequest) {
    header(ApiException::STATUS_404_NOT_FOUND);
    exit();
}

$methodName = sprintf("%s%s", $uri[3], ApiEnum::UPPERCASE->getValue());

$apiHandler = new ApiHandler(new $methodName());
$response = $apiHandler->performRequest();
