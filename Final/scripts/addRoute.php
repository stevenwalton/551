<!--
Script adds a site to the database then returns back to the home page.
This is intended for testing.
-->
<?php
include_once '../src/connect.php';
include_once '../src/basicFunctions.php';
include_once '../src/routeFunctions.php';
?>

<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content=0; url="/~swalton2/551/Final" />
    </head>
    <script type="text/javascript">
        window.location.href = "/~swalton2/551/Final"
    </script>
    <body>
    <?php
    $name = $_POST['routeName'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $site = $_POST['site'];
    $area = $_POST['area'];
    $nPitch = $_POST['numPitches'];
    $type = $_POST['type'];
    $app = $_POST['approach'];
    $des = $_POST['description'];
    $like = $_POST['likability'];
    $diff_maj = $_POST['diff_maj'];
    $diff_min = $_POST['diff_min'];
    echo("Got Route name: ".$name." in country: ".$country." in state: ".$state.
         " in site: ".$site." in area: ".$area." with nPitches: ".$nPitch.
         " type: ".$type." approach: ".$app." description: ".$des." like: ".$like.
         " and difficulty: ".$diff_maj.":".$diff_min."<br>");
        
    $object = new Basic;
    echo("Got difficulty ".$diff_maj."".$diff_min."<br>");
    $diff = $object->difficultyToNumber($diff_maj, $diff_min);
    echo("Converted difficulty to ".$diff."<br>");
    $object = new Route;
    echo("Created site object<br>");
    $object->addRoute($name, $country, $state, $site, $area, $nPitch, $type,
                      $app, $des, $like, $diff);
    ?>
    </body>
</html>
