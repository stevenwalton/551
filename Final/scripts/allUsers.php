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
    $users = $_user->getAllUsers();
    $i = 0;
    #echo("User: ".$users['name']);

    echo("<table border='1' style='border-collapse: collapse; border-color: black;'>");
    foreach($users as $user):
    {
        if ($i == 0)
        {
            echo("<tr style='font-weight: bold;'>");
            echo("<td width='150' align='center'>Name</td>");
            echo("<td width='350' align='center'>Description</td>");
            echo("</tr>");
            $i++;
        }
?>
        <tr>
        <form action="/~swalton2/551/Final/scripts/singleUser.php", method="POST">
        <input type="hidden" name="idUsers" value="<?php echo($user['idUsers']); ?>">
        <td width='150' align='center'>
        <input type="submit" value="<?php echo($user['name']); ?>">
        </form>
        </td>
        <td width='350' align='center'><?php echo($user['bib']); ?></td>
<?php

    }
    endforeach;
?>

</body>

</html>
