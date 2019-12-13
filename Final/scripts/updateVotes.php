<?php
include_once '../src/connect.php';
include_once '../src/basicFunctions.php';
include_once '../src/routeFunctions.php';

$id       = $_POST['idRoute'];
$diff_maj = $_POST['diff_maj'];
$diff_min = $_POST['diff_min'];
$like     = $_POST['like'];

$_route = new Route;
if($like) 
{
    $_route->updateLikability($like, $id);
}
#echo("Voted like");
if($diff_maj)
{
    $_basic = new Basic;
    $diff = $_basic->difficultyToNumber($diff_maj, $diff_min);
    $_route->updateDifficulty($diff, $id);
}
#echo("OUT");
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
    
    <form action="/~swalton2/551/Final/scripts/singleRoute.php", method="POST">
    <input type="hidden" name="idRoute" value="<?php echo($id); ?>">
    <input type="submit" value="Go Back">
    </form>

</body>
</html>
