<?php
include_once '../src/connect.php';
include_once '../src/basicFunctions.php';
include_once '../src/pitchFunctions.php';
include_once '../src/userFunctions.php';
include_once '../src/pictureFunctions.php';
?>
<!DOCTYPE HTML>
<html lang="en-US">
    <?php
    $name = $_POST['routeName'];
    $idRoute = $_POST['idRoute'];
    $pitch = $_POST['pNum'];
    $total = $_POST['totalPitches'];
    if ($pitch == $total)
    {
        $finish = "finish";
        $redirect = "/~swalton2/551/Final/";
    }
    else
    {
        $finish = "add pitch ".($pitch+1);
        $redirect = "/~swalton2/551/Final/scripts/addPitch.php";
    }
    if($pitch != 0)
    {
        $len = $_POST['length'];
        $diff_maj = $_POST['diff_maj'];
        $diff_min = $_POST['diff_min'];
        $_basic = new Basic;
        $diff = $_basic->difficultyToNumber($diff_maj, $diff_min);
        $like = $_POST['like'];

        $_pitch = new Pitch;
        $_pitch->addPitch($pitch, $idRoute, $len, $diff, $like);
    }
    ?>
    <head>
        <meta charset="UTF-8">
        <?php if($pitch == $total): ?>
            <meta http-equiv="refresh" content=0; url="/~swalton2/551/Final" />
        <?php endif; ?>
    </head>
   <?php if($pitch == $total): ?>
        <script type="text/javascript">
            window.location.href = "/~swalton2/551/Final"
        </script>
   <?php endif; ?>
<?php
    $pitch++;
?>
    <body>
    Route: <?php echo($name); ?><br>
    Pitch:<?php echo($pitch); ?><br>
    <form action="<?php echo($redirect); ?>", method="POST">
    <select name="length">
        <option value="">--</option>
        <option value="20">20m</option>
        <option value="30">30m</option>
        <option value="35">35m</option>
    </select>
    <br>
    Difficulty: 5.
    <select name="diff_maj" id="maj">
            <option value="">--</option>
        <?php for($i = 0; $i <= 15; $i++) :?>
            <option value="<?php echo($i);?>"><?php echo($i);?></option>
        <?php endfor; ?>
    </select>
    </select>
    <select name="diff_min" id="sub">
        <option value="">--</option>
        <option value="a">a</option>
        <option value="b">b</option>
        <option value="c">c</option>
        <option value="d">d</option>
    </select>
    <br>
    Likability:
    <select name="like" id="like">
            <option value="">--</option>
        <?php for($i = 0; $i <= 10; $i++) :?>
            <option value="<?php echo($i);?>"><?php echo($i);?></option>
        <?php endfor; ?>
    </select>
    <br>
    <input type="hidden" name="idRoute" value="<?php echo($idRoute); ?>">
    <input type="hidden" name="routeName" value="<?php echo($name); ?>">
    <input type="hidden" name="pNum" value="<?php echo($pitch); ?>">
    <input type="hidden" name="totalPitches" value="<?php echo($total); ?>">
    <input type="submit" value="<?php echo($finish); ?>">
    
    </body>
</html>
