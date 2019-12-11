<!--
Script adds a country to the database then returns back to the home page.
This is intended for testing.
-->
<?php
include_once '../src/connect.php';
#include_once '../src/countryFunctions.php';
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
    #$object = new Country;
    #$object->addCountry($name);
    $py = "python ../skel/makeCountry.py -c ".$name;
    echo("Running: ".$py."<br>");
    $ret = exec("./makeCountry.py -c ".$name. " 2>&1", $retval);
    echo("Returned ".$retval."<br>".$ret."<br>");
    var_dump($retval);
    echo("<br>");
    var_dump($ret);
    ?>
    </body>
</html>
