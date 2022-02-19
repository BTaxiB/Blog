<?php

require_once __DIR__ . "/vendor/autoload.php";

use App\Database\Config;
use App\Database\ConfigException;
use App\Database\MySQLConnection;
use App\Model\Blog;
use App\Model\Query\QueryService;


$config = new Config;
try {
    $config->setConfig([
        'dbName' => 'projekat',
        'dbUser' => 'root',
        'dbPass' => '',
    ]);
} catch (ConfigException $e) {
    echo $e;
}

$db = new MySQLConnection($config);

$blog = new Blog($db, new QueryService());

$blog->create([
    'title' => 'test',
    'description' => 'testDesc',
    'img' => 'testImg',
]);
echo "Created BLOG!" . PHP_EOL;
$id = $blog->lastInsertId();
$blog->update($id, [
    'title' => 'testupdate',
    'description' => 'upodatee',
    'img' => 'sadsadsdsa',
]);
echo "Updated BLOG!" . PHP_EOL;

echo "SHOW BLOG ID " . $id . PHP_EOL;

$test = $blog->show($id);
print_r($test);

echo "DELETE BLOG WITH ID " . $id . PHP_EOL;
$blog->delete($id);
echo "DELETED ID " . $id . PHP_EOL;