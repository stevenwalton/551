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
    $i = 0;
    echo("<table border='1' style='border-collapse: collapse; border-color: black;'>");
    foreach($users as $user):
    {
        if ($i == 0)
        {
            echo("<tr style='font-weight: bold;'>");
            echo("<td width='150' align='center'>Name</td>");
            echo("<td width='350' align='center'>Description</td>");
            echo("</tr>");
        }
        echo("<tr>");
        echo("<td width='150' align='center'>".$user['name']."</td>");
        echo("<td width='350' align='center'>".$user['bib']."</td>");

    }
    endforeach;
?>



<?php include '../footer.php'; ?>
</body>

</html>
