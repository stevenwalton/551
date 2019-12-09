<!--
Script adds a site to the database then returns back to the home page.
This is intended for testing.
-->
<?php
include_once '../src/connect.php';
include_once '../src/countryFunctions.php';
include_once '../src/stateFunctions.php';
include_once '../src/siteFunctions.php';
?>

<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content=0; url="/Final" />
    </head>
    <script type="text/javascript">
        window.location.href = "/Final"
    </script>
    <body>
    <?php
    $name= $_POST['siteName'];
    $country = $_POST['country'];
    $object = new Site;
    $object->addState($name,$country);
    ?>
    </body>
</html>
