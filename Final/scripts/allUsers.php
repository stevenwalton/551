<?php
include_once '../src/connect.php';
include_once '../src/userFunctions.php';
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