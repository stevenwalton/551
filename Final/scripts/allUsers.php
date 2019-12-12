<?php
include_once '../src/connect.php';
include_once '../src/userFunctions.php';
?>

<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
<!--
        <meta http-equiv="refresh" content=0; url="/~swalton2/551/Final" />
-->
    </head>
<!--
    <script type="text/javascript">
        window.location.href = "/~swalton2/551/Final"
    </script>
-->
<body>
    <a href="/~swalton2/551/Final">
    <img src="/~swalton2/551/Final/media/Title.png">
    </a>
    <br>
    <?php
    $_user = new User;
    $users = $_user->getAllUserNames();
    foreach($users as $user):
    {
        echo($user."<br>");
    }
    endforeach;
?>



<?php include '../footer.php'; ?>
</body>

</html>
