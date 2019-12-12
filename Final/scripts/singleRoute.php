<?php
include_once '../src/connect.php';
include_once '../src/basicFunctions.php';
#include_once '../src/countryFunctions.php';
#include_once '../src/stateFunctions.php';
#include_once '../src/siteFunctions.php';
#include_once '../src/areaFunctions.php';
include_once '../src/routeFunctions.php';
include_once '../src/pictureFunctions.php';
include_once '../src/pitchFunctions.php';
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
    $id = $_POST['idRoute'];
    #echo("GOT ROUTE ID: ".$id."<BR>");
    $_route = new Route;
    $info = $_route->getRouteInfo($id)[0];
    $_basic = new Basic;
    #var_dump($info);
    echo("<table border='1' style='border-collapse: collapse; border-color: black;'>");
    echo("<tr style='font-weight: bold;'>");
    echo("<td width='50' align='center'>Country Name</td>");
    echo("<td width='50' align='center'>State Name</td>");
    echo("<td width='100' align='center'>Site Name</td>");
    echo("<td width='100' align='center'>Area Name</td>");
    echo("<td width='150' align='center'>Route Name</td>");
    echo("<td width='50' align='center'>Type</td>");
    echo("<td width='50' align='center'>Number of Pitches</td>");
    echo("<td width='50' align='center'>Difficulty</td>");
    echo("<td width='50' align='center'>Likability</td>");
    echo("<td width='150' align='center'>Description</td>");
    echo("<td width='150' align='center'>Approach</td>");
    echo("</tr>");
    $d = $_basic->difficultyToYDS($info['difficulty']);
    echo("<tr>");
    echo("<td width='50' align='center'>".$info['country_name']."</td>");
    echo("<td width='50' align='center'>".$info['state_name']."</td>");
    echo("<td width='100' align='center'>".$info['site_name']."</td>");
    echo("<td width='100' align='center'>".$info['area_name']."</td>");
    echo("<td width='150' align=center>".$info['route_name']."</td>");
    echo("<td width='50' align='center'>".$info['type']."</td>");
    echo("<td width='50' align='center'>".$info['nPitch']."</td>");
    echo("<td width='50' align='center'>5.".$d['major'].$d['minor']."</td>");
    echo("<td width='50' align='center'>".$info['likability']."</td>");
    echo("<td width='250' align='center'>".$info['description']."</td>");
    echo("<td width='250' align='center'>".$info['approach']."</td>");
    echo("</tr>");

    $_pitch = new Pitch;
    $pitches = $_pitch->pitchesInRoute($id);
    if($pitches)
    {
        echo("<table border='1' style='border-collapse: collapse; border-color: black;'>");
        echo("<tr style='font-weight: bold;'>");
        echo("<td width='50' align='center'>Pitch</td>");
        echo("<td width='50' align='center'>Length</td>");
        echo("<td width='50' align='center'>Difficulty</td>");
        echo("<td wdith='50' align='center'>Likability</td>");
        echo("<tr>");
        foreach($pitches as $pitch):
        {
            echo("<td width='50' align='center'>".$pitch['pitchNum']."</td>");
            echo("<td width='50' align='center'>".$pitch['length']."</td>");
            $d = $_basic->difficultyToYDS($info['difficulty']);
            echo("<td width='50' align='center'>".$d."</td>");
            echo("<td width='50' align='center'>".$pitch['rating']."</td>");
        }
        endforeach;
    }
    $_pic = new Picture;
    $url = $_pic->getPicturesInRouteID($id);
    if($url)
    {
        $_user = new User;
        echo("Pictures in route:<br>");
        #var_dump($url);
        foreach($url as $pic):
        {
            #var_dump($pic);
            #echo("Done");
            #echo("<img src='".$pic['pictureURL']."'>");
            ?>
                <img src="<?php print_r($pic['pictureURL']); ?>">
            <?php
            /*
                if($pic['uploadedBy'])
                {
                    echo("Uploaded By:<br>");
                    print_r($pic['uploadedBy']);
                    echo("After");
                    #$uname = print_r($pic['uploadedBy']);
                    $username = $_user->getUserName($pic['uploadedBy']);
                    print_r($username);
                }
             */
        }
        endforeach;
    }
?>
    <br>
    </body>
</html>
