<?php

require_once "../../vendor/autoload.php";

use App\Application\ApplicationFacade;
use App\Application\ApplicationFacadeException;
use App\Domain\Exception\ModelNotFoundException;
use App\Infrastructure\Service\BlogEntityService;

$page = 'Add New Blog';
$entityName = BlogEntityService::BLOG_ENTITY_NAME;
$entity = null;

ob_start();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add new blog post</title>
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
        <?php
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

        if ($_POST) {
            $lastInsertId = $blogService->createNewBlog();

            if ($lastInsertId) {
                $blog = $entity->show($lastInsertId);
                echo "<p>Blog with ID ($lastInsertId) created!</p>";
                echo "<a href='show_blog.php/?id=$lastInsertId'>Show blog data</a>";
            }
        } else { ?>
            <form class="row gy-2 gx-3 align-items-center" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="form-group">
                    <label> Title
                        <input class="form-control" type="text" name="title">
                    </label>
                </div>
                <div class="form-group">
                    <label> Short blog description
                        <input class="form-control" type="text" name="description">
                    </label>
                </div>
                <div class="form-group purple-border">
                    <label> First paragraph block
                        <textarea class="form-control" name="paragraph_1" cols="70" rows="3"></textarea>
                    </label>
                </div>
                <div class="form-group">
                    <label> Second paragraph block
                        <input class="form-control" type="text" name="paragraph_2">
                    </label>
                </div>
                <div class="form-group">
                    <label> Third paragraph block
                        <input class="form-control" type="text" name="paragraph_3">
                    </label>
                </div>
                <div class="form-group">
                    <label> Fourth paragraph block
                        <input class="form-control" type="text" name="paragraph_4">
                    </label>
                </div>
                <div class="form-group">
                    <label> Meta tags (used for SEO)
                        <input class="form-control" type="text" name="meta">
                    </label>
                </div>
                <div class="form-group">
                    <input type="submit" value="Insert" class="btn btn-primary">
                </div>
            </form>

        <?php } ?>
    </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    </html>
<?php
$output = ob_get_clean();

echo $output;

