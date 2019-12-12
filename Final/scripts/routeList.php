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
    List of all routes. Sorted by most popular and difficulty (ascending)
    <br><br>
    <?php
    $_basic = new Basic;
    $_route = new Route;
    $routes = $_route->getAllRoutesByPop();
    #var_dump($routes);
    #echo("route ".$routes[0]."<br>");
    $id = $_route->getRouteID($routes[0]);
    #echo("Got ID: ".$id[0]."<br>");
    foreach($routes as $route):
    {
        #echo("Getting like for ".$route."<br>");
        $id = $_route->getRouteID($route)[0];
        #echo("id: ".$id."<br>");
        $like = $_route->getRoutePop($id)[0];
        $diff = $_route->getRouteDifficulty($id)[0];
        $rArr = $_basic->difficultyToYDS($diff);
        $maj = $rArr['major'];
        $min = $rArr['minor'];
        echo($route."(popularity: ".$like.", difficulty: 5.".$maj.$min.")<br>");
    }
    endforeach;
?>



<?php include '../footer.php'; ?>
</body>

</html>
