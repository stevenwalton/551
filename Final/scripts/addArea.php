<!--
Script adds a site to the database then returns back to the home page.
This is intended for testing.
-->
<?php
include_once '../src/connect.php';
#include_once '../src/countryFunctions.php';
#include_once '../src/stateFunctions.php';
include_once '../src/areaFunctions.php';
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
    $name= $_POST['name'];
    $site= $_POST['site'];
    echo("Got area name: ".$name." and site ".$site."<br>");
    $object = new Area;
    echo("Created site object<br>");
    $object->addArea($name,$site);
    ?>
    </body>
</html>
