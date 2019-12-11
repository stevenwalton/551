<!--
Script adds a site to the database then returns back to the home page.
This is intended for testing.
-->
<?php
include_once '../src/connect.php';
include_once '../src/routeFunctions.php';
?>

<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
<!--
        <meta http-equiv="refresh" content=0; url="/Final" />
-->
    </head>
<!--
    <script type="text/javascript">
        window.location.href = "/Final"
    </script>
-->
    <body>
    <?php
    $name = $_POST['name'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $site = $_POST['site'];
    $area = $_POST['area'];
    $nPitch = $_POST['npitch'];
    $type = $_POST['type'];
    $app = $_POST['approach'];
    $des = $_POST['description'];
    $like = $_POST['likability'];
    $diff_maj = $_POST['diff_maj'];
    $diff_min = $_POST['diff_min'];
    echo("Got area name: ".$name." and site ".$site." and area ".$area."<br>");
    $object = new Route;
    echo("Created site object<br>");
    $object->addRoute($name,$site,$area);
    ?>
    </body>
</html>
