<?php

require_once __DIR__ . "/vendor/autoload.php";

use App\App;

$blog = App::createEntity('blogs');

$blog->create([
    'created_at' => date('Y-m-d H:i:s'),
    'title' => 'test',
    'description' => 'testDesc',
    'content_1' => 'TEST',
]);
echo "Created BLOG!" . PHP_EOL;
$id = $blog->lastInsertId();

$blog->update($id, [
    'updated_at' => date('Y-m-d H:i:s'),
    'title' => 'testupdate',
    'description' => 'upodatee',
    'content_1' => 'sadsadsdsa',
]);
echo "Updated BLOG!" . PHP_EOL;

echo "SHOW BLOG ID " . $id . PHP_EOL;

$test = $blog->show($id);
print_r($test);

echo "DELETE BLOG WITH ID " . $id . PHP_EOL;
$blog->delete($id);
echo "DELETED ID " . $id . PHP_EOL;

echo "TOTAL BLOGS: " . $blog->count();