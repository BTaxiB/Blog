<?php

require_once __DIR__ . "/vendor/autoload.php";

use App\Model\Query\QueryService;
use App\Model\Query\Builder\QueryBuilderStrategy;
$queryService = new QueryService();

$query = $queryService->createQuery(
    QueryBuilderStrategy::Delete,
    [
        'table' => 'testTable',
        'id' => 1
    ]
);

var_dump($query);