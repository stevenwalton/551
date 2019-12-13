<?php
include_once '../src/connect.php';
#include_once '../src/basicFunctions.php';
#include_once '../src/routeFunctions.php';
include_once '../src/pictureFunctions.php';
#include_once '../src/pitchFunctions.php';
include_once '../src/userFunctions.php';
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
<?php
    #var_dump($_POST);
    $id = $_POST['idUsers'];
    $_user = new User;
    $user = $_user->getUser($id)[0];
    #var_dump($user);
?>
    <br>
    <table border='1' style='border-collapse: collapse; border-color: black;'>
    <tr style='font-weight: bold;'>
    <td width='200' align='center'>Name</td>
    <td width='500' align='center'>About</td>
    </tr>
    <tr>
    <td width='200' align='center'><?php echo($user['name']); ?></td>
    <td width='500' align='center'><?php echo($user['bib']); ?></td>
    </tr>
    </body>
<?php
    $_pic = new Picture;
    $pics = $_pic->getPicturesByUserID($id);
    $prev = NULL;
    #var_dump($pics);
    if($pics): 
        foreach ($pics as $pic): ?>

        <?php if ($pic != $prev): ?>
        <img src="<?php echo($pic); ?>" alt="<?php echo($pic);?>" height="400" width="600">
    <?php $prev = $pic; endif; endforeach; endif;
?>
    <BR>
    Upload Photos (URL):
    <form action="/~swalton2/551/Final/scripts/addPhoto.php", method="POST">
    <input type="text" name="url">
    <input type="hidden" name="id" value="<?php echo($id); ?>">
    <input type="submit" value="submit">
    </form>
    
</html>
