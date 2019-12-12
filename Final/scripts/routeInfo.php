<?php
include_once '../src/connect.php';
include_once '../src/basicFunctions.php';
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
    $country = $_POST['country'];
    $state = $_POST['state'];
    $site = $_POST['site'];
    $area = $_POST['area'];
    $like = $_POST['like'];
    $diff_maj = $_POST['diff_maj'];
    $diff_min = $_POST['diff_min'];
    $type = $_POST['type'];
    $nPitch = $_POST['nPitch'];
    if ($diff_maj != NULL)
    {
        $_basic = new Basic;
        $diff = $_basic->difficultyToNumber($diff_maj, $diff_min);
    }
    ?>
    Searching for routes where:<br>
    <?php
    if($country) echo("Country = ".$country."<br>");
    if($state) echo("State = ".$state."<br>");
    if($site) echo("Site = ".$site."<br>");
    if($area) echo("Area = ".$area."<br>");
    if($like) echo("Likability = ".$like."<br>");
    if($diff_maj)
    {
        $s = "Difficulty = 5.".$diff_maj;
        if($diff_min)
        {
            $s = $s."".$diff_min;
        }
        $s = $s."<br>";
        echo($s);
    }
    if($type) echo("Type = ".$type."<br>");
    if($nPitch) echo("Number of Pitches = ".$nPitch."<br>");
    ?>
    <br>
    Search Results:
    <br>
    <?php
    $_route = new Route;
    $routes = $_route->searchRoutes($country, $state, $site, $area, $like, 
                                     $diff, $type, $nPitch);
    if ($routes == NULL )
    {
        echo("Sorry, there are no routes with this criteria.<br>");
    }
    foreach($routes as $route):
    {
        $id = $_route->getRouteID($route)[0];
        echo($route."<br>");
    }
    endforeach;
    ?>
    </body>
    <?php include '../footer.php'; ?>
</html>
