<?php

require_once __DIR__ . "/vendor/autoload.php";

use App\Context\Context;
use App\Database\Config;
use App\Database\EnvException;
use App\Database\MySQLConnection;
use App\Model\Blog;
use App\Model\Query\QueryService;
use Dotenv\Dotenv;

$config = new Config(Dotenv::createImmutable(__DIR__));
try {
    $config->setConfig();
} catch (EnvException $e) {
    echo $e;
}

$db = new MySQLConnection($config);

$blog = new Blog($db, new QueryService(new Context));

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

echo "TOTAL BLOGS: " . $blog->count();