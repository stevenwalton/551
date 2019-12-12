<!--
Script adds a site to the database then returns back to the home page.
This is intended for testing.
-->
<?php
include_once '../src/connect.php';
include_once '../src/basicFunctions.php';
include_once '../src/routeFunctions.php';
include_once '../src/pictureFunctions.php';
include_once '../src/userFunctions.php';
?>

<!DOCTYPE HTML>
    <?php
    $name = $_POST['routeName'];
    $country = $_POST['country'];
    if($country == NULL) $country = $_POST['new_country'];
    $state = $_POST['state'];
    if($state == NULL) $state = $_POST['new_state'];
    $site = $_POST['site'];
    if($site == NULL) $site = $_POST['new_site'];
    $area = $_POST['area'];
    if($area == NULL) $area = $_POST['new_area'];
    $nPitch = $_POST['numPitches'];
    $type = $_POST['type'];
    $app = $_POST['approach'];
    $des = $_POST['description'];
    $like = $_POST['likability'];
    $diff_maj = $_POST['diff_maj'];
    $diff_min = $_POST['diff_min'];
    $picture_url = $_POST['picture'];
    $username = $_POST['username'];
    if($nPitch == 1) 
    {
        $redirect = "/~swalton2/551/Final/";
        $finish = "finish";
    }
    else 
    {
        $redirect = "/~swalton2/551/Final/scripts/addPitch.php";
        $finish = "add pitch";
    }
?>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <?php if($nPitch == 1): ?>
        <meta http-equiv="refresh" content=0; url="<?php echo($redirect); ?>" />
        <?php endif; ?>
    </head>
    <body>
<?php
    /*
    echo("Got Route name: ".$name." in country: ".$country." in state: ".$state.
         " in site: ".$site." in area: ".$area." with nPitches: ".$nPitch.
         " type: ".$type." approach: ".$app." description: ".$des." like: ".$like.
         " and difficulty: ".$diff_maj.":".$diff_min."<br>");
     */
        
    $object = new Basic;
    #echo("Got difficulty ".$diff_maj."".$diff_min."<br>");
    $diff = $object->difficultyToNumber($diff_maj, $diff_min);
    #echo("Converted difficulty to ".$diff."<br>");
    $object = new Route;
    #echo("Created site object<br>");
    $object->addRoute($name, $country, $state, $site, $area, $nPitch, $type,
                      $app, $des, $like, $diff);
    $idRoute = $object->getRouteID($name)[0];
    if($username)
    {
        $_user = new User;
        $idUser = $_user->getUserID($username)[0];
    }
    else
    {
        $idUser= NULL;
    }
    $_picture = new Picture;
    $_picture->addPicture($idRoute, $picture_url, $idUser);
    ?>
    <form action="<?php echo($redirect); ?>", method="POST">
    <input type="hidden" name="routeName" value="<?php echo($name); ?>">
    <input type="hidden" name="idRoute" value="<?php echo($idRoute); ?>">
    <input type="hidden" name="totalPitches" value="<?php echo($nPitch); ?>">
    <input type="hidden" name="pNum" value="0">
    <input type="submit" value="<?php echo($finish); ?>">
    </form>
    <?php if($nPitch == 1): ?>
    <script type="text/javascript">
        window.location.href="<?php echo($redirect) ?>"
    </script>
    <?php endif; ?>
    </body>
</html>
