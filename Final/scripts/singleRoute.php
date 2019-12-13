<?php
include_once '../src/connect.php';
include_once '../src/basicFunctions.php';
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
    echo("<br>");
?>
    Vote on Difficulty: 5.
    <form action="/~swalton2/551/Final/scripts/updateVotes.php", method="POST">
    <select name="diff_maj" id="maj">
            <option value="">--</option>
        <?php for($i = 0; $i <= 15; $i++) :?>
            <option value="<?php echo($i);?>" <?php if($i == $d['major']) echo("selected='selected'"); ?>><?php echo($i);?></option>
        <?php endfor; ?>
    </select>
    <select name="diff_min" id="sub">
        <option value="">--</option>
        <option value="a" <?php if ("a" == $d['minor']) echo("selected='selected'"); ?>>a</option>
        <option value="b" <?php if ("b" == $d['minor']) echo("selected='selected'"); ?>>b</option>
        <option value="c" <?php if ("c" == $d['minor']) echo("selected='selected'"); ?>>c</option>
        <option value="d" <?php if ("d" == $d['minor']) echo("selected='selected'"); ?>>d</option>
    </select>
    and Likability:
    <select name="like" id="like">
            <option value="">--</option>
        <?php for($i = 0; $i <= 10; $i++) :?>
            <option value="<?php echo($i);?>" <?php if ($i == $info['likability']) echo("selected='selected'"); ?>><?php echo($i);?></option>
        <?php endfor; ?>
    </select>
        <input type="hidden" name="idRoute" value="<?php echo($id); ?>">
    <input type="submit" value="VOTE!">
    </form>
<?php

    $_pitch = new Pitch;
    $pitches = $_pitch->pitchesInRoute($id);
    if($pitches):
    $i = 0;
?>
        <table border='1' style='border-collapse: collapse; border-color: black;'>
        <tr style='font-weight: bold;'>
        <td width='50' align='center'>Pitch</td>
        <td width='50' align='center'>Length</td>
        <td width='50' align='center'>Difficulty</td>
        <td wdith='50' align='center'>Likability</td>
        <tr>
        <?php foreach($pitches as $pitch): ?>
        <?php 
        if (!($pitch['pitchNum'] == $i)) :
        ?>
        <td width='50' align='center'><?php echo($pitch['pitchNum']); ?></td>
            <td width='50' align='center'><?php echo($pitch['length']); ?></td>
            <?php
            $d = $_basic->difficultyToYDS($pitch['difficulty']);
            ?>
            <td width='50' align='center'><?php echo("5.".$d['major'].$d['minor']); ?></td>
            <td width='50' align='center'><?php echo($pitch['rating']); ?></td>
        </tr>
        <?php $i = $pitch['pitchNum']; endif; endforeach; 
    endif; 
    $_pic = new Picture;
    $url = $_pic->getPicturesInRouteID($id);
    if($url):
        $_user = new User;
        ?>
        Pictures in route:<br>
        <?php foreach($url as $pic): ?>

            <?php if($pic): ?>
            <img src='<?php print_r($pic); ?>' height="400" width="600">
            <?php endif; ?>
<?php endforeach;
    endif; 
?>
    <br>
    </body>
</html>
