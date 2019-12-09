<?php
include_once '../src/connect.php';
include_once '../src/countryFunctions.php';
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
    $name= $_POST['name'];
    $object = new Country;
    $object->addCountry($name);
    ?>
    </body>
</html>
