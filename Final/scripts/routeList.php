<?php
include_once '../src/connect.php';
include_once '../src/routeFunctions.php';

?>

<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
    </head>
<body>
    <a href="/~swalton2/551/Final">
    <img src="/~swalton2/551/Final/media/Title.png">
    </a>
    <br>
    <?php
    $_route = new Route;
    $routes = $_route->getAllRoutesByPop();
    foreach($routes as $route):
    {
        echo($route."<br>");
    }
    endforeach;
?>



<?php include '../footer.php'; ?>
</body>

</html>
