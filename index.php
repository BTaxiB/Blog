<?php

require_once __DIR__ . "/vendor/autoload.php";

use App\Context\Context;
use App\Database\Config;
use App\Database\EnvException;
use App\Model\Factory\EntityFactory;
use Dotenv\Dotenv;

$config = new Config(Dotenv::createImmutable(__DIR__));
try {
    $config->setConfig();
} catch (EnvException $e) {
    echo $e;
}

$contextFilename = sprintf("%s%s", __DIR__, Context::DEFAULT_CONTEXT_FILENAME);
$factory = new EntityFactory(new Context($contextFilename), $config);

$blog = $factory->createEntity('blog');

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
