<?php

require_once "../../vendor/autoload.php";

use App\ApplicationFacade;
use App\ApplicationFacadeException;
use App\Domain\Exception\ModelNotFoundException;

$page = 'Blog Catalog';
$entityName = 'blogs';
$entity = null;
$html = [];

ob_start();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>title</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
              crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    </head>
    <body>
    <table id="tabela" class="table table-striped">
        <?php
        try {
            $entity = ApplicationFacade::getStaticEntity($entityName);
        } catch (ModelNotFoundException $e) {
            echo sprintf(
                ApplicationFacadeException::CLIENT_PAGE_LOAD_FAIL_ERROR,
                $page,
                $e->getMessage()
            );
        }


        $blogs = $entity->all();
        if (count($blogs)) {
            $blogColumns = array_keys($blogs[0]);
            $html[] = "<thead>";
            $html[] = "<tr>";
            foreach ($blogColumns as $column) {
                $html[] = "<th>$column</th>";
            }
            $html[] = "</tr>";
            $html[] = "</thead>";
            $html[] = "<body>";
            foreach ($blogs as $blog) {
                $html[] = "<tr>";
                foreach ($blog as $key => $value) {
                    $html[] = "<td>$value</td>";
                }
                $html[] = "</tr>";
            }
            $html[] = "</tbody>";
        }


        foreach ($html as $block) {
            echo $block;
        }
        ?>
    </table>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#tabela').DataTable();
        });
    </script>
    </html>
<?php
$output = ob_get_clean();

echo $output;

