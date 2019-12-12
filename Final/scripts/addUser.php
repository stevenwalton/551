<?php
include_once '../src/connect.php';
include_once '../src/basicFunctions.php';
include_once '../src/userFunctions.php';
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
    $name = $_POST['name'];
    $about = $_POST['about'];
    $_user = new User;
    $_user->addUser($name,$about);
    ?>
</body>

</html>
