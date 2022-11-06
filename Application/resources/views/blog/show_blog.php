<?php

require_once "../../vendor/autoload.php";

use App\Application\ApplicationFacade;
use App\Application\ApplicationFacadeException;
use App\Domain\Exception\BlogServiceException;
use App\Domain\Exception\ModelNotFoundException;
use App\Infrastructure\Service\BlogEntityService;

$page = 'Blog';
$entityName = BlogEntityService::BLOG_ENTITY_NAME;
$entity = null;

$app = new ApplicationFacade();

try {
    $blogService = $app->getBlogService();
    $entity = $app->getModel($entityName);
} catch (ApplicationFacadeException $e) {
    echo sprintf(
        ApplicationFacadeException::CLIENT_PAGE_LOAD_FAIL_ERROR,
        $page,
        $e->getMessage()
    );
} catch (ModelNotFoundException $e) {
    echo sprintf(
        ApplicationFacadeException::ENTITY_NOT_FOUND_ERROR,
        $entityName
    );
}

try {
    $blog = $blogService->showBlog();
} catch (BlogServiceException $e) {
    echo $e->getMessage();
}

ob_start();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?= $blog['title'] ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
              crossorigin="anonymous">
    </head>
    <style>
        .center {
            margin: auto;
            width: 20%;
            padding: 10px;
        }

        .purple-border textarea {
            border: 1px solid #ba68c8;
        }

        .purple-border .form-control:focus {
            border: 1px solid #ba68c8;
            box-shadow: 0 0 0 0.2rem rgba(186, 104, 200, .25);
        }

        .green-border-focus .form-control:focus {
            border: 1px solid #8bc34a;
            box-shadow: 0 0 0 0.2rem rgba(139, 195, 74, .25);
        }
    </style>
    <body>
    <div class="container center">
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?= "Description: \n{$blog['description']}" ?></li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
            </ul>
        </div>
        <?php
            echo "<h1>{$blog['title']}</h1>";
            echo "<p>Description: \n{$blog['description']}</p>";
            echo "<p>Paragraph #1: \n{$blog['paragraph_1']}</p>";
            echo "<p>Paragraph #2: \n{$blog['paragraph_2']}</p>";
            echo "<p>Paragraph #3: \n{$blog['paragraph_3']}</p>";
            echo "<p>Paragraph #4: \n{$blog['paragraph_4']}</p>";
            echo "<p>Meta: \n{$blog['meta']}</p>";
        ?>
    </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    </html>
<?php
$output = ob_get_clean();
echo $output;

