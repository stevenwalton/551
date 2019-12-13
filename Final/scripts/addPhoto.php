<?php
include_once '../src/connect.php';
include_once '../src/basicFunctions.php';
include_once '../src/pictureFunctions.php';

$id = $_POST['id'];
$url = $_POST['url'];

$_pic = new Picture;
$_pic->uploadByUser($url, $id);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Climbing Project</title>
    </head>
    <body>
    <a href="/~swalton2/551/Final">
    <img src="/~swalton2/551/Final/media/Title.png">
    </a>
    <br>
    
    <form action="/~swalton2/551/Final/scripts/singleUser.php", method="POST">
    <input type="hidden" name="idUsers" value="<?php echo($id); ?>">
    <input type="submit" value="Go Back">
    </form>

</body>
</html>
