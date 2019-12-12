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
    #var_dump($routes[0]);
    $i = 0;
    echo("<table border='1' style='border-collapse: collapse; border-color: black;'>");
    foreach($routes as $route):
    {
        if ($i == 0)
        {
            echo("<tr style='font-weight: bold;'>");
            echo("<td width='250' align='center'>Route Name</td>");
            if($route[0]['type']) 
            {
                echo("<td width='150' align='center'>Type</td>");
            }
            if($route[0]['numPitches']) 
            {
                echo("<td width='150' align='center'>Number of Pitches</td>");
            }
            if($route[0]['difficulty']) 
            {
                echo("<td width='150' align='center'>Difficulty</td>");
            }
            if($route[0]['likability']) 
            {
                echo("<td width='150' align='center'>Likability</td>");
            }
            echo("</tr>");
            $i++;
        }
        #$id = $_route->getRouteID($route)[0];
        #echo($route."<br>");
        echo("<tr>");
        echo("<td width='250' align=center>".$route['name']."</td>");
        if($route['type']) 
        {
            echo("<td width='150' align='center'>".$route['type']."</td>");
        }
        if($route['numPitches']) 
        {
            echo("<td width='150' align='center'>".$route['numPitches']."</td>");
        }
        if($route['difficulty']) 
        {
            echo("<td width='150' align='center'>".$route['difficulty']."</td>");
        }
        if($route['likability']) 
        {
            echo("<td width='150' align='center'>".$route['likability']."</td>");
        }
        echo("</tr>");
    }
    endforeach;
    ?>
<!--
    <?php include '../footer.php'; ?>
    -->
    </body>
</html>
