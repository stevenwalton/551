<?php
include_once '../src/connect.php';
include_once '../src/basicFunctions.php';
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
    New User Page <br>
    <form action='/~swalton2/551/Final/scripts/addUser.php', method="POST">
    Name: <input type="text" name="name"><br>
    Tell Us About Yourself: <input type="text" name="about"><br>
    <input type="submit" value="submit">
    </form>

<?php include '../footer.php'; ?>
</body>

</html>
