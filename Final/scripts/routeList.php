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
    $id = $_route->getRouteID($routes[0]);
    echo("<table border='1' style='border-collapse: collapse; border-color: black;'>");
    $routes = $_route->searchRoutes();
    $i = 0;
    foreach($routes as $route):
    {
        if ($i == 0)
        {
            echo("<tr style='font-weight: bold;'>");
            echo("<td width='50' align='center'>Country Name</td>");
            echo("<td width='50' align='center'>State Name</td>");
            echo("<td width='150' align='center'>Site Name</td>");
            echo("<td width='150' align='center'>Area Name</td>");
            echo("<td width='250' align='center'>Route Name</td>");
            echo("<td width='150' align='center'>Type</td>");
            echo("<td width='50' align='center'>Number of Pitches</td>");
            echo("<td width='150' align='center'>Difficulty</td>");
            echo("<td width='50' align='center'>Likability</td>");
            echo("</tr>");
            $i++;
        }
        $d = $_basic->difficultyToYDS($route['difficulty']);
        echo("<tr>");
        echo("<td width='50' align='center'>".$route['country_name']."</td>");
        echo("<td width='50' align='center'>".$route['state_name']."</td>");
        echo("<td width='150' align='center'>".$route['site_name']."</td>");
        echo("<td width='150' align='center'>".$route['area_name']."</td>");
        echo("<td width='250' align=center>".$route['route_name']."</td>");
        echo("<td width='150' align='center'>".$route['type']."</td>");
        echo("<td width='50' align='center'>".$route['numPitches']."</td>");
        echo("<td width='150' align='center'>5.".$d['major'].$d['minor']."</td>");
        echo("<td width='50' align='center'>".$route['likability']."</td>");
        echo("</tr>");
    }
    endforeach;
    ?>



<!--
<?php include '../footer.php'; ?>
-->
</body>

</html>
