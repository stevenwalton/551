<?php
include_once '../src/connect.php';
include_once '../src/pitchFunctions.php';
include_once '../src/userFunctions.php';
include_once '../src/pictureFunctions.php';
?>
<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
    <?php
    $name = $_POST['routeName'];
    $pitch = $_POST['pNum'];
    $total = $_POST['totalPitches'];
    echo("Route named: ".$name."<BR>");
    echo("Pitch number: ".$pitch."<BR>");
    ?>
    </body>
</html>
